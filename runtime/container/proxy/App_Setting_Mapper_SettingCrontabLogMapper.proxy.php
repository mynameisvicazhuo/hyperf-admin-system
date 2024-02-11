<?php

declare (strict_types=1);
namespace App\Setting\Mapper;

use App\Setting\Model\SettingCrontabLog;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
class SettingCrontabLogMapper extends AbstractMapper
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
     * @var SettingCrontabLog
     */
    public $model;
    public function assignModel()
    {
        $this->model = SettingCrontabLog::class;
    }
    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        if ($params['crontab_id'] ?? false) {
            $query->where('crontab_id', $params['crontab_id']);
        }
        return $query;
    }
}