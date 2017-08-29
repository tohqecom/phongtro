<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Illuminate\Support\Facades\Auth;

use Image;

use DB;

use App\UserLog;

use Illuminate\Support\Facades\Mail;

use App\PasswordReset;

use App\Payment;

class UserController extends Controller
{

    // password reset
   public function postPasswordReset(Request $request)
   {
        $this->validate($request,[
            'id' => 'required',
            'password' => 'required|confirmed|min:6|max:64',
            'password_confirmation' => 'required'
            ]);

        $id = $request['id'];
        $password = $request['password'];

        $r = PasswordReset::find($id);

        if($r->status == 1) {
            if($r->expiration <= strtotime(date('Y-m-d h:i:s')) + 3600) {

                // reset password here
                $user = User::where('email', $r->email)->first();

                $user->password = bcrypt($password);

                $user->save();

                // update password reset record to invalid
                $r->status = 0;
                $r->save();


                return redirect()->route('home')->with('message', 'Successfully Reset Password!');


            }
            else {
                // expired link
                return redirect()->route('invalid_link')->with('error_msg', 'Expired Reset Link!');
            }
        }
        else {
            //invalid link
            return redirect()->route('invalid_link')->with('error_msg', 'Invalid Reset Link!');
        }
        // Something wrong
        return redirect()->route('invalid_link')->with('error_msg', 'Something Gone Wrong. Please Repeat Process of Resetting Password.');

   }

    // validate the link of the reset password 
    public function resetPassworkLink()
    {
        $token = $_GET['t'];
        $email = $_GET['e'];

        $r = PasswordReset::where('token', $token)->where('email', $email)->first();

        if($r->status == 1) {
            if($r->expiration <= strtotime(date('Y-m-d h:i:s')) + 3600) {

                // return "Reset Password View";
                return view('pages.passwordreset', ['id' => $r->id]);

            }
            else {
                // expired link
                return redirect()->route('invalid_link')->with('error_msg', 'Expired Reset Link!');
            }
        }
        else {
            //invalid link
            return redirect()->route('invalid_link')->with('error_msg', 'Invalid Reset Link!');
        }

        // Something wrong
        return redirect()->route('invalid_link')->with('error_msg', 'Something Gone Wrong. Please Repeat Process of Resetting Password.');

    }

