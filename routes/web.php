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

Route::group(['middleware' => ['web']],function(){
    
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::post('/signUp',[
            'uses' => 'UserController@postSignUp',
            'as' => 'signUp'
    ]);

    Route::post('/signIn',[
        'uses' => 'UserController@postSignIn',
        'as' => 'signIn'
    ]);

    Route::get('/dashboard',[
        'uses' => 'PostController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);

    Route::post('/createpost',[
       'uses' => 'PostController@postCreatePost',
       'as' => 'post.create',
       'middleware' => 'auth'
    ]);

    Route::get('/post.delete/{post_id}',[
        'uses' => 'PostController@DeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth'
    ]);

    Route::get('/like/{p_id}',[
        'uses' => 'PostController@like',
        'as' => 'post.like',
        'middleware' => 'auth'
    ]);

    Route::get('/dislike/{p_id}',[
        'uses' => 'PostController@dislike',
        'as' => 'post.dislike',
        'middleware' => 'auth'
    ]);

    Route::get('/logout',[
        'uses' => 'UserController@Logout',
        'as' => 'logout',
        'middleware' => 'auth'
    ]);

    Route::get('/welcome',function(){
        return view('welcome');
    })->name('welcome');

    Route::get('/login',function(){
            return view('welcome');
    })->name('login');

    Route::post('/edit',[
        'uses' => 'PostController@EditPost',
        'as' => 'edit',
        'middleware' => 'auth'
    ]);

    Route::get('/account',[
       'uses' => 'UserController@account',
       'as' => 'account'
    ]);

    Route::post('/fileUpload',[
        'uses' => 'UserController@fileUpload',
        'as' => 'fileUpload'
    ]);

    Route::get('/accimg',[
        'uses' => 'UserController@getImage',
        'as' => 'account.image',
        'middleware' => 'auth'
    ]);

    Route::get('/postimage',[
        'uses' => 'UserController@getPostImage',
        'as' => 'post.image'
    ]);


    Route::post('/updateaccount',[
       'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);

});


Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/about',function(){
            return view('about');
    });
