<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*
dashboard

product

Tour
- guide
- company

stock
- import
- export

product category
user
*/

$route['default_controller'] = 'Product/list';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'Dashboard/index';
$route['dashboard/loadContentList'] = 'Dashboard/loadContentList';

$route['login'] = 'User/login';
$route['logout'] = 'User/logout';
$route['user/validlogin'] = 'User/validlogin';
$route['signup'] = 'User/signup';

$route['admin'] = 'Admin/list';
$route['admin/create'] = 'Admin/create';
$route['admin/add'] = 'Admin/addContent';
$route['admin/loadContentList'] = 'Admin/loadContentList';
$route['admin/edit/(:any)'] = 'Admin/edit/$1';
$route['admin/update'] = 'Admin/updateContent';
$route['admin/delete'] = 'Admin/deleteContent';


$route['product'] = 'Product/list';
$route['product/create'] = 'Product/create';
$route['product/add'] = 'Product/addContent';
$route['product/edit/(:any)'] = 'Product/edit/$1';
$route['product/update'] = 'Product/updateContent';
$route['product/loadContentList'] = 'Product/loadContentList';
$route['product/changeStatus'] = 'Product/changeStatus';
$route['product/delete'] = 'Product/deleteContent';
$route['product/stock/view/(:any)'] = 'Product/stockList/$1';
$route['product/updateStock'] = 'Product/updateStock';
$route['product/createStock'] = 'Product/createStock';
$route['product/loadStockList'] = 'Product/loadStockList';
$route['product/gallery/(:any)'] = 'Product/gallery/$1';

$route['shelf'] = 'Shelf/list';
$route['shelf/content/(:any)'] = 'Shelf/manageContent/$1';
$route['shelf/edit/(:any)'] = 'Shelf/edit/$1';
$route['shelf/update'] = 'Shelf/update';
$route['shelf/print/(:any)'] = 'Shelf/printInvoice/$1';
$route['shelf/cancelBill'] = 'Shelf/cancelBill';
$route['shelf/addShelfContent'] = 'Shelf/addShelfContent';
$route['shelf/deleteContentItem'] = 'Shelf/deleteContentItem';

$route['bubble'] = 'Bubble/manageContent';
$route['bubble/add'] = 'Bubble/addContent';
$route['bubble/deleteContentItem'] = 'Bubble/deleteContentItem';
$route['bubble/edit'] = 'Bubble/edit';
$route['bubble/update'] = 'Bubble/updateContent';

$route['highlight'] = 'Highlight/manageContent';
$route['highlight/add'] = 'Highlight/addContent';
$route['highlight/deleteContentItem'] = 'Highlight/deleteContentItem';
$route['highlight/edit'] = 'Highlight/edit';
$route['highlight/update'] = 'Highlight/updateContent';
/*
$route['shelf/addShelfContent'] = 'Shelf/addShelfContent';
$route['shelf/deleteContentItem'] = 'Shelf/deleteContentItem';
*/
$route['filter/loadSubCategoryList'] = 'Filter/getSubcategory';


/*
$route['user/register'] = 'User/register';
$route['user/list'] = 'User/listUser';
$route['user/loadUserList'] = 'User/loadUserList';
$route['user/changeUser'] = 'User/changeUser';
$route['user/update'] = 'User/updateUser';
$route['user/edit/(:num)'] = 'User/editUser/$1';
$route['user/userDetail'] = 'User/viewUser';
$route['user/userUpdate'] = 'User/updateUser';
*/

/*
$route['changepassword'] = 'User/changePassword';
$route['user/updatePassword'] = 'User/updatePassword';
*/


