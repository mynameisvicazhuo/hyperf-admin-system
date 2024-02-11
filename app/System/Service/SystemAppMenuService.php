<?php

declare(strict_types=1);

namespace App\System\Service;

use App\System\Mapper\SystemAppMenuMapper;
use Mine\Abstracts\AbstractService;

/**
 * app应用业务
 * Class SystemAppService
 * @package App\System\Service
 */
class SystemAppMenuService extends AbstractService
{
    /**
     * @var SystemAppMenuMapper
     */
    public $mapper;

    public function __construct(SystemAppMenuMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function create()
    {
        $list = config('app_menu.menu_list');
        $data=[];
        foreach ($list as $val) {
            $childrens = $val['children'];
            unset($val['children']);
            if($menu_id = $this->mapper->save($val)) {
                foreach ($childrens as $child => $item) {
                    unset($item['children']);
                    $item['parent_id'] = $menu_id;
                    $this->mapper->save($item);
                    $data[] = $item;
                }
            }
        }
        return $data;
    }

    /**
     * @param array|null $params
     * @param bool $isScope
     * @return array
     */
    public function getTreeList(?array $params = null, bool $isScope = true): array
    {
        $params = array_merge(['orderBy' => 'sort', 'orderType' => 'desc'], $params);
        return parent::getTreeList($params, $isScope);
    }
}