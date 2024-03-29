<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends HttpTestCase
{
    public function testExample()
    {
        $this->assertTrue(true,"testExample");
        //$this->assertTrue(is_array($this->get('/')));
    }
    public function testExample2()
    {
        $this->assertIsWritable(true,"testExample2");
        //$this->assertTrue(is_array($this->get('/')));
    }
}
