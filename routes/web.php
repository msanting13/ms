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

Route::get('/percentage', function(){
	$wl = 7;
	$total = 7;
	return $percent = ceil(($wl / $total) * 100).'%';
});

Auth::routes();

Route::group(['middleware' => ['auth','role'], 'role' => ['role_admin']], function(){
	Route::prefix('admin')->group(function(){
		Route::get('dashboard/','DashboardController@index')->name('admin.dashboard');

		Route::resource('manage/card', 'CardController')->only(['index', 'store', 'edit', 'update', 'destroy']);
		Route::get('/manage/card/message/{card}/edit','CardController@editMessage')->name('card.message.edit');
		Route::put('/manage/card/message/update/{card}','CardController@updateMessage')->name('card.message.update');
	});
});

Route::group(['middleware' => ['auth','role'], 'role' => ['role_admin']], function(){
	//News
	Route::resource('manage/news','NewsController');
	Route::post('news/data','NewsController@newsData')->name('news.data');
	Route::post('news/upload/cover/{news}','NewsController@uploadNewsCover');
	Route::get('news/status/{news}','NewsController@publish');
	//Announcement
	Route::resource('/manage/announcements','AnnouncementController');
	Route::post('announcements/data','AnnouncementController@announcementData')->name('announcement.data');
	Route::get('announcements/status/{announcement}','AnnouncementController@publish');
	//Events
	Route::resource('/manage/events','EventController');
	Route::post('events/data','EventController@eventsData')->name('event.data');
	Route::get('events/status/{event}','EventController@publish');

	//Register Users
	Route::post('/assign/roles/{user}','RegisterUserController@assignRole')->name('admin.assign.role');
	Route::put('/manage/users/account/{user}','RegisterUserController@updateUserAccount');
	Route::resource('/manage/users', 'RegisterUserController');
});

Route::group(['middleware' => ['auth','role'], 'role' => ['role_director']], function(){
	Route::prefix('director')->group(function(){
		Route::get('dashboard/','Director\DashboardController@index')->name('director.dashboard');
		Route::put('/research/cards/lock/{card}','CardController@lock')->name('lock.research.card');
		Route::put('/research/cards/unlock/{card}','CardController@unlock')->name('unlock.research.card');
	});
});

Route::group(['middleware' => ['auth','role'], 'role' => ['role_user','role_director','role_admin']], function(){
	Route::resource('/account/settings','AccountSettingsController');
	Route::put('/account/settings/credentials/{setting}','AccountSettingsController@updateCredentials');
	Route::put('/account/settings/account-picture/{setting}','AccountSettingsController@changeProfilePicture');

	//***Research***//
	Route::resource('research/card', 'CardController')->only(['show']);
	Route::resource('research','ResearchBoardsController');
	Route::post('/research/card/data/type/{type}','ResearchBoardsController@researchCardsData')->name('research.card.data');

	Route::post('/research/card/report/data/{id}','ResearchReportsController@researchReportsData')->name('research.report.card.data');

	// Route::get('/research/report/card/details/{reportable}','ResearchCardsController@showCompleteDetails');

	//***Extension***//
	Route::get('extension/card/{card}', 'CardController@showExtension')->name('extension.card.show');
	Route::resource('extension','ExtensionBoardsController');
	Route::post('/extension/card/data/type/{type}','ExtensionBoardsController@extensionCardData')->name('extensions.card.data');
	Route::post('/extension/card/report/data/{id}','ExtensionReportsController@extensionReportsData')->name('extension.report.card.data');
});

Route::group(['middleware' => ['role'], 'role' => ['role_user','role_director']], function(){
	Route::prefix('user')->group(function(){
		Route::get('/dashboard','User\UserDashboardController@index')->name('user.dashboard');

		//Research
		Route::resource('card/research-report','ResearchReportsController')->only(['create','store','edit','update','destroy']);
		Route::get('/research/card/report/file/{research_report}/edit','ResearchReportsController@editReportFile');
		Route::put('/research/card/report/file/{research_report}','ResearchReportsController@updateReportFile')->name('report.research.file.update');

		//Extension
		Route::resource('card/extension-report','ExtensionReportsController')->only(['create','store','edit','update','destroy']);
		Route::post('/extension/card/report/photos/{extensionReport}','ExtensionReportsController@addPhotos')->name('add.extension.report.photo');
		Route::get('/extension/card/report/photos/{extensionReport}/edit','ExtensionReportsController@editReportPhoto');
		Route::resource('card/extension-report/photos','ExtensionReportPhotoController')->only(['show','update','destroy']);
	});
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

