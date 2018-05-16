<?php

/**
 * 办公室类型
 * @author zgx<605313192@qq.com>
 */
namespace app\admin\dao;

use herosphp\model\MysqlModel;

class AdminOfficeTypeDao extends MysqlModel {

    public function __construct() {

        //创建model对象并初始化数据表名称
        parent::__construct('office_type');

        //设置表数据表主键，默认为id
        $this->primaryKey = 'id';

    }

}