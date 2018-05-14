<?php
namespace app\admin\action;

use herosphp\core\Loader;
use herosphp\http\HttpRequest;
use app\admin\service\AdminLevelService;
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
        $levelService = Loader::service(AdminLevelService::class);
        $myLevel = $levelService->myLevelList();
        $this->assign('items', $myLevel);
        $this->assign('delete_url',"/admin/level/detele");

        //如果是超级管理员则显示处理面板
        $adminService = Loader::service(AdminService::class);
        $isSuper = $adminService->isSuperManager();
        if ($isSuper) {
            $this->assign('isSuper',$isSuper);
            //待处理的假期申请,参数0
            $level_wait = $levelService->levelList(0);
            $this->assign('level_wait', $level_wait);
        }
        $this->setView("index");
    }

    /**
     * 404 页面
     */
    public function page404(HttpRequest $request) {
        $this->setView('404');
    }

    /**
     * 403 页面
     */
    public function page403(HttpRequest $request) {
        $this->setView('403');
    }


}