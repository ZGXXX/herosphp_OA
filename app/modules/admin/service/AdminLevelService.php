<?php
namespace app\admin\service;
use app\admin\dao\AdminLevelDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;

/**
 * 假期申请服务
 * ----------------
 * @author zgx<605313192@qq.com>
 */
class AdminLevelService extends CommonService {

    protected $modelClassName = AdminLevelDao::class;

    /**
     * 下拉假期列表
     */
    public function showLevelType() {
        $levelTypeService = Loader::service(AdminLevelTypeService::class);

        $count = $levelTypeService->count();
        $type = $levelTypeService->where('enable', 1)->order('id ASC')->offset(0,$count)->find();
        return $type;
    }

    /**
     * 我的假期申请
     */
    public function myLevelList() {
        $user_id = $_SESSION[LOGIN_USER_SESSION_KEY][id];
        $levelList = $this->order('id ASC')->where('user_id',$user_id)->find();
        return $levelList;
    }

    /**
     * 管理员处理假期申请
     */
    public function levelList($status) {
        $levelList = $this->order('id ASC')->where('status',$status)->find();
        return $levelList;
    }
}