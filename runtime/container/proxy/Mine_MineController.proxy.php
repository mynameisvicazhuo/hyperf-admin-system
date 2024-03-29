<?php

/**
 * MineAdmin is committed to providing solutions for quickly building web applications
 * Please view the LICENSE file that was distributed with this source code,
 * For the full copyright and license information.
 * Thank you very much for using MineAdmin.
 *
 * @Author X.Mo<root@imoi.cn>
 * @Link   https://gitee.com/xmo/MineAdmin
 */
declare (strict_types=1);
namespace Mine;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Mine\Traits\ControllerTrait;
/**
 * 后台控制器基类
 * Class MineController
 * @package Mine
 */
abstract class MineController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        $this->__handlePropertyHandler(__CLASS__);
    }
    use ControllerTrait;
    /**
     * @var Mine
     */
    #[Inject]
    protected Mine $mine;
}