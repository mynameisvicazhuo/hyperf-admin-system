<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemRole;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\DeleteCache;
use Mine\Annotation\Transaction;
class SystemRoleMapper extends AbstractMapper
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
     * @var SystemRole
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemRole::class;
    }
    /**
     * 通过角色ID列表获取菜单ID
     * @param array $ids
     * @return array
     */
    public function getMenuIdsByRoleIds(array $ids) : array
    {
        if (empty($ids)) {
            return [];
        }
        return $this->model::query()->whereIn('id', $ids)->with(['menus' => function ($query) {
            $query->select('id')->where('status', $this->model::ENABLE)->orderBy('sort', 'desc');
        }])->get(['id'])->toArray();
    }
    /**
     * 通过角色ID列表获取部门ID
     * @param array $ids
     * @return array
     */
    public function getDeptIdsByRoleIds(array $ids) : array
    {
        if (empty($ids)) {
            return [];
        }
        return $this->model::query()->whereIn('id', $ids)->with(['depts' => function ($query) {
            $query->select('id')->where('status', $this->model::ENABLE)->orderBy('sort', 'desc');
        }])->get(['id'])->toArray();
    }
    /**
     * 通过 code 查询角色名称
     * @param string $code
     * @return string
     */
    public function findNameByCode(string $code) : ?string
    {
        return $this->model::query()->where('code', $code)->value('name');
    }
    /**
     * 检查角色code是否已存在
     * @param string $code
     * @return bool
     */
    public function checkRoleCode(string $code) : bool
    {
        return $this->model::query()->where('code', $code)->exists();
    }
    /**
     * 新建角色
     * @param array $data
     * @return int
     */
    #[Transaction]
    public function save(array $data) : int
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $data) use($__function__, $__method__) {
            $menuIds = $data['menu_ids'] ?? [];
            $deptIds = $data['dept_ids'] ?? [];
            $this->filterExecuteAttributes($data);
            $role = $this->model::create($data);
            empty($menuIds) || $role->menus()->sync(array_unique($menuIds), false);
            empty($deptIds) || $role->depts()->sync($deptIds, false);
            return $role->id;
        });
    }
    /**
     * 更新角色
     * @param int $id
     * @param array $data
     * @return bool
     */
    #[DeleteCache("loginInfo:*"), Transaction]
    public function update(int $id, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id, array $data) use($__function__, $__method__) {
            $menuIds = $data['menu_ids'] ?? [];
            $deptIds = $data['dept_ids'] ?? [];
            $this->filterExecuteAttributes($data, true);
            $this->model::query()->where('id', $id)->update($data);
            if ($id != env('ADMIN_ROLE')) {
                $role = $this->model::find($id);
                if ($role) {
                    !empty($menuIds) && $role->menus()->sync(array_unique($menuIds));
                    !empty($deptIds) && $role->depts()->sync($deptIds);
                    return true;
                }
            }
            return false;
        });
    }
    /**
     * 单个或批量软删除数据
     * @param array $ids
     * @return bool
     */
    #[DeleteCache("loginInfo:*")]
    public function delete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $ids) use($__function__, $__method__) {
            $adminId = env('ADMIN_ROLE');
            if (in_array($adminId, $ids)) {
                unset($ids[array_search($adminId, $ids)]);
            }
            $this->model::destroy($ids);
            return true;
        });
    }
    /**
     * 批量真实删除角色
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
                if ($id == env('ADMIN_ROLE')) {
                    continue;
                }
                $role = $this->model::withTrashed()->find($id);
                if ($role) {
                    // 删除关联菜单
                    $role->menus()->detach();
                    // 删除关联部门
                    $role->depts()->detach();
                    // 删除关联用户
                    $role->users()->detach();
                    // 删除角色数据
                    $role->forceDelete();
                }
            }
            return true;
        });
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        if (!empty($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['code'])) {
            $query->where('code', $params['code']);
        }
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }
        if (!empty($params['filterAdminRole'])) {
            $query->whereNotIn('id', [env('ADMIN_ROLE')]);
        }
        if (!empty($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween('created_at', [$params['created_at'][0] . ' 00:00:00', $params['created_at'][1] . ' 23:59:59']);
        }
        return $query;
    }
}