/*
$route['home'] = 'Home/index';
$route['home/addTopSlider'] = 'Home/addTopSlider';
$route['home/loadTopSliderList'] = 'Home/loadTopSlider';
$route['home/deleteTopSlider'] = 'Home/deleteTopSlider';
$route['home/addBubble'] = 'Home/addBubble';
$route['home/loadBubbleList'] = 'Home/loadBubble';
$route['home/deleteBubble'] = 'Home/deleteBubble';

$route['contact/edit'] = 'Contact/edit';
$route['contact/update'] = 'Contact/updateContact';

$route['shelf/list'] = 'Shelf/listShelf';
$route['shelf/updateOrder'] = 'Shelf/updateShelfOrder';
$route['shelf/reorderShelf/(:num)'] = 'Shelf/reorderShelf/$1';
$route['shelf/loadContentList'] = 'Shelf/loadContentList';
$route['shelf/add'] = 'Shelf/addShelf';
$route['shelf/delete'] = 'Shelf/deleteShelf';
$route['shelf/shelfDetail'] = 'Shelf/viewShelf';
$route['shelf/shelfUpdate'] = 'Shelf/updateShelf';
$route['shelf/loadShelfList'] = 'Shelf/loadShelfList';

$route['category/detail'] = 'Category/viewCategory';
$route['category/create'] = 'Category/createCategory';
$route['category/add'] = 'Category/addCategory';
$route['category/list'] = 'Category/listCategory';
$route['category/edit/(:num)'] = 'Category/editCategory/$1';
$route['category/update'] = 'Category/updateCategory';
$route['category/createSubcat/(:num)'] = 'Category/createSubcategory/$1';
$route['category/addSubcat'] = 'Category/addSubcategory';
$route['category/editSubcat/(:num)'] = 'Category/editSubcategory/$1';
$route['category/updateSubcat'] = 'Category/updateSubcategory';


$route['content/list'] = 'content/listContent';
$route['content/loadContentList'] = 'content/loadContentList';
$route['content/create'] = 'content/createContent';
$route['content/add'] = 'content/addContent';
$route['content/changeStatus'] = 'content/changeStatusContent';
$route['content/delete'] = 'content/deleteContent';
$route['content/edit/(:num)'] = 'content/editContent/$1';
$route['content/update'] = 'content/updateContent';
$route['content/preview/(:num)'] = 'content/previewContent/$1';
$route['content/loadSubcategory'] = 'content/loadSubcategoryList';
$route['content/loadSubcategoryCreate'] = 'content/loadSubcategoryListCreate';

$route['personal/create'] = 'Personal/createPersonal';
$route['personal/add'] = 'Personal/addPersonal';
$route['personal/list'] = 'Personal/listPersonal';
$route['personal/edit/(:num)'] = 'Personal/editPersonal/$1';
$route['personal/update'] = 'Personal/updatePersonal';


$route['setting/list'] = 'Setting/listSetting';
$route['setting/occupationDetail'] = 'Setting/viewOccupation';
$route['setting/occupationUpdate'] = 'Setting/updateOccupation';
$route['setting/loadOccupationList'] = 'Setting/loadOccupationList';
$route['setting/occupationAdd'] = 'Setting/addOccupation';

$route['setting/trainingDetail'] = 'Setting/viewTraining';
$route['setting/trainingUpdate'] = 'Setting/updateTraining';
$route['setting/loadTrainingList'] = 'Setting/loadTrainingList';
$route['setting/trainingAdd'] = 'Setting/addTraining';

$route['setting/graduatedDetail'] = 'Setting/viewGraduated';
$route['setting/graduatedUpdate'] = 'Setting/updateGraduated';
$route['setting/loadGraduatedList'] = 'Setting/loadGraduatedList';
$route['setting/graduatedAdd'] = 'Setting/addGraduated';

$route['setting/positionDetail'] = 'Setting/viewPosition';
$route['setting/positionUpdate'] = 'Setting/updatePosition';
$route['setting/loadPositionList'] = 'Setting/loadPositionList';
$route['setting/positionAdd'] = 'Setting/addPosition';

*/

