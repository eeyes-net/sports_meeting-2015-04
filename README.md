# 西安交通大学第53届校运动会官方网站

<http://2015.eeyes.net/> （已下线）

## 时间轴

* 2015年03月22日：首次上线测试
* 2015年04月09日：正式上线测试
* 2015年04月24日、25日：运动会期间，累计两千多次访问量
* 2016年03月26日：网站正式下线
* 2017年05月29日：开始整理代码

## 环境要求

* `php >= 5.3`
* 打开`PDO_mysql`拓展
* 其他具体要求请参考<http://www.kancloud.cn/manual/thinkphp/1681>

## 部署

1. 到<http://www.thinkphp.cn/down/610.html>下载`ThinkPHP 3.2.3`框架完整版

2. 替换掉除了`ThinkPHP`文件夹之外的所有文件和文件夹

3. 到<http://ueditor.baidu.com/website/download.html>下载`ueditor-utf8-php`（1.4.3版本），解压到`ue`目录下，注意不要覆盖`ue/php/controller.php`

4. 手动新建数据库
    ```mysql
    CREATE DATABASE `sports_meeting-2015-04` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
    USE `sports_meeting-2015-04`;
    ```

5. 手动新建表，输入如下SQL语句
    ```mysql
    CREATE TABLE `admin` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `name` varchar(20) NOT NULL,
      `password` varchar(20) NOT NULL,
      `permission` int(1) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `college` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `gold` int(4) NOT NULL,
      `silver` int(4) NOT NULL,
      `copper` int(4) NOT NULL,
      `total` int(4) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `indexpic` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `type` int(11) NOT NULL,
      `pic` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `news` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `type` int(4) NOT NULL,
      `ctype` int(4) NOT NULL,
      `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `reporter` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `author` varchar(127) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `firstPic` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `click` int(4) NOT NULL,
      `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `picture` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `firstPic` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `pic` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `time` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `rank` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `number` int(4) NOT NULL,
      `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `college` int(4) NOT NULL,
      `orders` int(4) NOT NULL,
      `score` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `rank` int(4) NOT NULL,
      `record` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `standard` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `sports` int(4) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `sports` (
      `id` int(4) NOT NULL AUTO_INCREMENT,
      `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
      `year` int(4) NOT NULL,
      `month` int(4) NOT NULL,
      `day` int(4) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ```

6. 手动添加管理账号
    ```mysql
    INSERT INTO `admin` VALUES (1000, 'root', 'root', 0);
    ```

6. 手动添加运动会代表队，导入`tests/college.sql`。
    手动添加运动会项目，通过后台管理或导入`tests/sports.sql`。
    
7. 访问`/index.php?m=Admin&c=Index&a=loginHTML`登录后台

8. 添加、修改、删除信息

## 说明

* 项目采用`ThinkPHP3.2.3`框架开发
* 后台登录网址是`/index.php?m=Admin&c=Index&a=loginHTML`

## CONTRIBUTORS

* 设计：
* 前端：[LouisLv](https://github.com/ensorrow)
* 后端：[LorinLee](https://github.com/lorinlee)
* 代码整理：[Ganlv](https://github.com/ganlvtech)

## LICENSE

    Copyright 2015-2017 eeyes.net
    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at
    
       http://www.apache.org/licenses/LICENSE-2.0
    
    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.

