<?php

declare(strict_types=1);
/**
 * This file is part of system app menu init
 * @contact  zhuovica@gmail.com
 */

return [
    'logo'=>'',
    'components_host'=>'http://127.0.0.1:5000',//the host of componets
    'menu_list' => [
        [
            'name' => '系统设置',
            'app_id' => 0,
            'parent_id' => 0,
            'code' => 'application:setting',
            'level' => '',
            'icon' => '',
            'route' => '',
            'component' => '',
            'redirect' => '',
            'is_hidden' => 0,
            'type' => 'M',
            'status' => 1,
            'version' => '1.0',
            'sort' => 0,
            'children' => [
                [
                    'name' => '菜单管理',
                    'app_id' => 0,
                    'parent_id' => 0,
                    'code' => 'application:setting:menu',
                    'level' => '',
                    'icon' => '',
                    'route' => '/setting/menu/list',
                    'component' => 'setting/menu',
                    'redirect' => '',
                    'is_hidden' => 0,
                    'type' => 'M',
                    'status' => 1,
                    'version' => '1.0',
                    'sort' => 0,
                    'children' => []
                ],
                [
                    'name' => '角色管理',
                    'app_id' => 0,
                    'parent_id' => 0,
                    'code' => 'application:setting:role',
                    'level' => '',
                    'icon' => '',
                    'route' => '/setting/role',
                    'component' => 'setting/role',
                    'redirect' => '',
                    'is_hidden' => 0,
                    'type' => 'M',
                    'status' => 1,
                    'version' => '1.0',
                    'sort' => 0,
                    'children' => []
                ],
                [
                    'name' => '权限分配',
                    'app_id' => 0,
                    'parent_id' => 0,
                    'code' => 'application:setting:authority',
                    'level' => '',
                    'icon' => '',
                    'route' => '/setting/authority',
                    'component' => 'setting/authority',
                    'redirect' => '',
                    'is_hidden' => 0,
                    'type' => 'M',
                    'status' => 1,
                    'version' => '1.0',
                    'sort' => 0,
                    'children' => []
                ],
                [
                    'name' => '应用设置',
                    'app_id' => 0,
                    'parent_id' => 0,
                    'code' => 'application:setting:appset',
                    'level' => '',
                    'icon' => '',
                    'route' => '/setting/appset',
                    'component' => 'setting/appset',
                    'redirect' => '',
                    'is_hidden' => 0,
                    'type' => 'M',
                    'status' => 1,
                    'version' => '1.0',
                    'sort' => 0,
                    'children' => []
                ]
            ]
        ]
    ]

];
