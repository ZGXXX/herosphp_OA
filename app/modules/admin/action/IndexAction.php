<?php
namespace app\admin\action;

use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\admin\service\AdminLeaveApplyService;
use app\admin\service\AdminService;

/**
 * 后台
 * @author  yangjian<yangjian102621@gmail.com>
 */
class IndexAction extends CommonAction {

    /**
     * 列表
     * @param HttpRequest $request
     */
    public function index(HttpRequest $request) {
        //首页我的申请--假期申请
        $leaveService = Loader::service(AdminLeaveApplyService::class);
        $myLeave = $leaveService->myLeaveList();
        $this->assign('items', $myLeave);
        $this->assign('delete_url',"/admin/leave/detele");

        //如果是管理员则显示处理面板
        $adminService = Loader::service(AdminService::class);
        $isManager = $adminService->isManager();
        if ($isManager) {
            $this->assign('isManager',$isManager);
            //如果是超级管理员
            if (in_array('超级管理员',$isManager)) {
                $this->assign('isSuper',true);
            }
            //待处理的假期申请,参数array(0)
            $leave_wait = $leaveService->leaveList(array(0));
            $this->assign('leave_wait', $leave_wait);
            //已处理的假期申请,参数array(1,2)
            $leave_dealed = $leaveService->leaveList(array(1,2));
            $this->assign('leave_dealed', $leave_dealed);
        }

        $this->setView("index");
    }

}