<?php

declare (strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemApi;
use App\System\Model\SystemApp;
use App\System\Model\SystemAppMenu;
use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Db;
use Mine\Abstracts\AbstractMapper;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
/**
 * Class SystemAppMapper
 * @package App\System\Mapper
 */
class SystemAppMenuMapper extends AbstractMapper
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
     * @var SystemApp
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemAppMenu::class;
    }
}