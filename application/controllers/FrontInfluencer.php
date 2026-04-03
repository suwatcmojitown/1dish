<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontInfluencer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Influencer_model');
        $this->load->model('Review_model');
    }

    public function list()
    {
        $this->data['page_title']   = 'Curator ทั้งหมด';
        $this->data['influencers']  = $this->Influencer_model->getAllInfluencers();
        $this->middle = 'front/influencer/list';
        $this->front_layout();
    }

    public function profile($influencer_id)
    {
        $influencer = $this->Influencer_model->getInfluencerProfile($influencer_id);
        if (!$influencer) show_404();

        $page  = (int)($this->input->get('page') ?: 1);
        $limit = 16; // 4 แถว x 4 คอลัมน์

        $this->data['page_title']  = ($influencer->display_name ?: $influencer->user_display_name) . ' | Rayong Curator';
        $this->data['influencer']  = $influencer;
        $this->data['reviews']     = $this->Influencer_model->getInfluencerReviews($influencer_id, $limit, ($page-1)*$limit);
        $this->data['total']       = $this->Influencer_model->countInfluencerReviews($influencer_id);
        $this->data['tiktoks']     = $this->Influencer_model->getInfluencerTikToks($influencer_id, 6);
        $this->data['page']        = $page;
        $this->data['limit']       = $limit;
        $this->middle = 'front/influencer/profile';
        $this->front_layout();
    }
}
