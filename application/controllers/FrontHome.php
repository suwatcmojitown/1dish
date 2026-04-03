<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontHome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Review_model');
        $this->load->model('Place_model');
        $this->load->model('Shelf_model');
        $this->load->model('Lookup_model');
    }

    public function index()
    {
        $this->data['page_title']   = 'ที่สุดของระยอง: หนึ่งจาน หนึ่งเรื่องราว';
        $this->load->model('Influencer_model');
        $this->load->model('News_model');
        $this->data['hero_reviews']      = $this->Review_model->getHeroReviews(3);
        $this->data['spotlight']         = $this->Shelf_model->getShelf('spotlight');
        $this->data['places']            = $this->Place_model->getFrontPlaceList('', '', 7);
        $this->data['categoryList']      = $this->Lookup_model->getCategoryList();
        $this->data['districtList']      = $this->Lookup_model->getDistrictList();
        $this->data['influencerContent'] = $this->Influencer_model->getFrontContent(5);
        $this->data['newsList']          = $this->News_model->getFrontNews(4);
        $this->middle = 'front/home/index';
        $this->front_layout();
    }

    // Proxy ดึง TikTok thumbnail
    public function tiktokThumb()
    {
        $tiktok_id = $this->input->get('id');
        if (!$tiktok_id || !preg_match('/^\d+$/', $tiktok_id)) {
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode(array('url' => '')));
            return;
        }

        $url = 'https://www.tiktok.com/oembed?url=https://www.tiktok.com/@placeholder/video/' . $tiktok_id;

        $context = stream_context_create(array(
            'http' => array(
                'method'  => 'GET',
                'timeout' => 5,
                'header'  => implode("\r\n", array(
                    'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept: application/json, text/plain, */*',
                    'Accept-Language: th,en;q=0.9',
                    'Referer: https://www.tiktok.com/',
                )),
                'ignore_errors' => true,
            ),
            'ssl' => array(
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ),
        ));

        $thumb    = '';
        $response = @file_get_contents($url, false, $context);

        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data['thumbnail_url'])) {
                $thumb = $data['thumbnail_url'];
            }
        }

        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(array('url' => $thumb)));
    }

    // AJAX random place
    public function randomPlace()
    {
        $category_id = $this->input->post('category_id') ?: '';
        $district_id = $this->input->post('district_id') ?: '';
        $lat         = $this->input->post('lat') ?: '';
        $lng         = $this->input->post('lng') ?: '';
        $radius      = $this->input->post('radius') ?: '';

        $place = $this->Place_model->getRandomPlace($category_id, $district_id, $lat, $lng, $radius);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($place));
    }

    // AJAX nearby places
    public function nearby()
    {
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        if (!$lat || !$lng) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array()));
            return;
        }

        $places = $this->Place_model->getNearbyPlaces($lat, $lng, 6);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($places));
    }

    // AJAX filter places
    public function filterPlaces()
    {
        $category_id = $this->input->get('category_id') ?: '';
        $district_id = $this->input->get('district_id') ?: '';

        $places = $this->Place_model->getFrontPlaceList($category_id, $district_id, 7);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($places));
    }
}
