<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemLoginLogMapper;
use Mine\Abstracts\AbstractService;
/**
 * 登录日志业务
 * Class SystemLoginLogService
 * @package App\System\Service
 */
class SystemLoginLogService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SystemLoginLogMapper
     */
    public $mapper;
    public function __construct(SystemLoginLogMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}