<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController; 
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController;



Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'controller'=>PublicController::class,
],function(){
    Route::get('index','index')->name('index');
    Route::get('about','about')->name('about');
    Route::get('contact','contact')->name('contact');
    Route::get('category','category')->name('category');
    Route::get('testimonial','testimonial')->name('testimonial');
    Route::get('job-list','joblist')->name('joblist');
    Route::get('job-details','jobdetails')->name('jobdetails');
    
});


//admin
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

Route::group(['prefix' =>'admin'], function(){
    Route::group([
        'controller'=>JobController::class,
        'prefix'=>'jobs',
         'as'=>'jobs.',
         
    ],function(){
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('index','index')->name('index')->middleware('verified');
        Route::get('{id}/show','show')->name('show');
        Route::get('{id}/edit','edit')->name('edit');
        Route::put('{id}/update','update')->name('update');
        Route::delete('{id}/delete','destroy')->name('delete');
        Route::delete('{id}/restore','restore')->name('restore');
    }); 
    
    Route::group([
        'controller'=>CategoryController::class,
        'prefix'=>'categories',
         'as'=>'categories.',
    ],function(){
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('index','index')->name('index');
        Route::get('{id}/edit','edit')->name('edit');
        Route::put('{id}/update','update')->name('update');
    }); 
    Route::group([
        'controller'=>TestimonialController::class,
        'prefix'=>'test',
         'as'=>'test.',
    ],function(){
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        
    }); 

});
 });


// Admin/JobController
// Admin/CategoryController

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('contactus', [ContactController::class, 'index'])->name('contact.index');
Route::post('contactus', [ContactController::class, 'send'])->name('contact.send');