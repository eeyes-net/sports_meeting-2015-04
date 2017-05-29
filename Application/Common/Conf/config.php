<?php

return array(
    // 默认启动模块
    'DEFAULT_MODULE' => 'Home',
    // 是否开启模板缓存
    'TMPL_CACHE_ON' => false,

    // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_MODEL' => 0,
    // 数据库配置
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'sports_meeting-2015-04',
    'DB_USER' => 'sports_meeting-2015-04',
    'DB_PWD' => '',
    'DB_PORT' => '3306',
    'DB_PREFIX' => '',
    'DB_CHARSET' => 'utf8',
);
