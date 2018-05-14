<?php
namespace app\admin\service;
use app\admin\dao\AdminDao;
use herosphp\core\Loader;
use herosphp\model\CommonService;
use herosphp\session\Session;
use herosphp\string\StringUtils;
use herosphp\cache\CacheFactory;
use herosphp\cache\FileCache;

/**
 * 管理员服务
 * ----------------
 * @author yangjian<yangjian102621@gmail.com>
 */
class AdminService extends CommonService {

    protected $modelClassName = AdminDao::class;

    // 用户登录 session key
    const LOGIN_USER_SESSION_KEY = 'LOGIN_USER_SESSION_KEY';

    const MENU_CACHE_KEY = "admin_menu_cache";
    /**
     * 用户登录服务
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username, $password) {
        $item = $this->where('username', $username)->findOne();
        $_password = genPassword($password, $item['salt']);
        if ($_password != $item['password']) {
            return false;
        }

        //获取用户角色和权限
        $roleService = Loader::service(AdminRoleService::class);
        $roleIds = StringUtils::jsonDecode($item['role_ids']);
        $roles = $roleService->where('id', 'IN', $roleIds)->find();

        $permissions = [];
        foreach($roles as $value) {
            $permissions = array_merge($permissions, StringUtils::jsonDecode($value['permissions']));
        }
        $item['permissions'] = $permissions;

        Session::start();
        Session::set(self::LOGIN_USER_SESSION_KEY, $item);
        return $item;
    }

    /**
     * 获取当前登录的管理员
     */
    public function getLoginManager() {

        Session::start();
        return Session::get(self::LOGIN_USER_SESSION_KEY);
    }

    /**
     * 判断当前登录的是否为超级管理员
     */
    public function isSuperManager() {

        Session::start();
        $role_id =  Session::get(self::LOGIN_USER_SESSION_KEY)[role_ids];
        $role_id = StringUtils::jsonDecode($role_id);
        $roleService = Loader::service(AdminRoleService::class);
        $super_id = $roleService->where('name','超级管理员')->fields('id')->find();
        if (in_array($super_id[0][id],$role_id)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 登出
     */
    public function logout() {
        Session::start();
        Session::set(self::LOGIN_USER_SESSION_KEY, null);
        $cacher = CacheFactory::create(FileCache::class);
        $cacher->delete(self::MENU_CACHE_KEY);
    }

}