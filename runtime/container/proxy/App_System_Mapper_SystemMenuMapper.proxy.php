<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemMenu;
use App\System\Model\SystemUser;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Model;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\DeleteCache;
use Mine\Annotation\Transaction;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
class SystemMenuMapper extends AbstractMapper
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
     * @var SystemMenu
     */
    public $model;
    /**
     * 查询的菜单字段
     * @var array
     */
    public array $menuField = ['id', 'parent_id', 'name', 'code', 'icon', 'route', 'is_hidden', 'component', 'redirect', 'type'];
    public function assignModel()
    {
        $this->model = SystemMenu::class;
    }
    /**
     * 获取超级管理员（创始人）的路由菜单
     * @return array
     */
    public function getSuperAdminRouters() : array
    {
        return $this->model::query()->select($this->menuField)->where('status', $this->model::ENABLE)->orderBy('sort', 'desc')->get()->sysMenuToRouterTree();
    }
    /**
     * 通过菜单ID列表获取菜单数据
     * @param array $ids
     * @return array
     */
    public function getRoutersByIds(array $ids) : array
    {
        return $this->model::query()->select($this->menuField)->whereIn('id', $ids)->where('status', $this->model::ENABLE)->orderBy('sort', 'desc')->get()->sysMenuToRouterTree();
    }
    /**
     * 获取前端选择树
     * @param array $data
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \RedisException
     */
    public function getSelectTree(array $data) : array
    {
        $query = $this->model::query()->select(['id', 'parent_id', 'id AS value', 'name AS label'])->where('status', $this->model::ENABLE)->orderBy('sort', 'desc');
        if (($data['scope'] ?? false) && !user()->isSuperAdmin()) {
            $roleData = container()->get(SystemRoleMapper::class)->getMenuIdsByRoleIds(SystemUser::find(user()->getId(), ['id'])->roles()->pluck('id')->toArray());
            $ids = [];
            foreach ($roleData as $val) {
                foreach ($val['menus'] as $menu) {
                    $ids[] = $menu['id'];
                }
            }
            unset($roleData);
            $query->whereIn('id', array_unique($ids));
        }
        if (!empty($data['onlyMenu'])) {
            $query->where('type', SystemMenu::MENUS_LIST);
        }
        return $query->get()->toTree();
    }
    /**
     * 查询菜单code
     * @param array|null $ids
     * @return array
     */
    public function getMenuCode(array $ids = null) : array
    {
        return $this->model::query()->whereIn('id', $ids)->pluck('code')->toArray();
    }
    /**
     * 通过 code 查询菜单名称
     * @param string $code
     * @return string|null
     */
    public function findNameByCode(string $code) : ?string
    {
        return $this->model::query()->where('code', $code)->value('name');
    }
    /**
     * 单个或批量真实删除数据
     * @param array $ids
     * @return bool
     */
    #[DeleteCache("loginInfo:*"), Transaction]
    public function realDelete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $ids) use($__function__, $__method__) {
            foreach ($ids as $id) {
                $model = $this->model::withTrashed()->find($id);
                if ($model) {
                    $model->roles()->detach();
                    $model->forceDelete();
                }
            }
            return true;
        });
    }
    /**
     * 新增菜单
     * @param array $data
     * @return int
     */
    #[DeleteCache("loginInfo:*")]
    public function save(array $data) : int
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $data) use($__function__, $__method__) {
            return parent::save($data);
        });
    }
    /**
     * 更新菜单
     * @param int $id
     * @param array $data
     * @return bool
     */
    #[DeleteCache("loginInfo:*")]
    public function update(int $id, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id, array $data) use($__function__, $__method__) {
            return parent::update($id, $data);
        });
    }
    /**
     * 逻辑删除菜单
     * @param array $ids
     * @return bool
     */
    #[DeleteCache("loginInfo:*")]
    public function delete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $ids) use($__function__, $__method__) {
            return parent::delete($ids);
        });
    }
    /**
     * 通过 route 查询菜单
     * @param string $route
     * @return Builder|Model|object|null
     */
    public function findMenuByRoute(string $route)
    {
        return $this->model::query()->where('route', $route)->first();
    }
    /**
     * 查询菜单code
     * @param array|null $ids
     * @return array
     */
    public function getMenuName(array $ids = null) : array
    {
        return $this->model::withTrashed()->whereIn('id', $ids)->pluck('name')->toArray();
    }
    /**
     * @param int $id
     * @return bool
     */
    public function checkChildrenExists(int $id) : bool
    {
        return $this->model::withTrashed()->where('parent_id', $id)->exists();
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }
        if (!empty($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween('created_at', [$params['created_at'][0] . ' 00:00:00', $params['created_at'][1] . ' 23:59:59']);
        }
        if (!empty($params['noButton']) && $params['noButton'] === true) {
            $query->where('type', '<>', SystemMenu::BUTTON);
        }
        return $query;
    }
}