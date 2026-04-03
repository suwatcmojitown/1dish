<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ============================================================
// CMS Routes
// ============================================================
$route['cms']                        = 'CmsAuth/login';
$route['cms/login']                  = 'CmsAuth/login';
$route['cms/login/submit']           = 'CmsAuth/submit';
$route['cms/logout']                 = 'CmsAuth/logout';

$route['cms/dashboard']              = 'CmsPlace/dashboard';

$route['home/tiktok-thumb']          = 'FrontHome/tiktokThumb';
$route['home/random-place']          = 'FrontHome/randomPlace';
$route['home/nearby']                = 'FrontHome/nearby';
$route['home/filter-places']         = 'FrontHome/filterPlaces';
$route['search']                     = 'FrontSearch/index';
$route['cms/news']               = 'CmsNews/index';
$route['cms/news/form']          = 'CmsNews/form';
$route['cms/news/form/(:num)']   = 'CmsNews/form/$1';
$route['cms/news/save']          = 'CmsNews/save';
$route['cms/news/delete/(:num)'] = 'CmsNews/delete/$1';
$route['news']                   = 'FrontNews/index';
$route['news/tag/(:any)']        = 'FrontNews/tag/$1';
$route['news/(:num)']            = 'FrontNews/detail/$1';
$route['cms/influencer/content']        = 'CmsInfluencer/contentList';
$route['cms/influencer/content/save']   = 'CmsInfluencer/contentSave';
$route['cms/influencer/content/delete'] = 'CmsInfluencer/contentDelete';
$route['cms/shelf']               = 'CmsShelf/index';
$route['cms/shelf/spotlight']     = 'CmsShelf/spotlight';
$route['cms/shelf/search']        = 'CmsShelf/search';
$route['cms/shelf/save']          = 'CmsShelf/save';

$route['cms/place']                  = 'CmsPlace/list';
$route['cms/place/add']              = 'CmsPlace/add';
$route['cms/place/save']             = 'CmsPlace/save';
$route['cms/place/edit/(:num)']      = 'CmsPlace/edit/$1';
$route['cms/place/update']           = 'CmsPlace/update';
$route['cms/place/delete']           = 'CmsPlace/delete';
$route['cms/place/uploadImage']      = 'CmsPlace/uploadImage';

$route['cms/review']                 = 'CmsReview/list';
$route['cms/review/approve']         = 'CmsReview/approve';
$route['cms/review/reject']          = 'CmsReview/reject';

$route['cms/comment']                = 'CmsComment/list';
$route['cms/comment/approve']        = 'CmsComment/approve';
$route['cms/comment/reject']         = 'CmsComment/reject';

$route['cms/influencer']             = 'CmsInfluencer/listing';
$route['cms/influencer/add']         = 'CmsInfluencer/add';
$route['cms/influencer/save']        = 'CmsInfluencer/profileSave';
$route['cms/influencer/edit/(:num)'] = 'CmsInfluencer/edit/$1';
$route['cms/influencer/update']      = 'CmsInfluencer/profileUpdate';

$route['cms/ai/summarize']      = 'CmsAi/summarize';
$route['cms/ai/news-excerpt']   = 'CmsAi/newsExcerpt';
$route['cms/ai/news-tags']      = 'CmsAi/newsTags';
$route['cms/ai/gen-title']      = 'CmsAi/genTitle';
$route['cms/ai/imagegen']           = 'CmsAi/imagegen';
$route['cms/ai/imagegen/gen']       = 'CmsAi/imagegenGenerate';
$route['cms/ai/cover-gen']          = 'CmsAi/coverGen';
$route['cms/member/edit/(:num)']       = 'CmsMember/edit/$1';
$route['cms/member/update']            = 'CmsMember/update';
$route['cms/member/ban']               = 'CmsMember/ban';
$route['cms/member/reset_password']    = 'CmsMember/resetPassword';

$route['cms/user']                     = 'CmsUser/list';
$route['cms/user/add']                 = 'CmsUser/add';
$route['cms/user/save']                = 'CmsUser/save';
$route['cms/user/edit/(:num)']         = 'CmsUser/edit/$1';
$route['cms/user/update']              = 'CmsUser/update';
$route['cms/user/reset_password']      = 'CmsUser/resetPassword';

$route['cms/category']               = 'CmsLookup/categoryList';
$route['cms/category/save']          = 'CmsLookup/categorySave';
$route['cms/category/update']        = 'CmsLookup/categoryUpdate';
$route['cms/category/delete']        = 'CmsLookup/categoryDelete';

$route['cms/district']               = 'CmsLookup/districtList';
$route['cms/district/save']          = 'CmsLookup/districtSave';
$route['cms/district/update']        = 'CmsLookup/districtUpdate';

// ============================================================
// Front Routes
// ============================================================
$route['default_controller']         = 'FrontHome/index';
$route['404_override']               = '';
$route['translate_uri_dashes']       = FALSE;

$route['explore']                    = 'FrontExplore/index';
$route['explore/search']             = 'FrontExplore/search';

$route['place/(:num)']               = 'FrontPlace/detail/$1';
$route['place/nearby']               = 'FrontPlace/nearby';
$route['place/random']               = 'FrontPlace/random';

$route['review/(:num)']              = 'FrontReview/detail/$1';
$route['review/comment/add']         = 'FrontReview/addComment';

$route['curator']                    = 'FrontInfluencer/list';
$route['curator/(:num)']             = 'FrontInfluencer/profile/$1';

$route['login']                      = 'FrontUser/login';
$route['login/submit']               = 'FrontUser/submit';
$route['logout']                     = 'FrontUser/logout';
$route['register']                   = 'FrontUser/register';
$route['register/save']              = 'FrontUser/save';
