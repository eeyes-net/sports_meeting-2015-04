<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $IndexPic = M('indexpic');
        $News = M('news');
        $Sports = M('sports');
        $College = M('college');
        $indexPicLeft = $IndexPic->where("type = '%d'", array(0))->find();
        $indexPicLeftPics = explode('@#$', $indexPicLeft['pic']);
        $indexPicLeftDescriptions = explode('@#$', $indexPicLeft['description']);
        $indexPicLeftNum = count($indexPicLeftPics);
        $this->assign('indexPicLeftPics', $indexPicLeftPics);
        $this->assign('indexPicLeftDescriptions', $indexPicLeftDescriptions);
        $this->assign('indexPicLeftNum', $indexPicLeftNum);

        $hotNews = $News->order("click desc")->limit(1)->find();
        $this->assign('hotNews', $hotNews);

        $randomNews1 = $News->order('rand()')->limit(4)->select();
        $this->assign('randomNews1', $randomNews1);

        $randomNews2 = $News->order('rand()')->limit(10)->select();
        $this->assign('randomNews2', $randomNews2);

        $medal = $College->order('gold desc, silver desc,copper desc')->limit(5)->select();
        $this->assign('medal', $medal);

        $tiansaiNews = $News->where("type = '%d' and ctype = '%d'", array(0, 0))->limit(10)->select();
        $this->assign('tiansaiNews', $tiansaiNews);

        $jingsaiNews = $News->where("type = '%d' and ctype = '%d'", array(0, 1))->limit(10)->select();
        $this->assign('jingsaiNews', $jingsaiNews);

        $saichangNews = $News->where("type = '%d' and ctype = '%d'", array(0, 2))->limit(10)->select();
        $this->assign('saichangNews', $saichangNews);

        $indexPicBottom = $IndexPic->where("type = '%d'", array(1))->find();
        $indexPicBottomPics = explode('@#$', $indexPicBottom['pic']);
        $indexPicBottomDescriptions = explode('@#$', $indexPicBottom['description']);
        $indexPicBottomNum = count($indexPicBottomPics);
        $this->assign('indexPicBottomPics', $indexPicBottomPics);
        $this->assign('indexPicBottomDescriptions', $indexPicBottomDescriptions);
        $this->assign('indexPicBottomNum', $indexPicBottomNum);

        $sports = $News->where("type = '%d'", array(2))->limit(8)->select();
        $this->assign('sports', $sports);

        $hotAthlete = $News->where("type = '%d'", array(1))->order('click desc')->limit(2)->select();
        $this->assign('hotAthlete', $hotAthlete);

        $athletes = $News->where("type = '%d'", array(1))->order('rand()')->limit(8)->select();
        $this->assign('athletes', $athletes);

        $this->display();
    }
}
