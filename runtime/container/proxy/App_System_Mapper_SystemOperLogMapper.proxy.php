<?php

namespace App\System\Mapper;

use App\System\Model\SystemOperLog;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
class SystemOperLogMapper extends AbstractMapper
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
     * @var SystemOperLog
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemOperLog::class;
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        if (!empty($params['ip'])) {
            $query->where('ip', $params['ip']);
        }
        if (!empty($params['service_name'])) {
            $query->where('service_name', 'like', '%' . $params['service_name'] . '%');
        }
        if (!empty($params['username'])) {
            $query->where('username', 'like', '%' . $params['username'] . '%');
        }
        if (!empty($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween('created_at', [$params['created_at'][0] . ' 00:00:00', $params['created_at'][1] . ' 23:59:59']);
        }
        return $query;
    }
}