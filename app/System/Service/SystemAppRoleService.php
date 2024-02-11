<?php

declare(strict_types=1);
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
    /**
     * @var SystemAppRoleMapper
     */
    public $mapper;

    public function __construct(SystemAppRoleMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}