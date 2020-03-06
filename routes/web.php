<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

// use Auth;

Route::get('/percentage', function(){
	if(!Hash::check('password', Auth::user()->password)){
		return 'not';
	}
})->name('test');

Auth::routes();

//Administrator/Vice President for Research & Extension
Route::group(['middleware' => ['auth','role'], 'role' => ['role_admin']], function(){
	Route::prefix('admin')->group(function(){
		Route::get('dashboard/','DashboardController@index')->name('admin.dashboard');

		Route::resource('manage/card', 'Admin\CardController');
		Route::get('/manage/card/message/{card}/edit','Admin\CardController@editMessage')->name('card.message.edit');
		Route::put('/manage/card/message/update/{card}','Admin\CardController@updateMessage')->name('card.message.update');

		Route::get('card/status/{card}','Admin\CardController@publish');

	});
});
Route::group(['middleware' => ['auth','role'], 'role' => ['role_admin']], function(){
	//Report
	//***Research***//
	Route::resource('admin-research','Admin\ResearchBoardsController');
	Route::get('/research/data/type/{type}','Admin\ResearchBoardsController@researchCardsData')->name('admin.research.card.data');
	
	Route::resource('admin-research/admin-research-card', 'Admin\CardController')->only(['show']);
	Route::post('admin-research-card/data/{id}','Admin\ResearchReportsController@researchReportsData')->name('admin.research.report.data');
	//Route::get('/research/report/card/details/{research_report}','ResearchReportsController@show');

	//***Extension***//
	Route::resource('admin-extension','Admin\ExtensionBoardsController');
	Route::get('/extension/data/type/{type}','Admin\ExtensionBoardsController@extensionCardData')->name('admin.extensions.card.data');

	Route::get('admin-extension/admin-extension-card/{card}', 'Admin\CardController@showExtension')->name('admin-extension-card.show');
	Route::post('admin-extension-card/data/{id}','Admin\ExtensionReportsController@extensionReportsData')->name('admin.extension.report.data');

	//News
	Route::resource('manage/news','Admin\NewsController');
	Route::post('news/data','Admin\NewsController@newsData')->name('news.data');
	Route::post('news/upload/cover/{news}','Admin\NewsController@uploadNewsCover')->name('news.upload.cover');
	Route::get('news/status/{news}','Admin\NewsController@publish');

	//Announcement
	Route::resource('/manage/announcements','Admin\AnnouncementController');
	Route::post('announcements/data','Admin\AnnouncementController@announcementData')->name('announcement.data');
	Route::get('announcements/status/{announcement}','Admin\AnnouncementController@publish');

	//Events
	Route::resource('/manage/events','Admin\EventController');
	Route::post('events/data','Admin\EventController@eventsData')->name('event.data');
	Route::get('events/status/{event}','Admin\EventController@publish');

	//Register Users
	Route::resource('manage/register-users', 'Admin\RegisterUserController');
	Route::post('/assign/roles/{user}','Admin\RegisterUserController@assignRole')->name('admin.assign.role');
	Route::put('/manage/users/account/{user}','Admin\RegisterUserController@updateUserAccount')->name('admin.update.register-user-account');
});

//Director
Route::group(['middleware' => ['auth','role'], 'role' => ['role_director']], function(){
	Route::prefix('director')->group(function(){
		Route::get('dashboard','Director\DashboardController@index')->name('director.dashboard');

		Route::get('director-research','Director\BoardsController@getResearch')->name('director-research');

		Route::resource('director-research-reports','Director\ResearchReportsController');
		Route::get('director-research-reports/index/{id}','Director\ResearchReportsController@index')->name('director-research-reports.index');
		Route::get('director-research-reports/data/{cardId}/{type}','Director\ResearchReportsController@directorResearchReportData')->name('director-research-reports.data');
		Route::get('director-research-reports/{id}/submit','Director\ResearchReportsController@create')->name('director-research-reports.create');
		Route::put('director-research-reports/post/{director_research_report}','Director\ResearchReportsController@postReport')->name('director-research-reports.post');
		//Export PDF
		Route::get('/director-research-reports/details/pdf/{director_research_report}','Director\ResearchReportsController@exportReportDetailspdf')->name('director-submitted-research-report-details.export-pdf');
		Route::get('/director-research-reports/pdf/{id}','Director\ResearchReportsController@exportReportspdf')->name('director-submitted-research-report.export-pdf');
		

		Route::get('director-extension','Director\BoardsController@getExtension')->name('director-extension');

		Route::resource('director-extension-reports','Director\ExtensionReportsController');
		Route::get('director-extension-reports/index/{id}','Director\ExtensionReportsController@index')->name('director-extension-reports.index');
		Route::get('director-extension-reports/data/{cardId}/{type}','Director\ExtensionReportsController@directorExtensionReportData')->name('director-extension-reports.data');
		Route::get('director-extension-reports/{id}/submit','Director\ExtensionReportsController@create')->name('director-extension-reports.create');
		Route::put('director-extension-reports/post/{director_extension_report}','Director\ExtensionReportsController@postReport')->name('director-extension-reports.post');
		//Export to pdf
		Route::get('/director-extension-reports/details/pdf/{id}','Director\ExtensionReportsController@exportReportDetailspdf')->name('director-submitted-extension-report-details.export-pdf');
		Route::get('/director-extension-reports/pdf/{id}','Director\ExtensionReportsController@exportReportspdf')->name('director-submitted-extension-report.export-pdf');

		//ExtensionReports Photos
		Route::resource('director-extension-reports-photos','Director\ExtensionReportPhotoController')->only(['destroy']);
		// Route::put('/research/cards/lock/{card}','CardController@lock')->name('lock.research.card');
		// Route::put('/research/cards/unlock/{card}','CardController@unlock')->name('unlock.research.card');

		Route::get('reports/data/{type}','Director\BoardsController@reportsData')->name('director-reports.data');
	});
});

