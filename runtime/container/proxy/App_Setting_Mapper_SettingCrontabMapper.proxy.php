<?php

declare (strict_types=1);
namespace App\Setting\Mapper;

use App\Setting\Model\SettingCrontab;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\Transaction;
class SettingCrontabMapper extends AbstractMapper
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
     * @var SettingCrontab
     */
    public $model;
    public function assignModel()
    {
        $this->model = SettingCrontab::class;
    }
    /**
     * @param array $ids
     * @return bool
     * @throws \Exception
     */
    #[Transaction]
    public function delete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $ids) use($__function__, $__method__) {
            foreach ($ids as $id) {
                $model = $this->model::find($id);
                if ($model) {
                    $model->logs()->delete();
                    $model->delete();
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
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }
        if (!empty($params['type'])) {
            $query->where('type', $params['type']);
        }
        if (!empty($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween('created_at', [$params['created_at'][0] . ' 00:00:00', $params['created_at'][1] . ' 23:59:59']);
        }
        return $query;
    }
}