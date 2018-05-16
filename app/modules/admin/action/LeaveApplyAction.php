<?php
namespace app\admin\action;

use app\admin\service\AdminLeaveApplyService;
use herosphp\http\HttpRequest;
use herosphp\utils\JsonResult;

/**
 * 假期调休申请控制器
 * @author  zgx<605313192@qq.com>
 */
class LeaveApplyAction extends CommonAction {

    protected $serviceClass = AdminLeaveApplyService::class;

    protected $actionTitle = "假期";

    /**
     * 假期调休申请页面
     */
    public function index(HttpRequest $request) {
        $this->setView('leave/leave_index');

        $items = $this->service->showLeaveType();
        $this->assign('items', $items);

        $user_id = $_SESSION[LOGIN_USER_SESSION_KEY][id];
        $this->assign('user_id', $user_id);

    }

    /**
     * 添加数据
     * @param HttpRequest $request
     */
    public function add(HttpRequest $request) {

    }

    /**
     * 修改数据
     * @param HttpRequest $request
     */
    public function edit(HttpRequest $request) {
        parent::_edit($request);
        $item = $this->getTemplateVar('item');
        if (empty($item)) {
            JsonResult::fail(Lang::FETCH_FAIL);
        } else {
            $json = new JsonResult();
            $json->setCode(JsonResult::CODE_SUCCESS);
            $json->setItem($item);
            $json->output();
        }

    }

    /**
     * 更新数据
     * @param HttpRequest $request
     */
    public function update(HttpRequest $request) {
        $data = $request->getParameter('data');
        $id = $request->getParameter('id', 'intval');
        parent::_update($data, $id);
    }

    /**
     * 插入数据
     * @param HttpRequest $request
     */
    public function insert(HttpRequest $request) {
        $data = $request->getParameter('data');
        $data['status'] = 0;
        parent::_insert($data);
    }

    /**
     * 取消申请
     * @param HttpRequest $request
     */
    public function detele(HttpRequest $request) {
        $id = $request->getParameter('id', 'intval');
        $data[status] = 3;
        parent::_update($data, $id);
    }

}