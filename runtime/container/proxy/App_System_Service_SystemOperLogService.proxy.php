<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemOperLogMapper;
use Mine\Abstracts\AbstractService;
use Mine\Annotation\DependProxy;
use Mine\Interfaces\ServiceInterface\OperLogServiceInterface;
#[DependProxy(values: [OperLogServiceInterface::class])]
class SystemOperLogService extends AbstractService implements OperLogServiceInterface
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    public $mapper;
    public function __construct(SystemOperLogMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}