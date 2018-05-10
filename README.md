原框架herosphp
====
使用方法
=====
```bash
git clone https://git.oschina.net/blackfox/herosphp-app.git
cd herosphp-app
composer install
```

演示地址：
=======
### [http://herosphp.r9it.com](http://herosphp.r9it.com)

源码地址
====
码云: [http://git.oschina.net/blackfox/herosphp-app](http://git.oschina.net/blackfox/herosphp-app)

GitHub: [https://github.com/yangjian102621/herosphp-app](https://github.com/yangjian102621/herosphp-app)

herosphp/framework(框架源码地址)：
====
码云: [http://git.oschina.net/blackfox/herosphp](http://git.oschina.net/blackfox/herosphp)

GitHub: [https://github.com/yangjian102621/herosphp](https://github.com/yangjian102621/herosphp)

开发手册
========
http://docs.r9it.com/herosphp/v3.0/

学习debug:
=========

### 2018.5.8 
部署项目：自建runtime，并手动给予777权限，目的让PHP运行能够在其中生成文件


框架登录，数据库连接不上———————————— 未安装php-MySQL扩展（不熟悉Linux系统web开发相关配置） 后续发现提示Call to undefined function mb_substr_count（）也是未安装PHP拓展

### 2018.5.9
加载服务，并查询所有数据使用以下方法：

	$service = Loader::service(AdminRoleService::class);
	$roles = $service->find();
发现问题：打印出来的$roles数量只有十，原因是herosphp框架内置方法find（）只能从数据库查询10行数据，防止数据库数据过大时产生查询奔溃；

解决方法：在确认数据量不大的情况下，可以使用

$count = service->count();
$service->offset(0,$count)->find();

### 2018.5.10
$request->getParameter('data');是用来获取前端表单属性name的值,例如

	<input type="text" name="data[name]" value="{$item[name]}" placeholder="输入姓名" required>

