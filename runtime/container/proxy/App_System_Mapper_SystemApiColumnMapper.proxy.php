<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemApiColumn;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
/**
 * Class SystemApiColumnMapper
 * @package App\System\Mapper
 */
class SystemApiColumnMapper extends AbstractMapper
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
     * @var SystemApiColumn
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemApiColumn::class;
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        // 接口ID
        if (!empty($params['api_id'])) {
            $query->where('api_id', '=', $params['api_id']);
        }
        // 字段类型
        if (!empty($params['type'])) {
            $query->where('type', '=', $params['type']);
        }
        // 字段名称
        if (!empty($params['name'])) {
            $query->where('name', '=', $params['name']);
        }
        // 数据类型
        if (!empty($params['data_type'])) {
            $query->where('data_type', '=', $params['data_type']);
        }
        // 是否必填 1 非必填 2 必填
        if (!empty($params['is_required'])) {
            $query->where('is_required', '=', $params['is_required']);
        }
        // 状态 (1正常 2停用)
        if (!empty($params['status'])) {
            $query->where('status', '=', $params['status']);
        }
        return $query;
    }
}