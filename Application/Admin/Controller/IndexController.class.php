<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function loginHTML()
    {
        $this->display();
    }

    public function login()
    {
        if (IS_POST) {
            $name = I('post.name');
            $password = I('post.password');
            $Admin = M('admin');
            if ($Admin->where("name = '%s' and password = '%s'", array($name, $password))->find()) {
                session('name', $name);
                $this->success('登陆成功！正在跳转至管理员导航...', U('Admin/News/adminNavigationHTML'));
            } else {
                $this->error('登陆失败！用户名或密码错误！');
            }
        } else {
            $this->error('访问非法！');
        }
    }

    public function logout()
    {
        if (session('?name')) {
            session('name', null);
            $this->success('登出成功！', u('Home/Index/index'));
        } else {
            $this->error('您未登陆！');
        }
    }

}
