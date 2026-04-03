<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontNews extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
    }

    public function index()
    {
        $page  = (int)($this->input->get('page') ?: 1);
        $limit = 12;
        $cat   = $this->input->get('cat') ?: '';

        $this->data['page_title'] = 'ข่าวประชาสัมพันธ์';
        $this->data['newsList']   = $this->News_model->getFrontNewsList($cat, $page, $limit);
        $this->data['total']      = $this->News_model->countNews($cat ? $cat : 'published_only');
        $this->data['page']       = $page;
        $this->data['limit']      = $limit;
        $this->data['cat']        = $cat;
        $this->middle = 'front/news/index';
        $this->front_layout();
    }

    public function tag($tag)
    {
        $tag   = urldecode($tag);
        $page  = (int)($this->input->get('page') ?: 1);
        $limit = 12;

        $this->data['page_title'] = 'แท็ก: #' . $tag;
        $this->data['tag']        = $tag;
        $this->data['newsList']   = $this->News_model->getNewsByTag($tag, $page, $limit);
        $this->data['total']      = $this->News_model->countNewsByTag($tag);
        $this->data['page']       = $page;
        $this->data['limit']      = $limit;
        $this->middle = 'front/news/tag';
        $this->front_layout();
    }

    public function detail($news_id)
    {
        $news = $this->News_model->getNewsDetail($news_id);
        if (!$news) show_404();

        $tags    = $this->News_model->getTags($news_id);
        $related = $this->News_model->getRelatedNews($news_id, $news->category, 3);

        $this->data['page_title'] = $news->title;
        $this->data['news']       = $news;
        $this->data['tags']       = $tags;
        $this->data['related']    = $related;
        $this->middle = 'front/news/detail';
        $this->front_layout();
    }
}
