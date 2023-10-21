<?php

use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| Front Routes 
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    Route::get('/', 'FrontController@index')->name('welcome');
    Route::get('/about', 'FrontController@about')->name('about');
    Route::get('/qr_code', 'FrontController@qrCode')->name('qrcode');
    Route::get('/courses', 'FrontController@courses')->name('courses');
    Route::get('/course/{id}', 'FrontController@courseDetails')->name('course.details');
    Route::get('/contact', 'FrontController@contact')->name('contact');
    Route::get('/signin', 'FrontController@signin')->name('signin');
    
    Route::post('/message', 'FrontController@message')->name('message');
    Route::post('/booking', 'FrontController@booking')->name('booking');
    Route::post('/addSubscribe', 'FrontController@addSubscribe')->name('addSubscribe');
});

Route::get('/admin', function () {return redirect('/login');});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Roles Routes 
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'auth','localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () 
{

    Route::get('/userprofile', 'FrontController@profile')->name('userprofile');
    Route::post('/edituserprofile', 'FrontController@editprofile')->name('editprofile');
    /*
    |--------------------------------------------------------------------------
    | Admin Routes 
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'admin','middleware' => [ 'admin' ]], function () 
    {
        Route::get('/home', 'MasterController@index')->name('home');
        Route::get('/profile', 'MasterController@profile')->name('profile');
        
        Route::get('/calendar', 'MasterController@calendar')->name('calendar');
        
        /*
        |--------------------------------------------------------------------------
        | Staff
        |--------------------------------------------------------------------------
        */        
        Route::resource('/staff', 'Admin\Staff\StaffController'); 
        Route::get('/staff/{id}/profile', 'Admin\Staff\StaffController@profile')->name('staff.profile');
        Route::post('/disablestaff', 'Admin\Staff\StaffController@disable')->name('staff-disable');
        
        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */        
        Route::resource('/customer', 'Admin\Customer\CustomerController'); 
        Route::get('/customer/{id}/profile', 'Admin\Customer\CustomerController@profile')->name('customer.profile');
        Route::post('/disablecustomer', 'Admin\Customer\CustomerController@disable')->name('customer.disable');


        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */
        Route::resource('/courses', 'Admin\Courses\CoursesController'); 
        Route::post('/disablecourse', 'Admin\Courses\CoursesController@disable')->name('course-disable');
        Route::post('/delete-course', 'Admin\Courses\CoursesController@delete')->name('delete-courses');
        Route::get('/course/requestes', 'Admin\Courses\CoursesController@requestes')->name('course-requestes');
        Route::post('/courserequestaccept', 'Admin\Courses\CoursesController@accept')->name('course-request-accept');
        Route::post('/topMonth', 'Admin\Courses\CoursesController@topMonth')->name('course-top');
        Route::post('/courseRemoveVideo', 'Admin\Courses\CoursesController@removeVideo')->name('course.remove.video');

         /*
        |--------------------------------------------------------------------------
        | qrcodes
        |--------------------------------------------------------------------------
        */
        // Route::resource('/qrcode', 'Admin\qrCode\QrCodeController'); 
        // Route::post('/disableqrcode', 'Admin\qrCode\QrCodeController@disable')->name('qrcode-disable');
        // Route::post('/qrcode/{id}', 'Admin\qrCode\QrCodeController@delete')->name('delete-qrcode');
        // Route::get('/qrcode/requestes', 'Admin\qrCode\QrCodeController@requestes')->name('qrcode-requestes');
        // Route::post('/qrcoderequestaccept', 'Admin\qrCode\QrCodeController@accept')->name('qrcode-request-accept');
        Route::get('/qrcode', 'Admin\qrCode\QrCodeController@index')->name('qrcode.index');
        Route::get('/qrcode/create', 'Admin\qrCode\QrCodeController@create')->name('qrcode.create');
        Route::post('/qrcode', 'Admin\qrCode\QrCodeController@store')->name('qrcode.store');
        Route::get('/qrcode/{qrcode}/edit', 'Admin\qrCode\QrCodeController@edit')->name('qrcode.edit');
        Route::put('/qrcode/{qrcode}', 'Admin\qrCode\QrCodeController@update')->name('qrcode.update');
        Route::get('/qrcode/{qrcode}', 'Admin\qrCode\QrCodeController@delete')->name('qrcode.delete');
        // Route::post('/topMonth', 'Admin\qrCode\QrCodeController@topMonth')->name('qrcode-top');
        
        

        /*
        |--------------------------------------------------------------------------
        | Courses Category
        |--------------------------------------------------------------------------
        */
        Route::resource('/coursecategory', 'Admin\Courses\CoursesCategoryController');
        Route::post('/disablecoursecategory', 'Admin\Courses\CoursesCategoryController@disable')->name('course-category-disable');
        Route::get('/activecoursecategory', 'Admin\Courses\CoursesCategoryController@active')->name('active-course-category');
        Route::get('/deactivecoursecategory', 'Admin\Courses\CoursesCategoryController@deactive')->name('deactive-course-category');


        /*
        |--------------------------------------------------------------------------
        | Team
        |--------------------------------------------------------------------------
        */
        Route::resource('/team', 'Admin\Team\TeamController'); 
        Route::post('/removeteam', 'Admin\Team\TeamController@removeteam')->name('remove-team');


        /*
        |--------------------------------------------------------------------------
        | Achievements
        |--------------------------------------------------------------------------
        */
        Route::resource('/achievements', 'Admin\Achievement\AchievementController'); 
        Route::post('/disableAchievement', 'Admin\Achievement\AchievementController@disable')->name('achievements.disable');


        /*
        |--------------------------------------------------------------------------
        | FAQ
        |--------------------------------------------------------------------------
        */
        Route::resource('/faq', 'Admin\Faq\FaqController'); 
        Route::post('/removeFaq', 'Admin\Faq\FaqController@remove')->name('faq.remove');

        
        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */
        Route::resource('/order', 'Admin\Order\OrderController'); 

        /*
        |--------------------------------------------------------------------------
        | Others
        |--------------------------------------------------------------------------
        */ 
        Route::resource('/permissions', 'Admin\Permissions\PermissionsController'); 
        Route::get('/logo', 'MasterController@logo')->name('admin-logo');
        Route::get('/setting', 'MasterController@setting')->name('admin-setting');
        Route::get('/messages', 'MasterController@messages')->name('messages');
        Route::get('/subscribers', 'MasterController@subscribers')->name('subscribers');
        Route::get('/socialmedia', 'MasterController@socialmedia')->name('socialmedia');
        
        Route::post('/social', 'MasterController@social')->name('social');
        Route::post('/getreceiveremail', 'MasterController@getreceiveremail')->name('getreceiveremail');
        Route::post('/receiveremail', 'MasterController@receiveremail')->name('receiveremail');
        Route::post('/getmessage', 'MasterController@getmessage')->name('getmessage');

        Route::get('/slideshow/{lang}', 'Admin\Slider\SliderController@index')->name('admin-show-slider');
        Route::post('/updateslideshow', 'Admin\Slider\SliderController@updatephotos')->name('admin-update-slider');
        Route::post('/removeslider', 'Admin\Slider\SliderController@removegallery')->name('remove-slider');

        Route::post('/getslidertext', 'Admin\Slider\SliderController@getslidertext')->name('getslidertext');
        Route::post('/updateslidertext', 'Admin\Slider\SliderController@updateslidertext')->name('updateslidertext');
        
    });


});


    /*
    |--------------------------------------------------------------------------
    | Back Routes (Admin Actions)
    |--------------------------------------------------------------------------
    */

    Route::post('/changelogo', 'MasterController@changelogo')->name('changelogo');
    Route::post('/editsetting', 'MasterController@editsetting')->name('edit-setting');
    Route::post('/editinfo', 'MasterController@editinfo')->name('edit-info');
    Route::post('/changeProfilePicture', 'MasterController@changeProfilePicture')->name('change-profile-picture');
    Route::post('/changepassword', 'MasterController@changepassword')->name('change-password');
    Route::post('/enableuser', 'MasterController@enableuser')->name('enable-user');

    /*
    |--------------------------------------------------------------------------
    | To-Do List
    |--------------------------------------------------------------------------
    */

    Route::post('/addtodo', 'MasterController@addtodo')->name('add-todo');
    Route::post('/gettodo', 'MasterController@gettodo')->name('get-todo');
    Route::post('/edittodo', 'MasterController@edittodo')->name('edit-todo');
    Route::post('/removetodo', 'MasterController@removetodo')->name('remove-todo');

    /*
    |--------------------------------------------------------------------------
    | Notes
    |--------------------------------------------------------------------------
    */
        
    Route::post('/createnote', 'MasterController@createnote')->name('create-note');
    Route::post('/addnote', 'MasterController@addnote')->name('add-note');
    Route::post('/getnote', 'MasterController@getnote')->name('get-note');
    Route::post('/shownote', 'MasterController@shownote')->name('show-note');
    Route::post('/editnote', 'MasterController@editnote')->name('edit-note');
    Route::post('/removenote', 'MasterController@removenote')->name('remove-note');

    /*
    |--------------------------------------------------------------------------
    | Calendar
    |--------------------------------------------------------------------------
    */
        
    Route::get('/getevent/{user}', 'MasterController@getevent')->name('get-event');
    Route::post('/addevent', 'MasterController@addevent')->name('add-event');
    Route::post('/updateevent', 'MasterController@updateevent')->name('update-event');
    Route::post('/showevent', 'MasterController@showevent')->name('show-event');
    Route::post('/editnevent', 'MasterController@editevent')->name('edit-event');
    Route::post('/removeevent', 'MasterController@removeevent')->name('remove-event');


    /*
    |------------------------------------------------------------------------
    | Link Storage
    |------------------------------------------------------------------------
    */

    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });

    Route::get('/clearcache', function () {
        Artisan::call('cache:clear');
    })->name('clearcache');
    
    Route::get('/clearconfig', function () {
        Artisan::call('config:clear');
    })->name('clearconfig');

