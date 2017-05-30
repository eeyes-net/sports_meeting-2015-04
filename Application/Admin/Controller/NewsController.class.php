<?php

namespace Admin\Controller;

use Think\Controller;

class NewsController extends Controller
{
    public function _initialize()
    {
        B('Admin\Behavior\Login', '', $return);
        if (!$return) {
            $this->error('您未登录！正在跳转至登陆界面...', U('Admin/Index/loginHTML'), 2);
        }
    }

    public function insertNewsHTML()
    {
        //behavior验证身份
        $this->display();
    }

    public function insertNews()
    {
        if (IS_POST) {
            $News = M('news');
            $news['title'] = I('post.title');
            $news['reporter'] = I('post.reporter');
            $news['author'] = I('post.author');
            $news['description'] = I('post.description');
            $news['type'] = I('post.type');
            $news['ctype'] = I('post.ctype');
            $news['content'] = I('content', '', '');
            $path = '/news/image/';
            $pattern = '/\/news\/image\/(.*?)\"/';
            preg_match_all($pattern, $news['content'], $match);
            $news['firstPic'] = $match[1][I('post.picId') - 1] ? $path . $match[1][I('post.picId') - 1] : '';
            $news['time'] = time();
            $news['click'] = 0;
            $news['name'] = md5($news['title'] . 'eeyes_sportsmeeting_news' . time());
            if ($News->data($news)->add()) {
                $this->success('新闻录入成功！', U('Admin/News/adminNavigationHTML'));
            } else {
                $this->error('新闻录入失败！');
            }
        } else {
            $this->error('访问非法！');
        }

    }

    public function createNewSportHTML()
    {
        $this->display();
    }