//User
Route::group(['middleware' => ['auth','role'], 'role' => ['role_user']], function(){
	Route::prefix('user')->group(function(){
		Route::get('/dashboard','User\UserDashboardController@index')->name('user.dashboard');

		Route::get('user-research','User\BoardsController@getResearch')->name('user-research');

		Route::resource('user-research-reports','User\ResearchReportsController');
		Route::get('user-research-reports/index/{id}','User\ResearchReportsController@index')->name('user-research-reports.index');
		Route::get('user-research-reports/data/{cardId}/{type}','User\ResearchReportsController@userResearchReportData')->name('user-research-reports.data');
		Route::get('user-research-reports/{id}/submit','User\ResearchReportsController@create')->name('user-research-reports.create');
		Route::put('user-research-reports/post/{user_research_report}','User\ResearchReportsController@postReport')->name('user-research-reports.post');
		//Export to PDF
		Route::get('/user-research-reports/details/pdf/{id}','User\ResearchReportsController@exportReportDetailspdf')->name('user-submitted-research-report-details.export-pdf');
		Route::get('/user-research-reports/pdf/{id}','User\ResearchReportsController@exportReportspdf')->name('user-submitted-research-report.export-pdf');

		Route::get('user-extension','User\BoardsController@getExtension')->name('user-extension');

		Route::resource('user-extension-reports','User\ExtensionReportsController');
		Route::get('user-extension-reports/index/{id}','User\ExtensionReportsController@index')->name('user-extension-reports.index');
		Route::get('user-extension-reports/data/{cardId}/{type}','User\ExtensionReportsController@userExtensionReportData')->name('user-extension-reports.data');
		Route::get('user-extension-reports/{id}/submit','User\ExtensionReportsController@create')->name('user-extension-reports.create');
		Route::put('user-extension-reports/post/{user_extension_report}','User\ExtensionReportsController@postReport')->name('user-extension-reports.post');
		//Export to pdf
		Route::get('/user-extension-reports/details/pdf/{id}','User\ExtensionReportsController@exportReportDetailspdf')->name('user-submitted-extension-report-details.export-pdf');
		Route::get('/user-extension-reports/pdf/{id}','User\ExtensionReportsController@exportReportspdf')->name('user-submitted-extension-report.export-pdf');

		Route::post('image/upload','User\ExtensionReportsController@upload')->name('user-extension-reports.upload');

		//ExtensionReports Photos
		Route::resource('user-extension-reports-photos','User\ExtensionReportPhotoController')->only(['destroy']);

		Route::get('reports/data/{type}','User\BoardsController@reportsData')->name('user-reports.data');
	});
});

// Route::group(['middleware' => ['role'], 'role' => ['role_user','role_director']], function(){
// 	Route::prefix('user')->group(function(){

// 		//Research
// 		Route::resource('card/research-report','ResearchReportsController')->only(['create','store','edit','update','destroy']);
// 		Route::get('/research/card/report/file/{research_report}/edit','ResearchReportsController@editReportFile');
// 		Route::put('/research/card/report/file/{research_report}','ResearchReportsController@updateReportFile')->name('report.research.file.update');

// 		//Extension
// 		Route::resource('card/extension-report','ExtensionReportsController')->only(['create','store','edit','update','destroy']);
// 		Route::post('/extension/card/report/photos/{extensionReport}','ExtensionReportsController@addPhotos')->name('add.extension.report.photo');
// 		Route::get('/extension/card/report/photos/{extensionReport}/edit','ExtensionReportsController@editReportPhoto');
// 		Route::resource('card/extension-report/extension-photos','ExtensionReportPhotoController')->only(['show','update','destroy']);
// 	});
// });

//Account Settings
Route::group(['middleware' => ['auth','role'], 'role' => ['role_user','role_director','role_admin']], function(){
	Route::resource('/account/settings','AccountSettingsController');
	Route::put('/account/settings/credentials/{setting}','AccountSettingsController@updateCredentials');
	Route::put('/account/settings/account-picture/{setting}','AccountSettingsController@changeProfilePicture');
});

Route::get('/','HomeController@index')->name('home');
Route::prefix('news')->group(function(){
	Route::get('/details/{news}','HomeController@viewNewsDetails')->name('news.details');
});
Route::prefix('announcements')->group(function(){
	Route::get('/details/{announcement}','HomeController@viewAnnouncementDetails')->name('announcement.details');
});
Route::prefix('events')->group(function(){
	Route::get('/details/{event}','HomeController@viewEventDetails')->name('event.details');
});
