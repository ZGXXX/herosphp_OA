<?php

/**
 * 假期申请
 * @author zgx<605313192@qq.com>
 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;

class AdminLevelDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('level');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';

    }

}