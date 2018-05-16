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

### 2018.5.13
新增假期申请，假期类型，主要问题是对herosphp了解不深，例如里面涉及到的一系列js编译工具，还有amazue ui框架


### 2018.5.14
完成假期申请功能，后续需要解决超管显示已处理申请，普通管理员显示申请，处理另外三个大功能，页面HTML过于重复，需要优化改善，

### 2018.5.15
完善假期申请功能，区别了超级管理员可以审核，管理员不可审核只可显示；修改了假期的英文单词level-》leave，修改各种文件名发现出现SQL错误,select * from leave,这里的leave没法被识别为表名是因为leave是MySQL的保留字