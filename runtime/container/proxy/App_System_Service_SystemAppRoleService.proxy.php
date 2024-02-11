<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemAppRoleMapper;
use Mine\Abstracts\AbstractService;
/**
 * app应用业务
 * Class SystemAppService
 * @package App\System\Service
 */
class SystemAppRoleService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SystemAppRoleMapper
     */
    public $mapper;
    public function __construct(SystemAppRoleMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}