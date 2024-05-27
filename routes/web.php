<?php

use App\Http\Controllers\ListingController;
// use App\Models\Listing;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/////// Fetch All Listing   ///////
Route::get('/', [ListingController::class , 'index']);

/////// Show Create Form  ///////
Route::get('/listing/create', [ListingController::class, 'create']);

/////// Show Create Form  ///////
Route::post('/listing', [ListingController::class, 'store']);

/////// Fetch Single Listing  ///////
Route::get('/listing/{listing}', [ListingController::class, 'show']);






















// Route Models Binding
// Route::get('/listing/{listing}', function(Listing $listing){
//     return view('single-listing',[
//         'listing'=>$listing
//     ]);
// });

// Route::get('/hello', function (){
//     $newHeaders = [
//         'Content-Type'=>'text/plain',
//         'foo'=>'bar'
//     ];
//     return response('<h2>Hello World</h2>',200,$newHeaders);
// });

// Route::get('/posts/{id}', function ($id){
//     // dd($id);
//     return response('Post ID: '. $id);
// })->where('id', '[0-9]+');

// Route::get('/serach', function (Request $request) {
//     // dd($request);
//     return($request->price.' - '. $request->color);
// });
