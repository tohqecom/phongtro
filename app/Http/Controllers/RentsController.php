<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use DateTime;
class RentsController extends Controller
{
    //
    public function index($id){

        $rents = \DB::table('cars')->where('user_id', '=',$id)
            ->join('rents','cars.id','=','rents.car_id')
            ->select('cars.*','rents.date_start','rents.date_end','rents.paid', 'rents.old')
            ->get();

        foreach($rents as $rent){
            $rent->cost = $this->calculateCost($rent->date_start,$rent->date_end, $rent->cost);
        }
        return view('/rents/index',['rents'=> $rents] );
    }
    public function addRent($car_id,$user_id){
        $input = \Illuminate\Support\Facades\Input::all();

        Rent::create([
            'user_id' => $user_id,
            'car_id' => $car_id,
            'date_start' => $input['date-start'],
            'date_end' => $input['date-end'],
            'paid' => false,
            'old' =>false,
        ]);

        \DB::table('cars')->where('id','=', $car_id)->update([
            'available' => false,
        ]);
        return redirect()->route('/rents', ['id' => $user_id]);

    }
    private function calculateCost($date_start, $date_end, $cost){
        $diff=round(abs(strtotime($date_start)-strtotime($date_end))/86400);


        return $diff * $cost;
    }
}
