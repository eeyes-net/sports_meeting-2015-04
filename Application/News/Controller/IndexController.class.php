<?php

namespace News\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function news()
    {
        $News = M('news');
        $page = I('get.page') ? I('get.page') : 1;
        $ctype = I('get.ctype');
        $NUM = 20;
        if ($ctype) {
            $list = $News->limit($NUM)->page($page)->order('time desc')->where("type = '%d' and ctype = '%d'", array(0, $ctype))->select();
            $allPages = ceil($News->where("type = '%d' and ctype = '%d'", array(0))->count() / $NUM);
        } else {
            $list = $News->limit($NUM)->page($page)->order('time desc')->where("type = '%d'", array(0))->select();
            $allPages = ceil($News->where("type = '%d'", array(0))->count() / $NUM);
        }

        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('newsList', $list);

        $News = M('news');
        $Sports = M('sports');
        $recommendNewsList = $News->limit(5)->order('rand()')->where("type != '%d'", array(2))->select();
        $recommendGradeList = $News->where("type = '%d'", array(2))->order('rand()')->limit(5)->select();
        $this->assign('recommendNewsList', $recommendNewsList);
        $this->assign('recommendGradeList', $recommendGradeList);
        $this->display();
    }

    public function stars()
    {
        $News = M('news');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 9;
        $list = $News->limit($NUM)->page($page)->order('time desc')->where("type = '%d'", array(1))->select();
        $allPages = ceil($News->where("type = '%d'", array(1))->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('newsList', $list);

        $News = M('news');
        $Sports = M('sports');
        $recommendNewsList = $News->limit(5)->order('rand()')->where("type != '%d'", array(2))->select();
        $recommendGradeList = $News->where("type = '%d'", array(2))->order('rand()')->limit(5)->select();
        $this->assign('recommendNewsList', $recommendNewsList);
        $this->assign('recommendGradeList', $recommendGradeList);
        $this->display();
    }

    public function article()
    {
        $News = M('news');
        $id = I('get.id');
        $news = $News->where("id = '%d'", array($id))->find();
        $News->where("id = '%d'", array($id))->setInc('click', 1);
        $this->assign('news', $news);

        $News = M('news');
        $Sports = M('sports');
        $recommendNewsList = $News->limit(5)->order('rand()')->where("type != '%d'", array(2))->select();
        $recommendGradeList = $News->where("type = '%d'", array(2))->order('rand()')->limit(5)->select();
        $this->assign('recommendNewsList', $recommendNewsList);
        $this->assign('recommendGradeList', $recommendGradeList);
        $this->display();
    }

    public function grade()
    {
        $id = I('get.id');
        $Rank = M('rank');
        $Sports = M('sports');
        $sports = $Sports->where("id = '%d'", array($id))->find();
        $list = $Rank->table('sportsmeeting_rank rank,sportsmeeting_college college,sportsmeeting_sports sports')
            ->where("rank.sports = '%d' and rank.college = college.id and sports.id = rank.sports", array($id))->field('rank.id as id,rank.number as number,rank.name as name,college.name as college,rank.orders as orders,rank.score as score,rank.rank as rank,rank.record as record,rank.standard as standard,rank.remark as remark')->order('rank.rank')->select();
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('rankList', $list);
        $this->assign('sports', $sports);
        $this->display();
    }

    public function medal()
    {
        $College = M('college');
        $colleges = $College->order('gold desc,silver desc,copper desc')->select();
        $this->assign('colleges', $colleges);
        $this->display();
    }

    public function picture()
    {
        $Picture = M('picture');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 9;
        $list = $Picture->limit($NUM)->page($page)->order('time desc')->select();
        $allPages = ceil($Picture->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('pictureList', $list);
        $this->display();
    }

    public function result()
    {
        $News = M('news');
        $page = I('get.page') ? I('get.page') : 1;
        $NUM = 20;
        $list = $News->limit($NUM)->page($page)->order('time desc')->where("type = '%d'", array(2))->select();
        $allPages = ceil($News->where("type = '%d'", array(2))->count() / $NUM);
        $this->assign('page', $page);
        $this->assign('allPages', $allPages);
        $this->assign('newsList', $list);

        $News = M('news');
        $Sports = M('sports');
        $recommendNewsList = $News->limit(5)->order('rand()')->where("type != '%d'", array(2))->select();
        $recommendGradeList = $News->where("type = '%d'", array(2))->order('rand()')->limit(5)->select();
        $this->assign('recommendNewsList', $recommendNewsList);
        $this->assign('recommendGradeList', $recommendGradeList);
        $this->display();
    }

    // public function result_old()
    // {
    //     $Sports = M('sports');
    //     $page = I('get.page') ? I('get.page') : 1;
    //     $NUM = 20;
    //     $list = $Sports->limit($NUM)->order('day desc')->page($page)->select();
    //     $allPages = ceil($Sports->count() / $NUM);
    //     $this->assign('page', $page);
    //     $this->assign('allPages', $allPages);
    //     $this->assign('sportsList', $list);
    //     $this-> display();
    // }

    public function timetable()
    {
        $this->display();
    }

    public function view()
    {
        $Picture = M('picture');
        $id = I('get.id');
        $picture = $Picture->where("id = '%d'", array($id))->find();
        $descriptions = explode('@#$', $picture['description']);
        $pics = explode('@#$', $picture['pic']);
        $picNum = count($pics);
        $this->assign('descriptions', $descriptions);
        $this->assign('pics', $pics);
        $this->assign('picNum', $picNum);

        $this->display();
    }
}
