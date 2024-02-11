<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemApiLogMapper;
use Mine\Abstracts\AbstractService;
/**
 * api日志业务
 * Class SystemAppService
 * @package App\System\Service
 */
class SystemApiLogService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SystemApiLogMapper
     */
    public $mapper;
    public function __construct(SystemApiLogMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}