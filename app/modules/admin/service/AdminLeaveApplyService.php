<?php
namespace app\admin\service;

use app\admin\dao\AdminLeaveApplyDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
/**
 * 假期申请服务
 * ----------------
 * @author zgx<605313192@qq.com>
 */
class AdminLeaveApplyService extends CommonService {
    protected $modelClassName = AdminLeaveApplyDao::class;
    /**
     * 下拉假期列表
     */
    public function showLeaveType() {
        $leaveTypeService = Loader::service(AdminLeaveTypeService::class);
        $count = $leaveTypeService->count();
        $type = $leaveTypeService->where('enable', 1)->order('id ASC')->offset(0,$count)->find();
        return $type;
    }
    /**
     * 我的假期申请
     */
    public function myLeaveList() {
        $user_id = $_SESSION[LOGIN_USER_SESSION_KEY][id];
        $leaveList = $this->order('id ASC')->where('user_id',$user_id)->find();
        return $leaveList;
    }
    /**
     * 管理员处理假期申请
     */
    public function leaveList($status = array()) {
        $levelList = $this->order('id ASC')->where('status','IN',$status)->find();
        return $levelList;
    }
}