<?php
require 'vendor/autoload.php';

use City\Guangzhou;
use City\Beijing;
use City\Shenzhen;

echo Guangzhou\Guangzhou::info().'<br />';
echo Beijing\Beijing::info().'<br />';
echo Shenzhen\Shenzhen::info().'<br />';
