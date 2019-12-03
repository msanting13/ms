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

// Route::get('/test', function () {
// 	for ($i=1; $i <= 5; $i++) { 
// 		for ($j=1; $j <= $i ; $j++) { 
// 			echo "*";
// 		}
// 		echo "<br>";
// 	}
// });

Route::resource('/my/blog','SampleController');

Auth::routes();

Route::get('/','HomeController@index')->name('home');

Route::group(['middleware' => ['role'], 'role' => ['role_admin']], function(){
	Route::prefix('admin')->group(function(){
		Route::get('dashboard/','DashboardController@index')->name('admin.dashboard');

		Route::get('/research/cards/message/{id}/edit','ResearchCardsController@editMessage');
		Route::put('/research/cards/message/update/{id}','ResearchCardsController@updateMessage')->name('update.message');

		Route::resource('/users','UserController');
	});
});

Route::group(['middleware' => ['auth','role'], 'role' => ['role_admin']], function(){
	//News
	Route::resource('manage/news','NewsController');
	Route::post('news/data','NewsController@newsData')->name('news.data');
	Route::get('news/{id}/status','NewsController@changeStatus');
	Route::post('news/upload/cover/{news}','NewsController@uploadNewsCover');
	//Announcement
	Route::resource('/manage/announcements','AnnouncementController');
	Route::post('announcements/data','AnnouncementController@announcementData')->name('announcement.data');
	//Events
	Route::resource('/manage/events','EventController');
});

Route::group(['middleware' => ['auth','role'], 'role' => ['role_user','role_admin']], function(){
	Route::resource('/research','ResearchBoardsController');
	Route::resource('/research/cards','ResearchCardsController');
});

Route::group(['middleware' => ['role'], 'role' => ['role_user']], function(){
	Route::prefix('user')->group(function(){
		Route::get('/dashboard','User\UserDashboardController@index')->name('user.dashboard');

		Route::get('/reports/submit/{id}','User\UserReportsController@create');
		Route::post('/reports/submit/store/{id}','User\UserReportsController@researchReportStore')->name('research.report.store');
		Route::get('/reports/{id}/edit','User\UserReportsController@researchReportEdit');
		Route::put('/reports/update/{id}','User\UserReportsController@researchReportUpdate')->name('research.report.name.update');
		Route::get('/reports/file/{id}/edit','User\UserReportsController@researchReportFileEdit');
		Route::put('/reports/file/update/{id}','User\UserReportsController@researchReportFileUpdate')->name('research.report.file.update');
	});
});
