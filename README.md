# Tieba-Cloud-Sign-OpenShift-QuickStart
一个用于在Openshift上快速部署MoeNetwork编写的贴吧云签到程序的项目。（~~正在测试~~ 暂停

2015-12-28 初步测试 （结果 ~~未知~~  **失败**


2015-12-28 修改后测试（结果 ~~未知~~ **失败** 原因不明（[详见](http://sign.ikay.work)
            --修改内容：
                1.重新使用原版程序进行安装。
                2.删除不必要的功能，简化脚本。



成功后会增加的功能：
    1.内置芒果云文件管理
    

本人修改/新建/删除了以下文件：
    +/setup/autoconfig.php
    */setup/check.php
    */setup/install.php
    -/config.php
    +/.openshift/cron/minutely/restart.sh
    +/.openshift/cron/minutely/do.sh
    
原程序版权归Kenvix/MoeNetwork所有
