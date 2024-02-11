<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemAppPromissionMapper;
use Mine\Abstracts\AbstractService;
/**
 * app应用业务
 * Class SystemAppService
 * @package App\System\Service
 */
class SystemAppPromissionService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SystemAppPromissionMapper
     */
    public $mapper;
    public function __construct(SystemAppPromissionMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}