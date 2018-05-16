<?php
namespace app\admin\service;
use app\admin\dao\AdminLeaveTypeDao;
use herosphp\model\CommonService;

/**
 * 假期类型服务
 * ----------------
 * @author zgx<605313192@qq.com>
 */
class AdminLeaveTypeService extends CommonService {

    protected $modelClassName = AdminLeaveTypeDao::class;

    public function myLeaveList() {
        $leaveList = $this->find();
        return $leaveList;
    }
}