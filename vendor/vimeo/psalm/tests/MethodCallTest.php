<?php
namespace Psalm\Tests;

class MethodCallTest extends TestCase
{
    use Traits\FileCheckerInvalidCodeParseTestTrait;
    use Traits\FileCheckerValidCodeParseTestTrait;

    /**
     * @return array
     */
    public function providerFileCheckerValidCodeParse()
    {
        return [
            'notInCallMapTest' => [
                '<?php
                    new DOMImplementation();',
            ],
            'parentStaticCall' => [
                '<?php
                    class A {
                        /** @return void */
                        public static function foo(){}
                    }

                    class B extends A {
                        /** @return void */
                        public static function bar(){
                            parent::foo();
                        }
                    }',
            ],
            'nonStaticInvocation' => [
                '<?php
                    class Foo {
                        public static function barBar() : void {}
                    }

                    (new Foo())->barBar();',
            ],
            'staticInvocation' => [
                '<?php
                    class A {
                        public static function fooFoo() : void {}
                    }

                    class B extends A {

                    }

                    B::fooFoo();',
            ],
            'staticCallOnVar' => [
                '<?php
                    class A {
                        public static function bar() : int {
                            return 5;
                        }
                    }
                    $foo = new A;
                    $b = $foo::bar();',
            ],
            'uppercasedSelf' => [
                '<?php
                    class X33{
                        public static function main() : void {
                            echo SELF::class . "\n";  // Class or interface SELF does not exist
                        }
                    }
                    X33::main();',
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerFileCheckerInvalidCodeParse()
    {
        return [
            'staticInvocation' => [
                '<?php
                    class Foo {
                        public function barBar() : void {}
                    }

                    Foo::barBar();',
                'error_message' => 'InvalidStaticInvocation',
            ],
            'parentStaticCall' => [
                '<?php
                    class A {
                        /** @return void */
                        public function foo(){}
                    }

                    class B extends A {
                        /** @return void */
                        public static function bar(){
                            parent::foo();
                        }
                    }',
                'error_message' => 'InvalidStaticInvocation',
            ],
            'mixedMethodCall' => [
                '<?php
                    class Foo {
                        public static function barBar() : void {}
                    }

                    /** @var mixed */
                    $a = (new Foo());

                    $a->barBar();',
                'error_message' => 'MixedMethodCall',
                'error_levels' => [
                    'MissingPropertyType',
                    'MixedAssignment',
                ],
            ],
            'invalidMethodCall' => [
                '<?php
                    ("hello")->someMethod();',
                'error_message' => 'InvalidMethodCall',
            ],
            'possiblyInvalidMethodCall' => [
                '<?php
                    class A1 {
                        public function methodOfA(): void {
                        }
                    }

                    /** @param A1|string $x */
                    function example($x, bool $isObject) {
                        if ($isObject) {
                            $x->methodOfA();
                        }
                    }',
                'error_message' => 'PossiblyInvalidMethodCall',
            ],
            'selfNonStaticInvocation' => [
                '<?php
                    class A {
                        public function fooFoo() : void {}

                        public function barBar() : void {
                            self::fooFoo();
                        }
                    }',
                'error_message' => 'NonStaticSelfCall',
            ],
            'noParent' => [
                '<?php
                    class Foo {
                        public function barBar() : void {
                            parent::barBar();
                        }
                    }',
                'error_message' => 'ParentNotFound',
            ],
            'coercedClass' => [
                '<?php
                    class NullableClass {
                    }

                    class NullableBug {
                        /**
                         * @param string $className
                         * @return object|null
                         */
                        public static function mock($className) {
                            if (!$className) { return null; }
                            return new $className();
                        }

                        /**
                         * @return NullableClass
                         */
                        public function returns_nullable_class() {
                            return self::mock("NullableClass");
                        }
                    }',
                'error_message' => 'LessSpecificReturnStatement',
                'error_levels' => ['MixedInferredReturnType'],
            ],
            'undefinedVariableStaticCall' => [
                '<?php
                    $foo::bar();',
                'error_message' => 'UndefinedGlobalVariable',
            ],
            'staticCallOnString' => [
                '<?php
                    class A {
                        public static function bar() : int {
                            return 5;
                        }
                    }
                    $foo = "A";
                    $b = $foo::bar();',
                'error_message' => 'MixedAssignment',
            ],
        ];
    }
}