//$route['personal/edit/(:num)'] = 'Personal/editPersonal/$1';
//$route['personal/update'] = 'Personal/updatePersonal';
/*

$route['subject/detail'] = 'Subject/viewSubject';
$route['subject/create'] = 'Subject/createSubject';
$route['subject/add'] = 'Subject/addSubject';
$route['subject/list'] = 'Subject/listSubject';
$route['subject/edit/(:num)'] = 'Subject/editSubject/$1';
$route['subject/update'] = 'Subject/updateSubject';

$route['education/loadSubEdu/(:any)'] = 'education/loadSubEducation/$1';



$route['officer/list'] = 'Officer/listOfficer';
$route['officer/loadOfficerList'] = 'Officer/loadOfficerList';
$route['officer/create'] = 'officer/createOfficer';
$route['officer/add'] = 'officer/addOfficer';
$route['officer/detail/(:num)'] = 'officer/viewOfficer/$1';
$route['officer/log/(:num)'] = 'officer/logOfficer/$1';
$route['officer/edit/(:num)'] = 'officer/editOfficer/$1';
$route['officer/update'] = 'officer/updateOfficer';

$route['profile/loadDistrict'] = 'Profile/loadDistrict';
$route['profile/loadSubDistrict'] = 'Profile/loadSubDistrict';
$route['profile/university'] = 'Profile/getUniversity';

$route['student/list'] = 'student/listStudent';
$route['student/loadStudentList'] = 'student/loadStudentList';
$route['student/detail/(:num)'] = 'student/viewStudent/$1';
$route['student/log/(:num)'] = 'student/logStudent/$1';

$route['quiz/list'] = 'quiz/listQuiz';
$route['quiz/loadQuizList'] = 'quiz/loadQuizList';
$route['quiz/create'] = 'quiz/createQuiz';
$route['quiz/add'] = 'quiz/addQuiz';
$route['quiz/changeStatus'] = 'quiz/changeStatusQuiz';
$route['quiz/delete'] = 'quiz/deleteQuiz';
$route['quiz/edit/(:num)'] = 'quiz/editQuiz/$1';
$route['quiz/update'] = 'quiz/updateQuiz';
$route['quiz/detail/(:num)'] = 'quiz/viewQuiz/$1';
$route['quiz/rejectList'] = 'quiz/listRejectQuiz';
$route['quiz/loadRejectQuizList'] = 'quiz/loadRejectQuizList';

$route['shelf/list'] = 'shelf/listShelf';
$route['shelf/loadShelfList'] = 'shelf/loadShelfList';
$route['shelf/createHead'] = 'shelf/createShelfHeader';
$route['shelf/addHead'] = 'shelf/addShelfHeader';
$route['shelf/addQuiz/(:num)'] = 'shelf/addQuiz/$1';
$route['shelf/loadQuiz'] = 'shelf/loadQuizList';
$route['shelf/chooseQuiz'] = 'shelf/chooseQuiz';
$route['shelf/loadQuizList'] = 'shelf/chooseQuizAndLoad';
$route['shelf/sort/(:num)'] = 'shelf/sortQuiz/$1';
$route['shelf/updateOrder'] = 'shelf/updateQuizOrder';
$route['shelf/detail/(:num)'] = 'shelf/viewShelfHeader/$1';
$route['shelf/changeStatus'] = 'shelf/changeStatusShelf';
$route['shelf/edit/(:num)'] = 'shelf/editShelfHeader/$1';
$route['shelf/updateShelfHeader'] = 'shelf/updateShelfHeader';
$route['shelf/delete'] = 'shelf/deleteShelf';


$route['group/list'] = 'group/listGroup';
$route['group/add'] = 'group/addGroup';
$route['group/detail'] = 'group/viewGroup';
$route['group/edit'] = 'group/editGroup';
$route['group/update'] = 'group/updateGroup';

$route['examiner/list/quiz'] = 'examiner/listQuiz';
$route['examiner/list/quiz/(:num)'] = 'examiner/listQuiz/$1';
$route['examiner/loadQuizList'] = 'examiner/loadQuizList';
$route['examiner/checkQuiz/(:num)'] = 'examiner/checkQuiz/$1';
$route['examiner/rejectQuiz'] = 'examiner/rejectQuiz';
$route['examiner/approveQuiz'] = 'examiner/approveQuiz';

$route['examiner/list/shelf'] = 'examiner/listShelf';
$route['examiner/list/shelf/(:num)'] = 'examiner/listShelf/$1';
$route['examiner/loadShelfList'] = 'examiner/loadShelfList';
$route['examiner/checkShelf/(:num)'] = 'examiner/checkShelf/$1';
$route['examiner/rejectShelf'] = 'examiner/rejectShelf';
$route['examiner/approveShelf'] = 'examiner/approveShelf';

$route['examiner/list/content'] = 'examiner/listContent';
$route['examiner/list/content/(:num)'] = 'examiner/listContent/$1';
$route['examiner/loadContentList'] = 'examiner/loadContentList';
$route['examiner/checkContent/(:num)'] = 'examiner/checkContent/$1';
$route['examiner/rejectContent'] = 'examiner/rejectContent';
$route['examiner/approveContent'] = 'examiner/approveContent';

$route['examiner/list/article'] = 'examiner/listArticle';
$route['examiner/list/article/(:num)'] = 'examiner/listArticle/$1';
$route['examiner/loadArticleList'] = 'examiner/loadArticleList';
$route['examiner/checkArticle/(:num)'] = 'examiner/checkArticle/$1';
$route['examiner/rejectArticle'] = 'examiner/rejectArticle';
$route['examiner/approveArticle'] = 'examiner/approveArticle';


$route['highlighthome/list'] = 'highlighthome/listHilight';
$route['highlighthome/loadHilightList'] = 'highlighthome/loadHilightList';
$route['highlighthome/add'] = 'highlighthome/addHilight';
$route['highlighthome/sort'] = 'highlighthome/sortHilight';
$route['highlighthome/updateOrder'] = 'highlighthome/updateHilightOrder';
$route['highlighthome/edit'] = 'highlighthome/editHilight';
$route['highlighthome/update'] = 'highlighthome/updateHilight';
$route['highlighthome/changeStatus'] = 'highlighthome/changeStatusHilight';
$route['highlighthome/delete'] = 'highlighthome/deleteHilight';


$route['highlight/list'] = 'highlight/listHighlight';
$route['highlight/loadHighlightList'] = 'highlight/loadHighlightList';
$route['highlight/add'] = 'highlight/addHilight';
$route['highlight/delete'] = 'highlight/deleteHighlight';
$route['highlight/edit'] = 'highlight/editHighlight';
$route['highlight/update'] = 'highlight/updateHighlight';
$route['highlight/addContent/(:num)'] = 'highlight/addContent/$1';
$route['highlight/loadContent'] = 'highlight/loadContentList';
$route['highlight/chooseContent'] = 'highlight/chooseContent';
$route['highlight/sort/(:num)'] = 'highlight/sortContent/$1';
$route['highlight/updateOrder'] = 'highlight/updateContentOrder';

$route['category/loadSubCategory'] = 'category/loadSubCategoryList';
$route['category/loadSubCategoryLeft'] = 'category/loadSubCategoryListLeft';

$route['content/list'] = 'content/listContent';
$route['content/loadContentList'] = 'content/loadContentList';
$route['content/create'] = 'content/createContent';
$route['content/add'] = 'content/addContent';
$route['content/changeStatus'] = 'content/changeStatusContent';
$route['content/delete'] = 'content/deleteContent';
$route['content/edit/(:num)'] = 'content/editContent/$1';
$route['content/update'] = 'content/updateContent';
$route['content/preview/(:num)'] = 'content/previewContent/$1';

$route['article/list'] = 'article/listContent';
$route['article/loadContentList'] = 'article/loadContentList';
$route['article/create'] = 'article/createContent';
$route['article/add'] = 'article/addContent';
$route['article/changeStatus'] = 'article/changeStatusContent';
$route['article/delete'] = 'article/deleteContent';
$route['article/edit/(:num)'] = 'article/editContent/$1';
$route['article/update'] = 'article/updateContent';
$route['article/preview/(:num)'] = 'article/previewContent/$1';
*/

