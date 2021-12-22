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

Route::get('/', function () {
    return view('index');
});

//Auth::routes();



Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');


Route::get('/createuser', function () {
    return view('createuser');
})->middleware('auth');

Route::post('/adduserentry', [App\Http\Controllers\userentryController::class, 'userentry']);


Route::post('/createuser', [App\Http\Controllers\userentryController::class, 'usertabledatafetch'])->name('usertabledatafetch');

Route::post('/edituserform', [App\Http\Controllers\userentryController::class, 'edituserform']);
Route::post('/deleteUserRoute', [App\Http\Controllers\userentryController::class, 'deleteUser']);


Route::get('/prouductentry', function () {
    return view('prouductentry');
})->middleware('auth');


Route::get('/prouductcategory', function () {
    return view('prouductcategory');
})->middleware('auth');




Route::post('/productCategoryentry', [App\Http\Controllers\ProductCategoryController::class, 'productCategoryentry']);


Route::post('/getproductcategory', [App\Http\Controllers\ProductCategoryController::class, 'getproductname']);

Route::post('/addproductentry', [App\Http\Controllers\ProductCategoryController::class, 'addproductentry']);
Route::post('/getAllProductsRoute', [App\Http\Controllers\ProductCategoryController::class, 'getAllProductslist']);

Route::get('/placeorder/{id}', [App\Http\Controllers\ProductCategoryController::class, 'getproductid']);

Route::get('/image/{id}', [App\Http\Controllers\imageviewController::class, 'imageview']);


Route::post('/addtocartroute', [App\Http\Controllers\ProductCategoryController::class, 'getproductid']);



Route::get('/addtocart', function () {
    return view('addtocart');
});

Route::get('/addtocart', [App\Http\Controllers\ProductCategoryController::class, 'getcartdata']);


Route::post('/totalprice', [App\Http\Controllers\ProductCategoryController::class, 'totalprice']);

Route::get('/cartid/{id}', [App\Http\Controllers\ProductCategoryController::class, 'deletecartprodut']);





Route::post('/cartdataadd', [App\Http\Controllers\ProductCategoryController::class, 'cartdataadd']);



Route::get('/productview', function () {
    return view('productview');
})->middleware('auth');


Route::get('/viewimage', function () {
    return view('viewimage');
});

Route::get('/viewimage', [App\Http\Controllers\imageviewController::class, 'getimageviewlist']);


Route::post('/productview', [App\Http\Controllers\ProductCategoryController::class, 'viewproductlistroute'])->name('viewproductlistroute');



Route::post('/checkdiscountandprice', [App\Http\Controllers\ProductCategoryController::class, 'checkdiscountandprice']);
Route::post('/updateaddtocartstatus', [App\Http\Controllers\ProductCategoryController::class, 'updateaddtocartstatus']);


Route::post('/geteditproductlist', [App\Http\Controllers\ProductCategoryController::class, 'geteditproductlist']);

Route::post('/editproduct', [App\Http\Controllers\ProductCategoryController::class, 'editproduct']);


Route::post('/deleteproductRoute', [App\Http\Controllers\ProductCategoryController::class, 'deleteproductRoute']);



Route::post('/discountform', [App\Http\Controllers\ProductCategoryController::class, 'discountform']);



Route::get('/addedcart', function () {
    return view('addedcart');
})->middleware('auth');

Route::get('/addedcart', [App\Http\Controllers\addedcartController::class, 'getdataaddedcarttable']);


Route::post('/promocode', [App\Http\Controllers\addedcartController::class, 'promocode']);
Route::post('/totalpriceaddedcart', [App\Http\Controllers\addedcartController::class, 'totalsumaddedcart']);


Route::post('/checkproductdiscount', [App\Http\Controllers\addedcartController::class, 'checkproductdiscount']);



Route::post('/makepayment', [App\Http\Controllers\paymentController::class, 'makepayment']);





//bkahs start
Route::post('/token', [App\Http\Controllers\BkashController::class, 'token'])->name('token');

Route::get('/createpayment', [App\Http\Controllers\BkashController::class, 'createpayment'])->name('createpayment');
Route::get('/executepayment', [App\Http\Controllers\BkashController::class, 'executepayment'])->name('executepayment');

//bkahs end
Route::post('/paymentinsertroute', [App\Http\Controllers\BkashController::class, 'paymentinsert']);



Route::get('/payment', function () {
    return view('payment');
})->middleware('auth');


