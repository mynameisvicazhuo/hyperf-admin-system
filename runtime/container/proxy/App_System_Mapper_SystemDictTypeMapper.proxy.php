<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemDictData;
use App\System\Model\SystemDictType;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\Transaction;
/**
 * Class SystemUserMapper
 * @package App\System\Mapper
 */
class SystemDictTypeMapper extends AbstractMapper
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
     * @var SystemDictType
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemDictType::class;
    }
    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    #[Transaction]
    public function update(int $id, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id, array $data) use($__function__, $__method__) {
            parent::update($id, $data);
            SystemDictData::where('type_id', $id)->update(['code' => $data['code']]) > 0;
            return true;
        });
    }
    /**
     * @param array $ids
     * @return bool
     */
    #[Transaction]
    public function realDelete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $ids) use($__function__, $__method__) {
            foreach ($ids as $id) {
                $model = $this->model::withTrashed()->find($id);
                if ($model) {
                    $model->dictData()->forceDelete();
                    $model->forceDelete();
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
        if (!empty($params['code'])) {
            $query->where('code', 'like', '%' . $params['code'] . '%');
        }
        if (!empty($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }
        return $query;
    }
}