<?php
namespace app\admin\service;
use app\admin\dao\AdminOfficeTypeDao;
use herosphp\model\CommonService;

/**
 * 办公室类型服务
 * ----------------
 * @author zgx<605313192@qq.com>
 */
class AdminOfficeeTypeService extends CommonService
{

    protected $modelClassName = AdminOfficeTypeDao::class;

    public function myLeaveList()
    {
        $leaveList = $this->find();
        return $leaveList;
    }
}