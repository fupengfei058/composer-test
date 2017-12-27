<?php

namespace PackageVersions;

/**
 * This class is generated by muglug/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public static $VERSIONS = array (
  'composer/ca-bundle' => 'dev-master@134242fce6195119baf9ae553984e96ff888c2c5',
  'composer/composer' => 'dev-master@57b3e2451404af0dac0f5fd797fce6789fa2624b',
  'composer/semver' => 'dev-master@2b303e43d14d15cc90c8e8db4a1cdb6259f1a5c5',
  'composer/spdx-licenses' => 'dev-master@c6b666678fc9e58243869a60b5196f29c405ceee',
  'justinrainbow/json-schema' => '5.x-dev@d283e11b6e14c6f4664cf080415c4341293e5bbd',
  'muglug/package-versions' => '1.2.1@d899b8c0178104b51522d4c8e813b66f6f7ae2cd',
  'nikic/php-parser' => '3.x-dev@579f4ce846734a1cf55d6a531d00ca07a43e3cda',
  'openlss/lib-array2xml' => '0.5.1@c8b5998a342d7861f2e921403f44e0a2f3ef2be0',
  'psr/log' => 'dev-master@4ebe3a8bf773a19edfe0a84b6585ba3d401b724d',
  'seld/cli-prompt' => 'dev-master@a19a7376a4689d4d94cab66ab4f3c816019ba8dd',
  'seld/jsonlint' => '1.6.2@7a30649c67ee0d19faacfd9fa2cfb6cc032d9b19',
  'seld/phar-utils' => 'dev-master@7009b5139491975ef6486545a39f3e6dad5ac30a',
  'symfony/console' => 'v3.3.6@b0878233cb5c4391347e5495089c7af11b8e6201',
  'symfony/debug' => 'v3.3.6@7c13ae8ce1e2adbbd574fc39de7be498e1284e13',
  'symfony/filesystem' => 'v3.3.6@427987eb4eed764c3b6e38d52a0f87989e010676',
  'symfony/finder' => 'v3.3.6@baea7f66d30854ad32988c11a09d7ffd485810c4',
  'symfony/polyfill-mbstring' => 'dev-master@750a2b259dd68436e3b918a4241e80b023a80663',
  'symfony/process' => 'v3.3.6@07432804942b9f6dd7b7377faf9920af5f95d70a',
  'vimeo/psalm' => '0.3.71@035f528581bcbcad19a2e141016234eb66b2cd14',
  'composer-test/src' => '9999999-dev@b8e2e1a77b442aca967672f4f92be38bd05f2d32',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getVersion($packageName)
    {
        $selfVersion = self::$VERSIONS;

        if (! isset($selfVersion[$packageName])) {
            throw new \OutOfBoundsException(
                'Required package "' . $packageName . '" is not installed: cannot detect its version'
            );
        }

        return $selfVersion[$packageName];
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getShortVersion($packageName)
    {
        return explode('@', static::getVersion($packageName))[0];
    }

    /**
     * @throws \OutOfBoundsException if a version cannot be located
     */
    public static function getMajorVersion($packageName)
    {
        return explode('.', static::getShortVersion($packageName))[0];
    }
}
