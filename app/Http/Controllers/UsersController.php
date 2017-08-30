<?php

namespace App\Http\Controllers;

use App\Http\Middleware\BeforeCheckAdmin;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class UsersController extends Controller
{
    //todo admincheck middleware
    public function __construct()
    {
        $this->middleware(BeforeCheckAdmin::class);
    }
    public function index(){
        $users = \DB::table('users')->get();
        return view('/users/index',['users' => $users]);
    }



    public function store(StoreUser $request)
    {
        $input = Input::all();
        if (empty($input['admin'])){
            $admin = 0;
        }
        else{
            $admin = 1;
        }

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'admin' => $admin,
        ]);

        return redirect()->action('CarController@index');
    }

    public function show($id){
        if(!is_numeric($id)){
            return redirect('/errors/404');
        }
        $user = \DB::table('users')->where('id','=', $id)->first();
        if(is_null($user))
            return redirect('/users');
        return view('/users/edit',['user' =>$user]);
    }

    public function destroy($id){
        \DB::table('users')->where('id','=', $id)->delete();

        return redirect()->action('UsersController@index');
    }
    public function update(UpdateUser $request,$id){
        $input = Input::all();

        if($input['password'] == ''){
            \DB::table('users')
                ->where('id', '=',$id)
                ->update([
                    'name' => $input['name'],
                    'email' => $input['email'],
                ]);
        }
        else{
            \DB::table('users')
                ->where('id', '=',$id)
                ->update([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => bcrypt($input['password']),
                ]);
        }


        return redirect()->action('UsersController@index');
    }
}