    /*
    |--------------------------------------------------------------------------
    | Method use to send link reset user password
    |-------------------------------------------------------------------------- 
    */
    public function passwordReset(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email'
            ]);

        $email = $request['email'];

        $user = User::where('email', '=', $email)->first();

        if(!empty($user)) {
            // end recovery link to email
            $owner_email = $user->email;
            $token = csrf_token();
            $expiration = strtotime(date('Y-m-d h:i:s')) + 3600;

            $data['link'] = url('/') . '/reset/' . '?t=' . $token . '&e=' . $user->email;

            Mail::send('pages.client.resetpassword', $data, function ($message) use ($owner_email) {
                $message->from('reset-password@rental-domain.cf', 'Password Reset');
                $message->to($owner_email)->subject('Reset Your Account Password');
            });

            $rr = new PasswordReset();
            $rr->email = $owner_email;
            $rr->token = $token;
            $rr->expiration = $expiration;

            $rr->save();

            return redirect()->route('forgot_password')->with('message', 'Reset Link Sent to Email! Valid Only For 1 Hour');
        }

        return redirect()->route('forgot_password')->with('error_msg', 'Email Address Not Found!');
    }

    /*
    |--------------------------------------------------------------------------
    | Method use to show user log
    |-------------------------------------------------------------------------- 
    */
    public function userLog()
    {
        $logs = UserLog::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(10);

        return view('pages.client.log',['logs' => $logs]);
    }


    /*
    |--------------------------------------------------------------------------
    | Method use to show user profile
    |-------------------------------------------------------------------------- 
    */
    public function showUserProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('pages.client.showuserprofile', $user);
    }


    /*
    |--------------------------------------------------------------------------
    | Route to Client Profile
    |--------------------------------------------------------------------------
    */
    public function userProfile($id = null)
    {
        $user = User::find($id);
        return view('pages.client.showuserprofile', $user);
        
    }


    /*
    |--------------------------------------------------------------------------
    | This method is use to show members of app
    |--------------------------------------------------------------------------
    */
    public function showMembers()
    {
        $members = User::where('privelege', 'Member')->orderBy('created_at','asc')->paginate(9);

        return view('pages.admin.members', ['members' => $members]);
    }


    /*
    |--------------------------------------------------------------------------
    |This methos is to change password of client
    |--------------------------------------------------------------------------
    */
    public function passwordUpdate(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
            ]);

        //validation required
        $user_id = $request['user_id'];
        $old_password = $request['old_password'];
        $new_password = $request['password'];
        $new_password2 = $request['password_confirmation'];

        $user = User::find($user_id);

        $password_compare = password_verify($old_password, $user->password);
        
        if($password_compare == True) {

            if($new_password == $new_password2) {
                $user->password = bcrypt($new_password);
                $user->save();

                $user_log = new UserLog();

                $user_log->action = 'Change Password';
                $user_log->user_id = Auth::user()->id;

                $user_log->save();

                return redirect()->route('changepass')->with('message','Password Change Successfully');
            }

            return redirect()->route('changepass')->with('error_msg','Password not match.');
        }

        return redirect()->route('changepass')->with('error_msg', 'Wrong Password.');
       
    }

    /*
    |--------------------------------------------------------------------------
    |This methos is use to update profile of the client
    |--------------------------------------------------------------------------
    */
    public function updateUserProfile(Request $request)
    {
        
        $this->validate($request, [
            'email' => 'required|email',
            'firstname' => "required|regex:/^[\p{L} . '-]+$/u",
            'lastname' => 'required',
            'bday' => 'required|after:date',
            'mobile' => 'required | max:11',
            'gender' => 'required',
            'user_id' => 'required'
            ]);

        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $mobile = $request['mobile'];
        $birthday = $request['bday'];
        $gender = $request['gender'];
        $user_id = $request['user_id'];

        // the current filename/profile name of the user
        $filename = Auth::user()->profile;

        if($request->hasFile('profileimg')) {
            $profile = $request->file('profileimg');
            $filename = time() . '.' . $profile->getClientOriginalExtension();
            Image::make($profile)->resize(300, 300)->save(public_path('/uploads/profiles/' . $filename));

        }
        // else {
        //     $filename = Auth::user()->profile;
        // }

        $update = User::find($user_id);

        $update->firstname = $firstname;
        $update->lastname = $lastname;
        $update->email = $email;
        $update->mobile = $mobile;
        $update->birthday = $birthday;
        $update->gender = $gender;
        $update->profile = $filename;

        $update->save();

        $user_log = new UserLog();

        $user_log->action = 'Updated User Profile';
        $user_log->user_id = $user_id;

        $user_log->save();

        return redirect()->route('profile')->with('message', 'Profile Successfully Updated!');
    }

    /*
	|--------------------------------------------------------------------------
	| This method is use the user to create account in the application
	|--------------------------------------------------------------------------
	*/
    public function userSignup(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email|unique:users',
    		'firstname' => "required|regex:/^[\p{L} . '-]+$/u",
    		'lastname' => 'required',
    		'bday' => 'required|after:date',
    		'gender' => 'required',
    		'mobile' => 'required | max:11',
            'user_type' => 'required',
    		'password' => 'required|confirmed|min:6|max:64',
    		'password_confirmation' => 'required|min:6|max:64'
    		]);

    	$email = $request['email'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$bday = $request['bday'];
    	$gender = $request['gender'];
    	$mobile = $request['mobile'];
        $user_type = $request['user_type'];
    	$password = $request['password'];
    	$password2 = $request['password2'];

        if($user_type == 'Member') {
            $status = 'Inactive';
        }
        elseif ($user_type == 'Border') {
            $status = 'Not Applicable';
        }
        else {
            return 'Something Wrong. Got to Home';
        }

    	$user = new User();

    	$user->email = $email;
    	$user->firstname = $firstname;
    	$user->lastname = $lastname;
    	$user->gender = $gender;
    	$user->birthday = $bday;
    	$user->mobile = $mobile;
        $user->privelege = $user_type;
        $user->status = $status;
    	$user->password = bcrypt($password);

    	if($user->save()) {
            return redirect()->route('home')->with('message', 'Successfully Signed Up!');    
        }

        return redirect()->route('home')->with('error_msg', 'Errors!')->withInput(); 
    	

    }

    /*
	|--------------------------------------------------------------------------
	| This method is use to Signin a registered/authentiated user
	|--------------------------------------------------------------------------
	*/
    public function userSignin(Request $request)
    {
    	$remember = $request['remember'];

    	if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $remember)) {
                
            $user_log = new UserLog();

            if(Auth::user()->privelege == 'Admin') {

                $user_log->user_id = Auth::user()->id;
                $user_log->action = 'Login';

                $user_log->save();

                return redirect()->route('admin_home');
            }
            else {

                $user_log->user_id = Auth::user()->id;
                $user_log->action = 'Login';

                $user_log->save();

        		return redirect()->route('home_user');
            }
    	}
    	return redirect()->route('home')->with('error_msg','Incorrect Email or Password!')->withInput();
    }

    /*
	|--------------------------------------------------------------------------
	| This method is use to logout any signedin user
	|--------------------------------------------------------------------------
	*/
    public function getLogout(Request $request)
    {

        $user_log = new UserLog();

        $user_log->user_id = Auth::user()->id;
        $user_log->action = 'Logout';

        $user_log->save();

        Auth::logout();

    	return redirect()->route('home');
    }


}
