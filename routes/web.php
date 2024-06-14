<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix'=>'yonetim', 'namespace' => 'Yonetim'], function(){
    Route::get('/', function() {
        return "Admin";
    });
    Route::redirect('/', '/yonetim/giris');
    Route::match(['get', 'post'], '/giris', 'KullaniciController@giris')->name('yonetim.giris');

});



//ana istek geldiğinde front.indexte çalışır
Route::get('/','front\indexController@index')->name('index');
Route::get('/kategori/{selflink}','front\cat\indexController@index')->name('cat');
Route::get('/search','front\search\indexController@index')->name('search');
Route::get('/kitap/detay/{selflink}','front\kitap\indexController@index')->name('kitap.detay');
Route::get('/haber/detay/{selflink}','front\haber\indexController@index')->name('haber.detay');
Route::get('/basket/add/{id}','front\basket\indexController@add')->name('basket.add');
Route::get('/basket/remove/{id}','front\basket\indexController@remove')->name('basket.remove');
Route::get('/basket/flush','front\basket\indexController@flush')->name('basket.flush');
Route::get('/basket/complete','front\basket\indexController@complete')->name('basket.complete')->middleware(['auth']);
Route::post('/basket/complete','front\basket\indexController@completeStore')->name('basket.completeStore')->middleware(['auth']);
Route::get('/basket','front\basket\indexController@index')->name('basket.index');
//Route::get('/admin','admin\giris\indexController@index')->name('index');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// admin controllerının içinde çalışacak
Route::group(['namespace'=> 'admin', 'prefix'=> 'admin', 'as'=>'admin.'], function() {
    Route::redirect('/', '/admin/giris'); //herhangi bir admin sayfası açıldığında girişe yönlendirir
    Route::match(['get', 'post'], '/giris', 'KullaniciController@giris')->name('giris'); //get-post ayrı ayrı değil
    Route::get('/cikis','KullaniciController@cikis')->name('cikis');

    //Route::get('/kayit', 'KullaniciController@kayit')->name('kayit');

    Route::group(['middleware' => 'admin'], function() { //müşteri olarak giriş yapmamak için auth değil yeni middleware
        Route::get('/','indexController@index')->name('index'); //admin.index name('index')


        Route::group(['namespace'=> 'yayinevi', 'prefix'=> 'yayinevi', 'as'=>'yayinevi.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'yazar', 'prefix'=> 'yazar', 'as'=>'yazar.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'kitap', 'prefix'=> 'kitap', 'as'=>'kitap.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'kategori', 'prefix'=> 'kategori', 'as'=>'kategori.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'slider', 'prefix'=> 'slider', 'as'=>'slider.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'haberler', 'prefix'=> 'haberler', 'as'=>'haberler.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'order', 'prefix'=> 'order', 'as'=>'order.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/detail/{id}','indexController@detail')->name('detail');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });

        Route::group(['namespace'=> 'kullanıcı', 'prefix'=> 'kullanıcı', 'as'=>'kullanıcı.'], function() {
            Route::get('/','indexController@index')->name('index'); //admin.yayinevi.index
            Route::get('/ekle','indexController@create')->name('create');
            Route::post('/ekle','indexController@store')->name('create.post');
            Route::get('/duzenle/{id}','indexController@edit')->name('edit');
            Route::post('/duzenle/{id}','indexController@update')->name('edit.post');
            Route::get('/sil/{id}','indexController@delete')->name('delete');
        });
    });



});






