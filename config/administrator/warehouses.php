<?php

use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

return [
    'title'   => '仓库',
    'single'  => '仓库',
    'model'   => Warehouse::class,
    'permission'=> function()
    {
        return Auth::user()->can('manage_warehouses');
    },

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],
        'housename' => [
            'title'    => '仓库名',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],
        'description' => [
            'title'    => '仓库描述',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },
        ],
        'user' => [
            'title'    => '仓库创建者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->user->name;
                return model_link($value, $model->user);
            },
        ],
        // 'category' => [
        //     'title'    => '分类',
        //     'sortable' => false,
        //     'output'   => function ($value, $model) {
        //         return model_admin_link($model->category->name, $model->category);
        //     },
        // ],

        'plate_count' => [
            'title'    => '板件数',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'housename' => [
            'title'    => '仓库名',
        ],
        'description' => [
            'title'    => '仓库描述',
            'type'               => 'textarea',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],
        // 'category' => [
        //     'title'              => '分类',
        //     'type'               => 'relationship',
        //     'name_field'         => 'name',
        //     'search_fields'      => ["CONCAT(id, ' ', name)"],
        //     'options_sort_field' => 'id',
        // ],
        'plate_count' => [
            'title'    => '板件数',
        ],

    ],
    'filters' => [
        'id' => [
            'title' => '仓库 ID',
        ],
        'housename' => [
            'title'    => '仓库名',
        ],
        'description' => [
            'title'    => '仓库描述',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        // 'category' => [
        //     'title'              => '分类',
        //     'type'               => 'relationship',
        //     'name_field'         => 'name',
        //     'search_fields'      => array("CONCAT(id, ' ', name)"),
        //     'options_sort_field' => 'id',
        // ],
    ],
    'rules'   => [
        'housename' => 'required'
    ],
    'messages' => [
        'housename.required' => '请填写仓库名',
    ],
];
