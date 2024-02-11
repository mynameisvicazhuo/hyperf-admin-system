<?php

declare (strict_types=1);
namespace App\Setting\Controller\Tools;

use App\Setting\Request\SettingCrontabRequest;
use App\Setting\Service\SettingCrontabLogService;
use App\Setting\Service\SettingCrontabService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\Annotation\RemoteState;
use Mine\MineController;
use Psr\Http\Message\ResponseInterface;
/**
 * 定时任务控制器
 * Class CrontabController
 * @package App\Setting\Controller\Tools
 */
#[Controller(prefix: "setting/crontab"), Auth]
class CrontabController extends MineController
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
    /**
     * 计划任务服务
     */
    #[Inject]
    protected SettingCrontabService $service;
    /**
     * 计划任务日志服务
     */
    #[Inject]
    protected SettingCrontabLogService $logService;
    /**
     * 获取列表分页数据
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("index"), Permission("setting:crontab, setting:crontab:index")]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all()));
        });
    }
    /**
     * 获取日志列表分页数据
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("logPageList")]
    public function logPageList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->logService->getPageList($this->request->all()));
        });
    }
    /**
     * 保存数据
     * @param SettingCrontabRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("save"), Permission("setting:crontab:save"), OperationLog]
    public function save(SettingCrontabRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (SettingCrontabRequest $request) use($__function__, $__method__) {
            return $this->success(['id' => $this->service->save($request->all())]);
        });
    }
    /**
     * 立即执行定时任务
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("run"), Permission("setting:crontab:run"), OperationLog]
    public function run() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            $id = $this->request->input('id', null);
            if (is_null($id)) {
                return $this->error();
            } else {
                return $this->service->run($id) ? $this->success() : $this->error();
            }
        });
    }
    /**
     * 获取一条数据信息
     * @param int $id
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("read/{id}"), Permission("setting:crontab:read")]
    public function read(int $id) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id) use($__function__, $__method__) {
            return $this->success($this->service->read($id));
        });
    }
    /**
     * 更新数据
     * @param int $id
     * @param SettingCrontabRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("update/{id}"), Permission("setting:crontab:update"), OperationLog]
    public function update(int $id, SettingCrontabRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id, SettingCrontabRequest $request) use($__function__, $__method__) {
            return $this->service->update($id, $request->all()) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量删除
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[DeleteMapping("delete"), Permission("setting:crontab:delete")]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 删除定时任务日志
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[DeleteMapping("deleteCrontabLog"), Permission("setting:crontab:deleteCrontabLog"), OperationLog("删除定时任务日志")]
    public function deleteCrontabLog() : \Psr\Http\Message\ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->logService->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 更改状态
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("changeStatus"), Permission("setting:crontab:update"), OperationLog]
    public function changeStatus() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->changeStatus((int) $this->request->input('id'), (string) $this->request->input('status')) ? $this->success() : $this->error();
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