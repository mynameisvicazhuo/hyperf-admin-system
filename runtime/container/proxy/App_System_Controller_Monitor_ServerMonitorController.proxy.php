<?php

declare (strict_types=1);
namespace App\System\Controller\Monitor;

use App\System\Service\ServerMonitorService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\Permission;
use Mine\MineController;
/**
 * Class ServerMonitorController
 * @package App\System\Controller\Monitor
 */
#[Controller(prefix: "system/server"), Auth]
class ServerMonitorController extends MineController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        if (method_exists(parent::class, '__construct')) {
            parent::__construct(...func_get_args());
        }
        $this->__handlePropertyHandler(__CLASS__);
    }
    #[Inject]
    protected ServerMonitorService $service;
    /**
     * 获取服务器信息
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("monitor"), Permission("system:monitor:server")]
    public function getServerInfo() : \Psr\Http\Message\ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success(['cpu' => $this->service->getCpuInfo(), 'memory' => $this->service->getMemInfo(), 'phpenv' => $this->service->getPhpAndEnvInfo(), 'disk' => $this->service->getDiskInfo()]);
        });
    }
}