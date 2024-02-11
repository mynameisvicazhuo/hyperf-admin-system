<?php

declare(strict_types=1);
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
    /**
     * @var SystemAppPromissionMapper
     */
    public $mapper;

    public function __construct(SystemAppPromissionMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}