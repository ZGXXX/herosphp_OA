<?php
namespace app\admin\service;
use app\admin\dao\AdminLevelTypeDao;
use herosphp\model\CommonService;

/**
 * 假期类型服务
 * ----------------
 * @author zgx<605313192@qq.com>
 */
class AdminLevelTypeService extends CommonService {

    protected $modelClassName = AdminLevelTypeDao::class;
}