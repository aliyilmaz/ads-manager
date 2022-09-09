<?php

require './Mind.php';

$conf = array(
    'db'=>[
        'drive'     =>  'mysql', // mysql, sqlite, sqlsrv
        'host'      =>  'localhost', // sqlsrv için: www.example.com\\MSSQLSERVER,'.(int)1433
        'dbname'    =>  'ads', // ads, app/migration/ads.sqlite
        'username'  =>  'root',
        'password'  =>  '',
        'charset'   =>  'utf8mb4'
    ]
);
$Mind = new Mind($conf);

$Mind->route('/', ['app/model/banner/banners', 'app/views/panel/banner/banners'], 'app/migration/install');
$Mind->route('panel/banners:p', ['app/model/banner/banners', 'app/views/panel/banner/banners']);
$Mind->route('panel/banner/add', 'app/views/panel/banner/add');
$Mind->route('panel/banner/edit:banner_id', 'app/views/panel/banner/edit');
$Mind->route('panel/banner/status:banner_id', 'app/request/panel/banner/status');
$Mind->route('panel/banner/remove:banner_id', 'app/request/panel/banner/remove');
$Mind->route('panel/banner/', 'app/views/panel/banner/banners');
$Mind->route('panel/active_ads', 'app/views/panel/banner/active_ads');
$Mind->route('panel/inactive_ads', 'app/views/panel/banner/inactive_ads');
$Mind->route('panel/backup', 'app/request/backup');
