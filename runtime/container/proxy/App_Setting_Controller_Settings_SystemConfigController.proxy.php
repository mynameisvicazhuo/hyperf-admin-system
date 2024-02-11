<?php

declare (strict_types=1);
namespace App\Setting\Controller\Settings;

use Psr\Http\Message\ResponseInterface;
use App\Setting\Request\SettingConfigRequest;
use App\Setting\Service\SettingConfigService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\Annotation\RemoteState;
use Mine\MineController;
/**
 * 系统配置控制器
 * Class SystemConfigController
 * @package App\Setting\Controller\Settings
 */
#[Controller(prefix: "setting/config"), Auth]
class SystemConfigController extends MineController
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
    protected SettingConfigService $service;
    /**
     * 获取配置列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("index"), Permission("setting:config, setting:config:index")]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getList($this->request->all()));
        });
    }
    /**
     * 保存配置
     * @param SettingConfigRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("save"), Permission("setting:config:save"), OperationLog]
    public function save(SettingConfigRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (SettingConfigRequest $request) use($__function__, $__method__) {
            return $this->service->save($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 更新配置
     * @param SettingConfigRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("update"), Permission("setting:config:update"), OperationLog]
    public function update(SettingConfigRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (SettingConfigRequest $request) use($__function__, $__method__) {
            return $this->service->updated($this->request->input('key'), $request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 按 keys 更新配置
     * @param SettingConfigRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("updateByKeys"), Permission("setting:config:update"), OperationLog]
    public function updateByKeys() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->updatedByKeys($this->request->all()) ? $this->success() : $this->error();
        });
    }
    /**
     * 删除配置
     * @param string $key
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[DeleteMapping("delete"), Permission("setting:config:delete"), OperationLog]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 清除配置缓存
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("clearCache"), Permission("setting:config:clearCache"), OperationLog]
    public function clearCache() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->clearCache() ? $this->success() : $this->error();
        });
    }
    /**
     * 远程万能通用列表接口
     * @return ResponseInterface
     */
    #[PostMapping("remote"), RemoteState(true)]
    public function remote() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getRemoteList($this->request->all()));
        });
    }
}