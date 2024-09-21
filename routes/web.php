<?php

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;

/*--------------------------------------------------------------
| BACKEND ROUTES
|--------------------------------------------------------------*/

Route::prefix('admin')->name('admin.')->middleware(isAdmin::class)->group(function () {

    Route::get('panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
    Route::get('cikis', 'App\Http\Controllers\Back\auth@logOut')->name('logout');
    Route::get('/ayarlar', 'App\Http\Controllers\Back\ConfigController@index')->name('config.index');
    Route::get('/ayarlar/switch', 'App\Http\Controllers\Back\ConfigController@switch')->name('config.switch');
    Route::post('/ayarlar/update', 'App\Http\Controllers\Back\ConfigController@update')->name('config.update');

    //Kategori
    Route::get('/kategoriler/switch', 'App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
    Route::post('/kategoriler/delete', 'App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');
    Route::post('/kategoriler/create', 'App\Http\Controllers\Back\CategoryController@create')->name('category.create');
    Route::post('/kategoriler/update', 'App\Http\Controllers\Back\CategoryController@update')->name('category.update');
    Route::get('kategoriler', 'App\Http\Controllers\Back\CategoryController@index')->name('category.index');
    Route::get('kategoriler/getData', 'App\Http\Controllers\Back\CategoryController@getData')->name('category.getdata');

    //Makaleler
    Route::get('switch', 'App\Http\Controllers\Back\ArticleController@switch')->name('switch');
    Route::get('makaleler/silinenler', 'App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');
    Route::get('/deletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', 'App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');
    Route::resource('makaleler', 'App\Http\Controllers\Back\ArticleController');

    //Sayfalar
    Route::get('/sayfalar', 'App\Http\Controllers\Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/create', 'App\Http\Controllers\Back\PageController@create')->name('page.create');
    Route::get('/sayfalar/edit/{id}', 'App\Http\Controllers\Back\PageController@edit')->name('page.edit');
    Route::post('/sayfalar/update/{id}', 'App\Http\Controllers\Back\PageController@update')->name('page.update');
    Route::get('/sayfalar/delete/{id}', 'App\Http\Controllers\Back\PageController@delete')->name('page.delete');
    Route::post('/sayfalar/create', 'App\Http\Controllers\Back\PageController@createPost')->name('page.create.post');
    Route::get('/sayfalar/switch', 'App\Http\Controllers\Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/orders', 'App\Http\Controllers\Back\PageController@orders')->name('page.orders');

});

Route::prefix('admin')->name('admin.')->middleware(isLogin::class)->group(function () {

    Route::get('giris', 'App\Http\Controllers\Back\auth@login')->name('login');
    Route::post('giris', 'App\Http\Controllers\Back\auth@loginPost')->name('login.post');

});

/*--------------------------------------------------------------
| BACKEND END
|--------------------------------------------------------------*/

/*--------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------*/

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/site-offline', function () {
    return view('front.offline');
})->name('offline');
Route::get('/sayfa', 'App\Http\Controllers\Front\Homepage@index');

Route::post('/iletisim', 'App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');
Route::get('/iletisim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');

Route::get('/{page}', 'App\Http\Controllers\Front\Homepage@page')->name('page');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'App\Http\Controllers\Front\Homepage@single')->name('single');

/*--------------------------------------------------------------
| FRONTEND ROUTES END
|--------------------------------------------------------------*/