/*
$route['exam/create'] = 'Exam/createExam';
$route['exam/loadSubEducation'] = 'Exam/load_subeducation';
$route['exam/loadLesson'] = 'Exam/load_lesson';
$route['exam/add'] = 'Exam/addExam';
$route['exam/test'] = 'Exam/test';
$route['exam/list'] = 'Exam/list';
$route['exam/continute'] = 'Exam/continuteCreateExam';


$route['set/list'] = 'Set/list';
$route['set/create'] = 'Set/createSet';
$route['set/add'] = 'Set/addSet';
$route['set/sort/(:num)'] = 'Set/sort/$1';
$route['set/preview/(:num)'] = 'Set/preview/$1';
$route['set/update'] = 'Set/updateSet';
$route['set/edit/(:num)'] = 'Set/editSet/$1';
$route['set/editShelfItem'] = 'Set/editShelfItem';
$route['set/editDetail/(:num)'] = 'Set/editSetDetail/$1';
$route['set/updateSetDetail'] = 'Set/updateSetDetail';
$route['set/loadSubEducation'] = 'Set/load_subeducation';

$route['quiz/loadQuiz'] = 'Quiz/loadByLesson';
$route['quiz/loadEditSet'] = 'Quiz/loadEditSetByLesson';

$route['login'] = 'User/login';
$route['logout'] = 'User/logout';
$route['user/validlogin'] = 'User/validlogin';
$route['changepassword'] = 'User/changePassword';
$route['user/updatePassword'] = 'User/updatePassword';

$route['subject/create'] = 'Subject/createSubject';
$route['subject/add'] = 'Subject/addSubject';
$route['subject/list'] = 'Subject/list';

$route['lesson/create'] = 'Lesson/createLesson';
$route['lesson/add'] = 'Lesson/addLesson';
$route['lesson/list'] = 'Lesson/list';
$route['lesson/loadSubEdu'] = 'Lesson/loadSubEdu';

$route['content/create'] = 'Content/createContent';
$route['content/add'] = 'Content/addContent';
$route['content/list'] = 'Content/list';
$route['content/list/(:any)'] = 'Content/list/$1';
$route['content/list/(:any)/(:any)'] = 'Content/list/$1/$2';
$route['content/edit/(:num)'] = 'Content/editContent/$1';
$route['content/loadSubCategory'] = 'Content/loadSubCategory';
$route['content/update'] = 'Content/updateContentDetail';
$route['content/tags'] = 'Content/getTags';

$route['category/add'] = 'Category/addCategory';
$route['category/list'] = 'Category/list';
$route['category/addSubcat'] = 'Category/addSubCategory';
$route['category/listSubcat'] = 'Category/listSubcat';

$route['officer/create'] = 'Officer/createOfficer';
$route['officer/add'] = 'Officer/addOfficer';
$route['officer/list'] = 'Officer/list';
$route['officer/loadDistrict'] = 'Officer/loadDistrict';
$route['officer/loadSubDistrict'] = 'Officer/loadSubDistrict';
$route['officer/preview/(:num)'] = 'Officer/previewOfficer/$1';
$route['officer/edit/(:num)'] = 'Officer/editOfficer/$1';
$route['officer/update'] = 'Officer/updateOfficer';
$route['officer/university'] = 'Officer/getUniversity';
$route['officer/school'] = 'Officer/getSchool';

$route['officerGroup/create'] = 'OfficerGroup/createOfficer';
$route['officerGroup/add'] = 'OfficerGroup/addOfficer';
$route['officerGroup/list'] = 'OfficerGroup/list';

$route['slide/list'] = 'Slide/list';
$route['slide/list/(:num)'] = 'Slide/list/$1';
$route['slide/create'] = 'Slide/createSlide';
$route['slide/add'] = 'Slide/addSlide';
$route['slide/sort'] = 'Slide/sort';
$route['slide/order'] = 'Slide/updateOrder';
$route['slide/status/(:num)/(:num)'] = 'Slide/updateStatus/$1/$2';
$route['slide/edit'] = 'Slide/editSlide';
$route['slide/update'] = 'Slide/updateSlide';
$route['slide/loadPage/(:num)'] = 'Slide/loadPage/$1';
*/