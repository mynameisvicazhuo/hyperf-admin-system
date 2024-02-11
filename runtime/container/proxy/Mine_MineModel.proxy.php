<?php

/**
 * MineAdmin is committed to providing solutions for quickly building web applications
 * Please view the LICENSE file that was distributed with this source code,
 * For the full copyright and license information.
 * Thank you very much for using MineAdmin.
 *
 * @Author X.Mo<root@imoi.cn>
 * @Link   https://gitee.com/xmo/MineAdmin
 */
declare (strict_types=1);
namespace Mine;

use Hyperf\DbConnection\Model\Model;
use Hyperf\ModelCache\Cacheable;
use Mine\Traits\ModelMacroTrait;
/**
 * Class MineModel
 * @package Mine
 */
class MineModel extends Model
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    use Cacheable, ModelMacroTrait;
    /**
     * 隐藏的字段列表
     * @var string[]
     */
    protected array $hidden = ['deleted_at'];
    /**
     * 数据权限字段，表中需要有此字段
     */
    protected string $dataScopeField = 'created_by';
    /**
     * 状态
     */
    public const ENABLE = 1;
    public const DISABLE = 2;
    /**
     * 默认每页记录数
     */
    public const PAGE_SIZE = 15;
    /**
     * MineModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->__handlePropertyHandler(__CLASS__);
        parent::__construct($attributes);
        //注册常用方法
        $this->registerBase();
        //注册用户数据权限方法
        $this->registerUserDataScope();
    }
    /**
     * 设置主键的值
     * @param string | int $value
     */
    public function setPrimaryKeyValue($value) : void
    {
        $this->{$this->primaryKey} = $value;
    }
    /**
     * @return string
     */
    public function getPrimaryKeyType() : string
    {
        return $this->keyType;
    }
    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = []) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $options = []) use($__function__, $__method__) {
            return parent::save($options);
        });
    }
    /**
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function (array $attributes = [], array $options = []) use($__function__, $__method__) {
            return parent::update($attributes, $options);
        });
    }
    /**
     * @param array $models
     * @return MineCollection
     */
    public function newCollection(array $models = []) : MineCollection
    {
        return new MineCollection($models);
    }
    /**
     * @return string
     */
    public function getDataScopeField() : string
    {
        return $this->dataScopeField;
    }
    /**
     * @param string $name
     * @return MineModel
     */
    public function setDataScopeField(string $name) : self
    {
        $this->dataScopeField = $name;
        return $this;
    }
}