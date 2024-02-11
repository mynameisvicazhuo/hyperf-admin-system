<?php

declare (strict_types=1);
namespace App\System\Controller\Permission;

use App\System\Request\SystemPostRequest;
use App\System\Service\SystemPostService;
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
 * Class PostController
 * @package App\System\Controller
 */
#[Controller(prefix: "system/post"), Auth]
class PostController extends MineController
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
    protected SystemPostService $service;
    /**
     * 岗位分页列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("index"), Permission("system:post, system:post:index")]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all()));
        });
    }
    /**
     * 岗位回收站分页列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("recycle"), Permission("system:post:recycle")]
    public function recycle() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getPageListByRecycle($this->request->all()));
        });
    }
    /**
     * 获取岗位列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("list")]
    public function list() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->success($this->service->getList());
        });
    }
    /**
     * 保存数据
     * @param SystemPostRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PostMapping("save"), Permission("system:post:save"), OperationLog]
    public function save(SystemPostRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (SystemPostRequest $request) use($__function__, $__method__) {
            return $this->success(['id' => $this->service->save($request->all())]);
        });
    }
    /**
     * 获取一条数据信息
     * @param int $id
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("read/{id}"), Permission("system:post:read")]
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
     * @param SystemPostRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("update/{id}"), Permission("system:post:update"), OperationLog]
    public function update(int $id, SystemPostRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id, SystemPostRequest $request) use($__function__, $__method__) {
            return $this->service->update($id, $request->all()) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量删除数据到回收站
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[DeleteMapping("delete"), Permission("system:post:delete")]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量真实删除数据 （清空回收站）
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[DeleteMapping("realDelete"), Permission("system:post:realDelete"), OperationLog]
    public function realDelete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->realDelete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量恢复在回收站的数据
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("recovery"), Permission("system:post:recovery")]
    public function recovery() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->recovery((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 更改岗位状态
     * @param SystemPostRequest $request
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("changeStatus"), Permission("system:post:changeStatus"), OperationLog]
    public function changeStatus(SystemPostRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (SystemPostRequest $request) use($__function__, $__method__) {
            return $this->service->changeStatus((int) $request->input('id'), (string) $request->input('status')) ? $this->success() : $this->error();
        });
    }
    /**
     * 数字运算操作
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[PutMapping("numberOperation"), Permission("system:post:update"), OperationLog]
    public function numberOperation() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            return $this->service->numberOperation((int) $this->request->input('id'), (string) $this->request->input('numberName'), (int) $this->request->input('numberValue', 1)) ? $this->success() : $this->error();
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