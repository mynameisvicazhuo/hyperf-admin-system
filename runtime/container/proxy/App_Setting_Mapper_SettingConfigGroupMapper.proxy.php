<?php

declare (strict_types=1);
namespace App\Setting\Mapper;

use App\Setting\Model\SettingConfigGroup;
use Mine\Abstracts\AbstractMapper;
class SettingConfigGroupMapper extends AbstractMapper
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
     * @var SettingConfigGroup
     */
    public $model;
    public function assignModel()
    {
        $this->model = SettingConfigGroup::class;
    }
    /**
     * 删除组和所属配置
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteGroupAndConfig(int $id) : bool
    {
        /* @var $model SettingConfigGroup */
        $model = $this->read($id);
        $model->configs()->delete();
        return $model->delete();
    }
}