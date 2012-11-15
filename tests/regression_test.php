<?php
namespace vierbergenlars\SemVer\Tests;
use vierbergenlars\SemVer;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/vierbergenlars/simpletest/autorun.php';
class regressionTest extends \UnitTestCase {
    function testBug23() {
        $this->assertTrue(SemVer\version::lt('3.0.0', '4.0.0-beta.1'), '3.0.0 < 4.0.0-beta.1 (Bug #23)');
    }
}