<?php

declare (strict_types=1);
namespace App\System\Service;

use App\System\Mapper\SystemPostMapper;
use Mine\Abstracts\AbstractService;
class SystemPostService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SystemPostMapper
     */
    public $mapper;
    public function __construct(SystemPostMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
}