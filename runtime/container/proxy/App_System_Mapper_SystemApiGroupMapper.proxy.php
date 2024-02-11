<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemApi;
use App\System\Model\SystemApiGroup;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
/**
 * Class SystemApiGroupMapper
 * @package App\System\Mapper
 */
class SystemApiGroupMapper extends AbstractMapper
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
     * @var SystemApiGroup
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemApiGroup::class;
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        // 应用组名称
        if (!empty($params['name'])) {
            $query->where('name', '=', $params['name']);
        }
        // 状态
        if (!empty($params['status'])) {
            $query->where('status', '=', $params['status']);
        }
        // 关联查询api列表
        if (!empty($params['getApiList']) && $params['getApiList'] == true) {
            $query->with(['apis' => function ($query) {
                $query->where('status', SystemApi::ENABLE)->select(['id', 'group_id', 'name', 'access_name']);
            }]);
        }
        return $query;
    }
}