Route::get('/payment', [App\Http\Controllers\paymentController::class, 'checkcustomerpayment']);


Route::get('/createoffer', function () {
    return view('createoffer');
})->middleware('auth');

Route::post('/getproductnametoffer', [App\Http\Controllers\CreateofferController::class, 'getproductnametoffer']);

Route::post('/createofferspecialandfestival', [App\Http\Controllers\CreateofferController::class, 'createofferspecialandfestivalinsert']);

Route::post('/chechout', [App\Http\Controllers\addedcartController::class, 'chechout']);


Route::get('/checkpayment', function () {
    return view('checkpayment');
})->middleware('auth');


Route::post('/checkpayment', [App\Http\Controllers\paymentController::class, 'getinvoicedata'])->name('getinvoicedata');


Route::get('/order/{id}', [App\Http\Controllers\invoiceController::class, 'orders']);


Route::get('order/status/paid/{id}', [App\Http\Controllers\invoiceController::class, 'updatepaymentstatuspaid']);
Route::get('order/status/unpaid/{id}', [App\Http\Controllers\invoiceController::class, 'updatepaymentstatusunpaid']);

Route::post('/prouductcategory', [App\Http\Controllers\ProductCategoryController::class, 'viewproductcategory'])->name('viewproductcategory');

Route::post('/updateproduct', [App\Http\Controllers\ProductCategoryController::class, 'updateproduct']);

Route::post('/deleteproduct', [App\Http\Controllers\ProductCategoryController::class, 'deleteproduct']);
Route::get('/prouductofferview', function () {
    return view('prouductofferview');
})->middleware('auth');

Route::post('/prouductofferview', [App\Http\Controllers\CreateofferController::class, 'getproductoffer'])->name('getproductoffer');

Route::post('/getproductoffernametoedit', [App\Http\Controllers\CreateofferController::class, 'getproductnametoffer']);

Route::post('/updateproductoffer', [App\Http\Controllers\CreateofferController::class, 'updateproductoffer']);

Route::post('/deleteproductoffers', [App\Http\Controllers\CreateofferController::class, 'deleteproductoffers']);


// 


Route::post('/updatequantityandtotalprice', [App\Http\Controllers\ProductCategoryController::class, 'updatequantityandtotalprice']);


Route::get('/contract', function () {
    return view('contract');
});



Route::get('/prouductcgeneration', function () {
    return view('prouductcgeneration');
})->middleware('auth');

//Route::get('/', [App\Http\Controllers\producttypeController::class, 'producttype']);
//Route::get('/home', [App\Http\Controllers\producttypeController::class, 'producttype']);

Route::get('/prouductentry', [App\Http\Controllers\ProductCategoryController::class, 'selectgeneration']);

Route::post('/getgenerationProductsRoute', [App\Http\Controllers\producttypeController::class, 'getgenerationProductslist']);

Route::post('/addproductgeneration', [App\Http\Controllers\producttypeController::class, 'addproductgeneration']);

Route::post('/prouductcgeneration', [App\Http\Controllers\producttypeController::class, 'viewproductggenerations'])->name('viewproductggenerations');

Route::post('/deleteproducttype', [App\Http\Controllers\producttypeController::class, 'deleteproducttype']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');





Route::post('/getproductsize', [App\Http\Controllers\ProductCategoryController::class, 'getproductsize']);


Route::post('/sizeentry', [App\Http\Controllers\ProductCategoryController::class, 'sizeupdate']);

Route::get('/size/{id}', [App\Http\Controllers\ProductCategoryController::class, 'viewsizeasproduct']);


Route::get('/productsizeentry', function () {
    return view('productsizeentry');
})->middleware('auth');

Route::get('/productsizeentry', [App\Http\Controllers\ProductCategoryController::class, 'getproductcategorydata']);

Route::post('/productsizeentrys', [App\Http\Controllers\ProductCategoryController::class, 'productsizeentry']);
Route::post('/productsizeentry', [App\Http\Controllers\ProductCategoryController::class, 'viewproductsize'])->name('viewproductsize');



Route::post('/deleteproductsize', [App\Http\Controllers\ProductCategoryController::class, 'deleteproductsize']);


Route::post('/dashboardgetiboxdata', [App\Http\Controllers\dashboardController::class, 'dashboardgetiboxdata']);

Route::post('/highchart', [App\Http\Controllers\dashboardController::class, 'highchart']);







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);
