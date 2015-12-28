<?php
define('SYSTEM_FN','百度贴吧云签到');
define('SYSTEM_VER','4.0');
define('SYSTEM_ROOT2',dirname(__FILE__));
define('SYSTEM_ROOT',dirname(__FILE__).'/..');
define('SYSTEM_PAGE',isset($_REQUEST['mod']) ? strip_tags($_REQUEST['mod']) : 'default');
header("content-type:text/html; charset=utf-8");
require SYSTEM_ROOT2.'/../lib/msg.php';
include SYSTEM_ROOT2.'/../lib/class.wcurl.php';

if (file_exists(SYSTEM_ROOT2.'/install.lock')) {
    msg('错误：安装锁定，请删除以下文件后再安装：<br/><br/>/setup/install.lock<br/><br/>或者点击下面的按钮返回站点取消安装：', '../');
}
/*
$csrf = !empty($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : '';
if ( isset($_GET['step']) && ( empty($csrf['host']) || $csrf['host'] != $_SERVER['SERVER_NAME'] ) ) {
	msg('安装程序检测到来源异常，已被拦截，请按步骤进行安装！点击返回重新操作','index.php');
}
*/

	echo '<!DOCTYPE html><html><head>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0">';
	echo '<link href="../favicon.ico" rel="shortcut icon"/>';
	echo '<title>安装向导 - '.SYSTEM_FN.'</title><meta name="generator" content="God.Kenvix\'s Blog (http://zhizhe8.net) and StusGame GROUP (http://www.stus8.com)" /></head><body>';
	echo '<script src="../source/js/jquery.min.js"></script>';
	echo '<link rel="stylesheet" href="../source/css/bootstrap.min.css">';
	echo '<script src="../source/js/bootstrap.min.js"></script>';
	echo '<style type="text/css">body { font-family:"微软雅黑","Microsoft YaHei";background: #eee; }</style>';
?>
<div class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">贴吧云签到</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="install.php">贴吧云签到安装</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
          <li><a href="http://www.stus8.com" target="_blank">StusGame GROUP</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</div>
