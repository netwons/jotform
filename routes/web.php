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

Route::get('/', 'HomeController@index');
Route::get('/index',function (){
   return view('index');
});
Route::get('/n',function (){
    $file=file_get_contents('header.html');
    preg_match_all('/<div id=\"t\">[\W\w]*?<\/div>/im',$file,$f);
$file2=fopen('w.html','w');
fwrite($file2,"<html><body><head style=\"margin: 55px; padding: 20px\">
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /> </head>".implode($f[0])."</body></html>");
fclose($file2);
$file3=file_get_contents('w.txt');
  echo exec("wkhtmltopdf --header-html www.google.com w.html 2.pdf");
});

//Route::get('/n',function (){
//    $number='09394298809';
//    $message='salam';
//    return redirect('https://api.kavenegar.com/v1/6C426963442F4D703953474E5477323844395143673230454D30355438486E48/sms/send.json?receptor='.$number.'&sender=10004346&message='.$message);
//});
Route::get('/m',function (){
    $ip=$_SERVER['REMOTE_ADDR'];
    return $ip;
});
Route::get('/jj',function(){

    $t='/upload/images/2019-10-7';
    //print_r(scandir($t));
return public_path($t);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





