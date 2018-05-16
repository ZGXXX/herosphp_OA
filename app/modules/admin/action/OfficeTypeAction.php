<?php
namespace app\admin\action;

use app\admin\service\AdminOfficeeTypeService;
use herosphp\http\HttpRequest;
use herosphp\utils\JsonResult;

/**
 * 假期类型控制器
 * @author  zgx<605313192@qq.com>
 */
class OfficeTypeAction extends CommonAction {

    protected $serviceClass = AdminOfficeeTypeService::class;

    protected $actionTitle = "类型";

    /**
     * 假期类型列表
     */
    public function index(HttpRequest $request) {
        parent::index($request);

        $this->setView('leave/leave_type');
        $this->setOpt($this->actionTitle."列表");
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
        $data['enable'] = 1;
//        __print($data);exit();
        parent::_insert($data);
    }
}