<div style="width:90%;margin: 0 auto;overflow: hidden;position: relative;">
<?php
	if (!isset($_GET['step']) || $_GET['step'] == 0) {
		echo '<h2>阅读许可协议</h2><br/>';
		echo '<iframe src="../license.html" style="width:100%;height:465px;"></iframe>';
		echo '<br/><br/><input type="button" onclick="if(confirm(\'“我尊重原作者为云签事业付出的心血，在使用该永久免费的云签系统的同时将保护原作者的版权。\r\n保证原作者的名称、链接等版权信息不被删改、淡化或遮挡，如果我没有做到，自愿承担由此引发的所有不良后果”\r\n\r\n同意请确定，不同意请取消\')){location = \'install.php?step=1\';} else {alert(\'请立即删除所有与本程序相关的文件及其延伸产品\');location = \'index.html\';}" class="btn btn-success" value="我接受">&nbsp;&nbsp;&nbsp;';
		echo '<input type="button" onclick=";alert(\'请立即删除所有与本程序相关的文件及其延伸产品\');location = \'index.html\';" class="btn btn-danger" value="我拒绝">';
	} else {
		switch (strip_tags($_GET['step'])) {
			case '1':
				echo '<h2>准备安装: 功能检查</h2><br/>';
				echo '<div class="progress progress-striped">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
			    <span class="sr-only">10%</span>
			  </div>
			</div>';
		define('DO_NOT_LOAD_UI', TRUE);
		include SYSTEM_ROOT2.'/check.php';
		echo '<input type="button" onclick="location = \'install.php?step=2\'" class="btn btn-success" value="下一步 >>">';
				break;

			case '2':
				echo '<h2>准备安装: 设置运行环境</h2><br/>';
				echo '<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
    <span class="sr-only">20%</span>
  </div>
</div>';
				echo '<h4>你是在应用引擎或者不可写的主机上使用本程序吗？</h4><br/>';
				echo '<li><a href="install.php?step=3">很明显不是(这不是OpenShit嘛（误</a></li><br/>';
				break;

			case '3':
				echo '<h2>设置所需信息</h2><br/>';
				echo '<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
    <span class="sr-only">30%</span>
  </div>
</div>';
				echo '</div><h4>站点创始人信息</h4><br/>';
				echo '<div class="input-group"><span class="input-group-addon">创始人用户名</span><input type="text" required class="form-control" name="user" placeholder=""></div><br/>';
				echo '<div class="input-group"><span class="input-group-addon">创始人邮箱</span><input type="email" required class="form-control" name="mail" placeholder=""></div><br/>';
				echo '<div class="input-group"><span class="input-group-addon">创始人密码</span><input type="password" required class="form-control" name="pw" placeholder=""></div><br/>';
				//echo '<div class="input-group"><span class="input-group-addon">工具箱执行密码</span><input type="password" required class="form-control" name="toolpw" placeholder=""></div><br/>';
				echo '<br/><br/><input type="submit" class="btn btn-success" value="下一步 >>"></form>';
				break;

			case '4':
				$errorhappen = '';
				if (isset($_SERVER['HTTPS']) == 'on') {
					$http = 'https://';
				} else {
					$http = 'http://';
				}
				if (isset($_POST['isbae'])) {
					$isapp = '1';
				} else {
					$isapp = '0';
				}
				preg_match("/^.*\//", $_SERVER['SCRIPT_NAME'], $sysurl);
				if($_POST['from_config'] == 1) {
					require SYSTEM_ROOT2.'/../config.php';
				} else {
					define('DB_HOST',$_POST['dbhost']);
					define('DB_USER',$_POST['dbuser']);
					define('DB_PASSWD',$_POST['dbpw']);
					define('DB_NAME',$_POST['dbname']);
					define('DB_PREFIX',$_POST['dbprefix']);
				}
				$sql  = str_ireplace('{VAR-PREFIX}', DB_PREFIX, file_get_contents(SYSTEM_ROOT2.'/install.template.sql'));
				$sql  = str_ireplace('{VAR-DB}', DB_NAME, $sql);
				$sql  = str_ireplace('{VAR-ISAPP}', $isapp, $sql);
				$sql  = str_ireplace('{VAR-TOOLPW}', '', $sql);
				//$sql  = str_ireplace('{VAR-TOOLPW}', md5(md5(md5($_POST['toolpw']))), $sql);
				$sql  = str_ireplace('{VAR-SYSTEM-URL}', $http . $_SERVER['HTTP_HOST'] . str_ireplace('setup/', '', $sysurl[0]), $sql);
				$sql .= "\n"."INSERT INTO `".DB_NAME."`.`".DB_PREFIX."users` (`name`, `pw`, `email`, `role`) VALUES ('{$_POST['user']}', '".md5(md5(md5($_POST['pw'])))."', '{$_POST['mail']}', 'admin');";
				if (!isset($_POST['nosql'])) {
					require SYSTEM_ROOT.'/lib/mysql_autoload.php';
					global $m;
					$testInstall = $m->fetch_row($m->query("SHOW TABLES LIKE '".DB_PREFIX."users'"));
					if (!empty($testInstall[0])) {
						if (!empty($_POST['force_user']) && !empty($_POST['force_pw'])) {
							$force_user = !empty($_POST['force_user']) ? addslashes($_POST['force_user']) : msg('请输入原站点的管理员用户名');
							$force_pw   = !empty($_POST['force_pw'])   ? addslashes($_POST['force_pw'])   : msg('请输入原站点的管理员密码');
							$account    = $m->once_fetch_array("SELECT * FROM `".DB_PREFIX."users` WHERE `name` = '{$force_user}';");
							if (empty($account['role'])) {
								msg('原站点的管理员用户名错误，请返回重新输入');
							} elseif ($account['pw'] != md5(md5(md5($force_pw)))) {
								msg('原站点的管理员密码错误，请返回重新输入<br/><br/>注：暂时不支持自定义加密方式的用户重装站点');
							} elseif ($account['role'] != 'admin') {
								msg('权限不足');
							}
						} else {
							echo '<h2>请输入原站点的管理员用户名和密码</h2><br/>';
							echo '<div class="progress progress-striped"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 50%"><span class="sr-only">50%</span></div></div>';
							echo '检测到站点已经安装过 '.SYSTEM_FN . ' 了，如果需要继续安装，请输入待覆盖站点管理员用户名和密码（不是刚才输入的创始人用户名和密码）<br/><br/>如果继续安装，您的站点的数据将会全部恢复到云签到初始状态<br/><br/>';
							echo '<form action="install.php?step=4" method="post">';
							echo '<div class="input-group"><span class="input-group-addon" id="basic-addon1">用户名</span><input type="text" class="form-control" name="force_user" required></div><br/>';
							echo '<div class="input-group"><span class="input-group-addon" id="basic-addon1">密码</span><input type="password" class="form-control" name="force_pw" required></div><br/>';
							foreach ($_POST as $key => $value) {
								echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
							}
							echo '<br/><input type="submit" class="btn btn-success" value="下一步 >>"></form>';
							die;
						}
					}
				}
				
			    
			case '5':
				echo '<h2>安装完成</h2><br/>';
				echo '<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
    <span class="sr-only">90%</span>
  </div>
</div>';
				echo '恭喜你，安装已经完成<br/><br/>为保证站点安全，系统已在 /setup 文件夹下放置了 install.lock 文件，如果您的服务器不支持写入，请手动放置一个空的 install.lock 文件到此文件夹下，否则任何人都有权限重新安装您的云签到。<br/><br/><b>请您尊重作者，无论如何都不要删减云签到的版权</b><br/><br/><input type="button" onclick="location = \'../index.php\'" class="btn btn-success" value="进入我的云签到 >>">';
				@file_put_contents(SYSTEM_ROOT2.'/install.lock', '1');
				break;

			default:
				msg('未定义操作');
				break;
		}
	}
?>
</div>