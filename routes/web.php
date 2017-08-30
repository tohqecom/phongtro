<?php
use App\Http\Middleware\beforeCheckAdmin;
use App\Rent;

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
    return view('welcome');
});

Route::get('/cars/add',function(){
    return view('/cars/create');
})->name('cars/add')->middleware(BeforeCheckAdmin::class);

Route::get('/users/add',function(){
    return view('/users/create');
})->name('users/add')->middleware(BeforeCheckAdmin::class);;



Route::get('/cars/rent{id?}',function($id){
    $car = \DB::table('cars')
        ->join('car_details','cars.id','=','car_details.car_id')
        ->select('cars.*','car_details.*')
        ->where('cars.id','=',$id)
        ->first();
   return view('/cars/rent', ['car' => $car]);
})->name('cars/rent');


Route::post('/cars/rent{car_id}/{user_id?}','RentsController@addRent')->name('cars/rent');

Route::get('/rents{id}','RentsController@index')->name('/rents');

Route::get('/rents',function(){
    $rents = \DB::table('rents')
        ->join('cars','cars.id','=','rents.car_id')
        ->join('users','users.id', '=','rents.user_id')
        ->select('cars.*','rents.date_start','rents.date_end','rents.paid', 'rents.old','users.name')
        ->get();
    return view('/rents/all',['rents' => $rents]);
})->middleware(beforeCheckAdmin::class)->name('rents');


/**/

Route::resource('cars','CarController',[
    'names' => [
        'destroy' => 'cars-delete',
        'show' => 'cars-edit',
        'update' => 'cars-update',
        'index' => 'cars',
        // etc...
    ]
]);

Route::resource('users','UsersController',[
    'names' =>[
        'index' => 'users',
        'destroy' => 'users-delete',
        'show' => 'users-edit',
        'update' => 'users-update',
        'store' => 'users-create',
    ]
]);

Auth::routes();





