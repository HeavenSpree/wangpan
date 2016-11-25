<?php
//MySQL主机
define('DB_HOST', 'localhost');

//MySQL主机端口
define('DB_PORT',3306);

//MySQL数据库用户名
define('DB_USER', 'username');

//MySQL数据库密码
define('DB_PASSWORD', 'password');

//数据库的名称
define('DB_NAME', 'database_name');

//创建表时默认的编码
define('DB_CHARSET', 'utf8');

//数据库排序规则
define('DB_COLLATE', '');

//数据库表前缀
$table_prefix  = '';

//上传文件的保存路径
$filedir=dirname(__FILE__).'/upload_file/';

//身份认证盐
define('KEY',        'put your unique phrase here');
