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

use App\System\Service\SystemAppMenuService;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class AppTest extends HttpTestCase
{
    public function testAppServerCreateAfterForMenu()
    {
        $service = \Hyperf\Context\ApplicationContext::getContainer()->get(SystemAppMenuService::class);

        $res = $service->create();

        print_r($res);

        $this->assertSame(1, 1);
    }

    public function testHello()
    {
        $res = $this->get('/system/appsMenu/index',['']);
        print_r([$res]);
        $this->assertSame(1, 1);
    }

    public function testAppList()
    {
        $res = $this->get('/system/app/index');
        print_r([$res]);
        $this->assertSame(1, 1);
    }

}