    public function createNewSport()
    {
        if (IS_POST) {
            $sports['name'] = I('post.name');
            $sports['number'] = I('post.number');
            $sports['year'] = I('post.year');
            $sports['month'] = I('post.month');
            $sports['day'] = I('post.day');
            $Sports = M('sports');
            if ($Sports->data($sports)->add()) {
                $this->success($sports['name'] . '添加成功！', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('添加失败！');
            }
        } else {
            $this->error('访问非法！');
        }
    }

    public function deleteSport()
    {
        $id = I('get.id');
        $Sports = M('sports');
        $sports = $Sports->where("id = '%d'", array($id))->find();
        if ($Sports->where("id = '%d'", array($id))->delete()) {
            $this->success($sports['name'] . '删除成功！', U('Admin/News/adminNavigationHTML'), 2);
        } else {
            $this->error('删除失败！');
        }
    }

    public function newsList()
    {
        $News = M('news');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 8;
        $list = $News->limit($NUM)->page($page)->select();
        $allPages = ceil($News->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('newsList', $list);
        $this->display();
    }

    public function deleteNews()
    {
        $id = I('get.id');
        $News = M('news');
        if ($news = $News->where("id = '%d'", array($id))->find()) {
            if ($News->where("id = '%d'", array($id))->delete()) {
                $this->success('标题为' . $news['title'] . '的新闻已删除成功！', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('删除失败！');
            }
        } else {
            $this->error('该新闻不存在！');
        }

    }

    public function sportsList()
    {
        $Sports = M('sports');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 8;
        $list = $Sports->limit($NUM)->page($page)->select();
        $allPages = ceil($Sports->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('sportsList', $list);
        $this->display();
    }

    public function insertRankHTML()
    {
        $id = I('get.id');
        $Sports = M('sports');
        $College = M('college');
        $sports = $Sports->where("id = '%d'", array($id))->find();
        $college = $College->select();
        $this->assign('sports', $sports);
        $this->assign('college', $college);
        $this->display();
    }

    public function insertRank()
    {
        if (IS_POST) {
            $numbers = I('post.number');
            $names = I('post.name');
            $colleges = I('post.college');
            $orders = I('post.order');
            $scores = I('post.score');
            $ranks = I('post.rank');
            $records = I('post.record');
            $standards = I('post.standard');
            $remarks = I('post.remark');
            $sports = I('post.sports');
            $Rank = M('rank');
            $addSuccessNum = 0;
            for ($i = 0; $i < 6; $i++) {
                if ($numbers[$i]) {
                    $data['number'] = $numbers[$i];
                    $data['name'] = $names[$i];
                    $data['college'] = $colleges[$i];
                    $data['orders'] = $orders[$i];
                    $data['score'] = $scores[$i];
                    $data['rank'] = $ranks[$i];
                    $data['record'] = $records[$i];
                    $data['standard'] = $standards[$i];
                    $data['remark'] = $remarks[$i];
                    $data['sports'] = $sports[$i];
                    if ($Rank->data($data)->add()) {
                        $addSuccessNum++;
                    }
                } else {
                    continue;
                }

            }
            $this->success('成功添加' . $addSuccessNum . '条记录！', U('Admin/News/adminNavigationHTML'), 2);
        } else {
            $this->error('访问非法！');
        }
    }

    public function deleteRank()
    {
        $id = I('get.id');
        $Rank = M('rank');
        if ($rank = $Rank->where("id = '%s'", array($id))->find()) {
            if ($Rank->where("id = '%s'", array($id))->delete()) {
                $this->success($rank['name'] . '的记录成功被删除', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('删除过程中出现错误！删除失败！');
            }
        } else {
            $this->error('错误！该记录不存在！');
        }
    }

    public function rankList()
    {
        $id = I('get.id');
        $Rank = M('rank');
        $Sports = M('sports');
        $sports = $Sports->where("id = '%d'", array($id))->find();
        $list = $Rank->table('rank rank,college college,sports sports')
            ->where("rank.sports = '%d' and rank.college = college.id and sports.id = rank.sports", array($id))->field('rank.id as id,rank.number as number,rank.name as name,college.name as college,rank.orders as orders,rank.score as score,rank.rank as rank,rank.record as record,rank.standard as standard,rank.remark as remark')->order('rank.rank')->select();
        $this->assign('page', $page);
        //$this -> assign('allPages',$allPages);
        $this->assign('rankList', $list);
        $this->assign('sports', $sports);
        $this->display();
    }

    public function insertPictureNumHTML()
    {
        $this->display();
    }

    public function insertPictureHTML()
    {
        $picNum = I('post.picNum');
        $this->assign('picNum', $picNum);
        $this->display();
    }

    public function insertPicture()
    {
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath = './Public/';
        $upload->savePath = 'news/picture/';
        $upload->saveName = array('uniqid', '');
        $upload->autoSub = true;
        $upload->subName = array('date', 'Ymd');
        $pictures = $upload->upload();
        $picNum = count($pictures);
        if (!$pictures) {
            $this->error($upload->getError());
        } else {
            $Picture = M('picture');
            $descriptions = I('post.description');
            $data['title'] = $descriptions[0];
            $data['time'] = time();
            $data['firstPic'] = __ROOT__ . '/Public/' . $pictures[0]['savepath'] . $pictures[0]['savename'];
            $data['description'] = '';
            $data['pic'] = '';
            for ($i = 1; $i < $picNum; $i++) {
                $data['description'] .= $descriptions[$i];
                $data['pic'] .= __ROOT__ . '/Public/' . $pictures[$i]['savepath'] . $pictures[$i]['savename'];
                if ($i != $picNum - 1) {
                    $data['description'] .= '@#$';
                    $data['pic'] .= '@#$';
                }
            }
            if ($Picture->data($data)->add()) {
                //var_dump(explode('@#$', $data['pic']));
                $this->success('添加图说成功！', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('添加失败！');
            }
        }
    }

    public function pictureList()
    {
        $Picture = M('picture');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 8;
        $list = $Picture->limit($NUM)->page($page)->select();
        $allPages = ceil($Picture->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('pictureList', $list);
        $this->display();
    }

    public function deletePicture()
    {
        $id = I('get.id');
        $Picture = M('picture');
        if ($picture = $Picture->where("id = '%d'", array($id))->find()) {
            if ($Picture->where("id = '%d'", array($id))->delete()) {
                $this->success('标题为' . $picture['title'] . '的图说已删除成功！', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('删除失败！');
            }
        } else {
            $this->error('该新闻不存在！');
        }

    }

    public function changeMedalHTML()
    {
        $College = M('college');
        $colleges = $College->select();
        $this->assign('colleges', $colleges);
        $this->display();
    }

    public function changeMedal()
    {
        if (IS_POST) {
            $College = M('college');
            $ids = I('post.id');
            $golds = I('post.gold');
            $silvers = I('post.silver');
            $coppers = I('post.copper');
            $successNum = 0;
            for ($i = 0; $i < 61; $i++) {
                $data['gold'] = $golds[$i];
                $data['silver'] = $silvers[$i];
                $data['copper'] = $coppers[$i];
                $data['total'] = $golds[$i] + $silvers[$i] + $coppers[$i];
                if ($College->where("id = '%d'", $ids[$i])->data($data)->save()) {
                    $successNum++;
                }
            }
            $this->success('成功写入' . $successNum . '个书院/学院的奖牌信息！');
        } else {
            $this->error('访问非法！');
        }
    }

    public function adminNavigationHTML()
    {
        $this->display();
    }

    public function insertIndexPictureNumHTML()
    {
        $this->display();
    }

    public function insertIndexPictureHTML()
    {
        $picType = I('post.picType');
        $picNum = I('post.picNum');
        $this->assign('picNum', $picNum);
        $this->assign('picType', $picType);
        $this->display();
    }

    public function insertIndexPicture()
    {
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath = './Public/';
        $upload->savePath = 'news/picture/';
        $upload->saveName = array('uniqid', '');
        $upload->autoSub = true;
        $upload->subName = array('date', 'Ymd');
        $pictures = $upload->upload();
        $picNum = count($pictures);
        if (!$pictures) {
            $this->error($upload->getError());
        } else {
            $Picture = M('indexpic');
            $descriptions = I('post.description');
            $data['type'] = I('post.type');
            if ($Picture->where("type = '%d'", array($data['type']))->find()) {
                $Picture->where("type = '%d'", array($data['type']))->delete();
            }
            $data['description'] = '';
            $data['pic'] = '';
            for ($i = 0; $i < $picNum; $i++) {
                $data['description'] .= $descriptions[$i];
                $data['pic'] .= __ROOT__ . '/Public/' . $pictures[$i]['savepath'] . $pictures[$i]['savename'];
                if ($i != $picNum - 1) {
                    $data['description'] .= '@#$';
                    $data['pic'] .= '@#$';
                }
            }
            if ($Picture->data($data)->add()) {
                //var_dump(explode('@#$', $data['pic']));
                $this->success('添加首页图片成功！', U('Admin/News/adminNavigationHTML'), 2);
            } else {
                $this->error('添加失败！');
            }
        }
    }

}
