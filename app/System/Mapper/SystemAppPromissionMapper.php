<?php
declare(strict_types=1);
namespace App\System\Mapper;

use App\System\Model\SystemApi;
use App\System\Model\SystemApp;
use App\System\Model\SystemAppMenu;
use App\System\Model\SystemAppPromission;
use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Db;
use Mine\Abstracts\AbstractMapper;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class SystemAppMapper
 * @package App\System\Mapper
 */
class SystemAppPromissionMapper extends AbstractMapper
{
    /**
     * @var SystemApp
     */
    public $model;

    public function assignModel()
    {
        $this->model = SystemAppPromission::class;
    }

}