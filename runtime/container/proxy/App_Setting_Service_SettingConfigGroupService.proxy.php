<?php

declare (strict_types=1);
namespace App\Setting\Service;

use App\Setting\Mapper\SettingConfigGroupMapper;
use Mine\Abstracts\AbstractService;
use Mine\Annotation\Transaction;
class SettingConfigGroupService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SettingConfigGroupMapper
     */
    public $mapper;
    /**
     * SettingConfigGroupService constructor.
     * @param SettingConfigGroupMapper $mapper
     */
    public function __construct(SettingConfigGroupMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
    /**
     * 删除配置组和其所属配置
     * @param int $id
     * @return bool
     */
    #[Transaction]
    public function deleteConfigGroup(int $id) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (int $id) use($__function__, $__method__) {
            return $this->mapper->deleteGroupAndConfig($id);
        });
    }
}