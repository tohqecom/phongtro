<?php

namespace App\Http\Controllers;

use App\CarDetails;
use App\Http\Requests\StoreCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Car;
use App\Http\Middleware\BeforeCheckAdmin;

class CarController extends Controller
{

    public function __construct()
    {
        $this->middleware(BeforeCheckAdmin::class);
    }
    //
    public function store(StoreCar $request)
    {



        //todo input validation
        $input = Input::all();
        $car = Car::create([
            'brand' => $input['brand'],
            'model' => $input['model'],
            'productionYear' => $input['production-year'],
            'cost' => $input['cost'],
            'available' => true,
        ]);
        CarDetails::create([
            'car_id' => $car->id,
            'gearbox' => $input['gearbox'],
            'fuel_consumption' => (float)$input['fuel-consumption'],
            'engine_capacity' => $input['engine-capacity'],
            'engine_power' => $input['engine-power'],
            'fuel' => $input['fuel'],
            'seats' => $input['seats'],
        ]);

        return redirect()->action('CarController@index');
    }
    public function index(){

        $cars = \DB::table('cars')
                            ->where('available','=',true)
                            ->get();

        $rented_cars = \DB::table('cars')
                                ->join('rents','cars.id','=','rents.car_id')
                                ->select('cars.*','rents.date_end')
                                ->where('rents.old', '=' , false)
                                ->get();

        $unavailable_cars = \DB::table('cars')
            ->where('available','=',false)
            ->leftJoin('rents',function($join)
            {
                $join->on('cars.id', '=', 'rents.car_id')
                    ->where('rents.old','=', false);
            })
            ->select('cars.*')
            ->where('rents.id','=', null)
            ->get();
        return view('/cars/index',['cars' => $cars,'rented_cars'=> $rented_cars,'unavailable_cars' => $unavailable_cars]);
    }
    public function show($id){
        if(!is_numeric($id)){
            return redirect('/errors/404');
        }

        $car = \DB::table('cars')
            ->join('car_details','cars.id','=','car_details.car_id')
            ->select('cars.*','car_details.*')
            ->where('cars.id','=',$id)
            ->first();
        if(is_null($car))
            return redirect('/cars');
        return view('/cars/edit',['car' =>$car]);
    }

    public function destroy($id){
        \DB::table('cars')->where('id','=', $id)->delete();

        return redirect()->action('CarController@index');
    }
    public function update(StoreCar $request,$id){

        $input = Input::all();

        if (empty($input['available'])){
            $available = 0;
        }
        else{
            $available = 1;

            \DB::table('rents')
                ->where('car_id','=', $id)
                ->update([
                    'old' => true,
                ]);
        }

        \DB::table('cars')
            ->where('id', '=',$id)
            ->update([
                'brand' => $input['brand'],
                'model' => $input['model'],
                'productionYear' => $input['production-year'],
                'available' => $available,
            ]);

        \DB::table('car_details')
            ->where('car_id', '=',$id)
            ->update([
                'gearbox' => $input['gearbox'],
                'fuel_consumption' => (float)$input['fuel-consumption'],
                'engine_capacity' => $input['engine-capacity'],
                'engine_power' => $input['engine-power'],
                'fuel' => $input['fuel'],
                'seats' => $input['seats'],
            ]);



        return redirect()->action('CarController@index');
    }
}
