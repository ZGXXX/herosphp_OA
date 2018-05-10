<?php
/*---------------------------------------------------------------------
 * 数据库连接配置文件
 * ---------------------------------------------------------------------
 * Copyright (c) 2013-now http://blog518.com All rights reserved.
 * ---------------------------------------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------------------------------------
 * Author: <yangjian102621@gmail.com>
 *-----------------------------------------------------------------------*/
define('DB_ACCESS', DB_ACCESS_SINGLE);  //默认使用单台数据库服务器
return array(
    //mysql数据库配置
    'mysql'     =>  array(
        [
            'db_type'      => 'mysql',
            'db_host'      => '172.28.1.3',
            'db_port'      => 3306,
            'db_user'      => 'zhaogx',
            'db_pass'      => '123456',
            'db_name'      => 'zhaogx_demo',
            'db_charset'   => 'utf8',
            'serial'       => 'db-write',     //写服务器,如果没有配置读写分离，则此处不用理它
        ]
    )
);
