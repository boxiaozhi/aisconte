<?php

return [
    /*
     * --------------------------------------------------------------------------
     * Define configuration groups
     * --------------------------------------------------------------------------
     * Each configuration group will be rendered as a TAB page
     */
    'admin_config_groups' => [
        'base' => 'Base 基础设置',
        'home' => 'Home 主页',
        'frontend_nav' => 'Frontend Nav 前台导航',
    ],

    /**
     * --------------------------------------------------------------------------
     * Define configuration items
     * --------------------------------------------------------------------------
     * access：config('sample') config('sample.value')
     */
    'base' => [
        'title' => ['type' => 'text', '标题'],
    ],
    'home' => [
        'version' => ['type'=>'select', '版本', 'options'=>['v1'=>'v1', 'v2'=>'v2']],
        //'wiz_enable' => ['type'=>'switch'],
        //'wiz_category',
//        'value1'=>['help'=>'help content', 'default'=>'default value'],
//        'value2'=>['label text', 'placeholder'=>'typing...', 'rules'=>'required'],
//        'value3'=>['type'=>'select', 'select label text', 'options'=>['option1'=>'option1', 'option2'=>'option2']],
////        'value4'=>['type'=>'listbox', 'options'=>['foo'=>'foo', 'bar'=>'bar']],
//        'value5'=>['type'=>'checkbox', 'options'=>['foo'=>'foo', 'bar'=>'bar']],
//        'value6'=>['type'=>'ip'],
//        'value7'=>['type'=>'mobile'],
//        'value8'=>['type'=>'color'],
//        'value9'=>['type'=>'time', 'format'=>'HH:mm'],
//        'value10'=>['type'=>'dateRange', 'dateRange label text'],
//        'value11'=>['type'=>'number', 'min'=>100, 'default'=>100],
//        'value12'=>['type'=>'rate'],
//        'value13'=>['type'=>'image', 'uniqueName'],
//        'value14'=>['type'=>'file', 'uniqueName'],
////        'value15'=>['type'=>'multipleImage', 'removable', 'uniqueName'],
////        'value16'=>['type'=>'multipleFile', 'removable', 'uniqueName'],
//        'value17'=>['type'=>'editor'],
//        'value18'=>['type'=>'switch'],
//        'value19'=>['type'=>'tags'],
    ],

];