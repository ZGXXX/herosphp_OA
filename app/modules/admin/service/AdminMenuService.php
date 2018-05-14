<?php
namespace app\admin\service;

use herosphp\cache\CacheFactory;
use herosphp\cache\FileCache;
use herosphp\model\CommonService;
use app\admin\dao\AdminMenuDao;
use herosphp\utils\ArrayUtils;

/**
 * 管理员菜单服务
 * @author yangjian<yangjian102621@gmail.com>
 */
class AdminMenuService extends CommonService {

	protected $modelClassName = AdminMenuDao::class;

    const MENU_CACHE_KEY = "admin_menu_cache";

//    /**
//     * 判断登录人可以显示哪些菜单
//     */
//    public function getFirstMenu($items) {
//        $userPermissions =  array_keys($_SESSION[ LOGIN_USER_SESSION_KEY][permissions]);
//        foreach ($items as $k => $v) {
//            foreach ($userPermissions as $k_in => $v_in) {
//                $permissions = array_column($v[subs],"permission");
//                if (!in_array($permissions,$userPermissions)) {
//                    unset($items[$k]);
//                }
//            }
//        }
//        return $items;
//    }

    /**
     * 菜单列表显示所有菜单（管理员可用）
     */
    public function showMenu() {
        // 获取一级菜单
        $topMenus = $this->order('sort ASC')->where('pid', 0)->find();
        $count = $this->count();
        $menus = $this->order('sort ASC')->offset(0,$count)->find();

        foreach ($topMenus as $k => $v) {
            $topMenus[$k]['subs'] = ArrayUtils::filterArrayByKey('pid', $v['id'], $menus);
        }
        return $topMenus;
    }

    /**
     * 获取菜单缓存
     */
    public function getMenuCache() {
        $cacher = CacheFactory::create(FileCache::class);
        $items = $cacher->get(self::MENU_CACHE_KEY);
        if (empty($items)) {
            $this->updateMenuCache();
            return $cacher->get(self::MENU_CACHE_KEY);
        }
        return $items;
    }

    /**
     * 更新菜单缓存
     */
    public function updateMenuCache() {
        // 获取一级菜单
        $topMenus = $this->order('sort ASC')->where('pid', 0)->find();
        $count = $this->count();
        $menus = $this->order('sort ASC')->offset(0,$count)->find();

        $userMenus = array();
        $userPermissions =  array_keys($_SESSION[ LOGIN_USER_SESSION_KEY][permissions]);
//        __print($menus);exit();
        foreach ($userPermissions as $out_v){
            foreach ($menus as $in_v){
                if ($out_v == $in_v["permission"]) {
                    $userMenus[] = $in_v;
                }
            }
        }
        foreach ($topMenus as $k => $v) {
            $topMenus[$k]['subs'] = ArrayUtils::filterArrayByKey('pid', $v['id'], $userMenus);
        }

        $cacher = CacheFactory::create(FileCache::class);
        $cacher->set(self::MENU_CACHE_KEY, $topMenus, 0);
    }

}