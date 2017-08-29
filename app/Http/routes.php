<?php

/*
|--------------------------------------------------------------------------
| Application Routes:: Room and Appartment Rental
|--------------------------------------------------------------------------
|
| Note: Client is an authenticated user of the application
|
*/
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Route to Home Page of the application
|--------------------------------------------------------------------------
*/

// Route::get('email', function () {
// 	dd(Config::get('mail'));
// });

Route::get('/', function () {
	$data = array(
		'homeactive' => 'active',
		'aboutactive' => '',
		'signinactive' => '',
		'signupactive' => ''
		);

	if(Auth::check()) {

		if(Auth::user()->privelege == 'Admin') {
			return redirect()->route('admin_home');
		}
		return redirect()->route('home_user');
	}

    return view('pages.home', $data);
})->name('home');

/*
|--------------------------------------------------------------------------
| Route to search by guests
|--------------------------------------------------------------------------
*/
Route::post('search', [
	'uses' => 'PostController@guestSearch',
	'as' => 'guest-search'
	]);

Route::get('search', function() {
	return redirect()->route('home');
})->name('getsearchresult');

/*
|--------------------------------------------------------------------------
| Route to show search result on guest
|--------------------------------------------------------------------------
*/
Route::get('post-guest/{id}', [
	'uses' => 'PostController@showGuestResult',
	'as' => 'post-guest'
	]);

/*
|--------------------------------------------------------------------------
| Route to About Page of the application
|--------------------------------------------------------------------------
*/
Route::get('about', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => 'active',
		'signinactive' => '',
		'signupactive' => ''
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.about2',$data);
})->name('about');

/*
|--------------------------------------------------------------------------
| Route to Signin Page of the application
|--------------------------------------------------------------------------
*/
Route::get('member_signup', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => '',
		'signinactive' => '',
		'signupactive' => 'active'
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.signup',$data);
})->name('signup');

/*
|--------------------------------------------------------------------------
| Singup Route using the UserController@userSignup method
|--------------------------------------------------------------------------
*/
Route::post('user_signup', [
		'uses' => 'UserController@userSignup',
		'as' => 'user_signup'
	]);

Route::get('user_signup', function () {
	return redirect()->route('home');
});

/*
|--------------------------------------------------------------------------
| Signin Route using the UserController@userSignin method
|--------------------------------------------------------------------------
*/
Route::post('user_signin', [
		'uses' => 'UserController@userSignin',
		'as' => 'user_signin'
	]);

Route::get('user_signin', function () {
	return redirect()->route('home');
});


/*
|--------------------------------------------------------------------------
| Route to Signin Page of the application
|--------------------------------------------------------------------------
*/
Route::get('member_signin', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => '',
		'signinactive' => 'active',
		'signupactive' => ''
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.signin',$data);
})->name('signin');

/*
|--------------------------------------------------------------------------
| Route use to send reset password of a user in email
|--------------------------------------------------------------------------
*/
Route::get('forgot-password', function () {
	return view('pages.forgot_password');
})->name('forgot_password');

Route::post('forgot-password', [
	'uses' => 'UserController@passwordReset',
	'as' => 'reset_password'
	]);

/*
|--------------------------------------------------------------------------
| Route to reset password link
|--------------------------------------------------------------------------
*/
Route::get('reset', [
	'uses' => 'UserController@resetPassworkLink'
	]);


/*
|--------------------------------------------------------------------------
| Route to change the password
|--------------------------------------------------------------------------
*/

Route::post('password-reset', [
	'uses' => 'UserController@postPasswordReset',
	'as' => 'password_reset'

	]);

Route::get('password-reset', function () {
	return redirect()->route('forgot_password');
});


/*
|--------------------------------------------------------------------------
| Route use to invalid link
|--------------------------------------------------------------------------
*/
Route::get('invalid-link', function () {
	return view('pages.invalid_link');
})->name('invalid_link');



/*
|--------------------------------------------------------------------------
| Logout route
|--------------------------------------------------------------------------
*/
Route::get('logout', [
	'uses' => 'UserController@getLogout',
	'as' => 'logout'
]);

/*
|--------------------------------------------------------------------------
| Route Group: prefix => user
| This Route Group is protected route: 'middleware' => 'auth'
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Route to Client Home Page, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('/', function () {
		return view('pages.client.home');
	})->name('home_user');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Search Result, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('search', function () {
		return view('pages.client.search');
	})->name('search');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Posts, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('posts', ['uses' => 'PostController@index'], function () {
       if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }
		return view('pages.client.posts');
	})->name('myposts');

	/*
	|--------------------------------------------------------------------------
	| This route is use to see or view specific post of user/client viewing it
	|--------------------------------------------------------------------------
	*/
	Route::get('post/{id}',[
		'uses' => 'PostController@postView',
		'as' => 'post'
		]);


	/*
	|--------------------------------------------------------------------------
	| Route use to add post by the client
	|--------------------------------------------------------------------------
	*/
	Route::post('postaddpost', [
		'uses' => 'PostController@postAddPost',
		'as' => 'postaddpost'
		]);

	Route::get('postaddpost', function () {
        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }
		return redirect()->route('addpost');
	});

	/*
	|--------------------------------------------------------------------------
	| Route to Client Add Posts view, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('addpost', function () {
        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }
		return view('pages.client.addpost');
	})->name('addpost');

	/*
	|--------------------------------------------------------------------------
	| Route to Client About, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('about', function () {
		return view('pages.client.about');
	})->name('client_about');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Browse Posts, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('browse', ['uses' => 'PostController@browsePosts'], function () {
		return view('pages.client.browse');
	})->name('browse');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Profile
	|--------------------------------------------------------------------------
	*/
	Route::get('profile', function () {
		return view('pages.client.profile');
	})->name('profile');


	/*
	|--------------------------------------------------------------------------
	| Route to User Profile
	|--------------------------------------------------------------------------
	*/
	Route::get('user-profile/{id}', [
		'uses' => 'UserController@userProfile',
		'as' => 'show_profile'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to delete post by the current user
	|--------------------------------------------------------------------------
	*/
	Route::get('delete-post/{id}', [
		'uses' => 'PostController@deletePost',
		'as' => 'delete-post'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to edit form
	|--------------------------------------------------------------------------
	*/
	Route::get('edit-post/{id}', [
		'uses' => 'PostController@editPost',
		'as' => 'edit-post'
		]);

	/*
	|--------------------------------------------------------------------------
	| Rout to form edti to edit requested post by the user/client
	|--------------------------------------------------------------------------
	*/
	Route::get('edit-post-form', function () {
		return view('pages.client.postformedit');
	})->name('edit-post-form');


	/*
	|--------------------------------------------------------------------------
	| Route to update post
	|--------------------------------------------------------------------------
	*/
	Route::post('postupdatepost', [
		'uses' => 'PostController@postupdatepost',
		'as' => 'postupdatepost'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route to go to delete multiple page
	|--------------------------------------------------------------------------
	*/
	Route::get('delete-post', [
		'uses' => 'PostController@showPostToDelete',
		'as' => 'showposttodelete'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route used in deleting multiple posts
	|--------------------------------------------------------------------------
	*/
	Route::post('delete-multiple-post', [
		'uses' => 'PostController@postDeleteMultiplePost',
		'as' => 'delete_multiple_post'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route used to show search result of the client
	|--------------------------------------------------------------------------
	*/
	Route::post('result',[
		'uses' => 'PostController@searchResult',
		'as' => 'searchresult'
		]);

	Route::get('result', function () {
		return redirect()->route('search');
	});

	Route::post('results', [
		'uses' => 'PostController@searchResultHome',
		'as' => 'searchresult_home'
		]);


	/*
	|--------------------------------------------------------------------------
	| Route use to go to edit profile form
	|--------------------------------------------------------------------------
	*/
	Route::get('profile-edit', function () {
		return view('pages.client.profile-edit');
	})->name('profile-edit');

	/*
	|--------------------------------------------------------------------------
	| Route use to update user profile
	|--------------------------------------------------------------------------
	*/
	Route::post('profile-update', [
		'uses' => 'UserController@updateUserProfile',
		'as' => 'profile_update'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to go to password change form
	|--------------------------------------------------------------------------
	*/
	Route::get('changepass', function () {
		return view('pages.client.changepass');
	})->name('changepass');

	/*
	|--------------------------------------------------------------------------
	| Route use update password
	|--------------------------------------------------------------------------
	*/
	Route::post('updatepass', [
		'uses' => 'UserController@passwordUpdate',
		'as' => 'updatepass'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to upload/update user image
	|--------------------------------------------------------------------------
	*/
	Route::post('profile-img',[
		'uses' => 'UserController@profileImage',
		'as' => 'profile-image'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to edit/update post of user 
	|--------------------------------------------------------------------------	
	*/
	Route::get('post-user-profile/{id}', [
		'uses' => 'UserController@showUserProfile',
		'as' => 'post-user-profile'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to send message to seller/inquiry message/notify owner of post 
	|--------------------------------------------------------------------------	
	*/
	Route::post('send-msg-post-owner', [
		'uses' => 'GeneralController@sendMsgToOwner',
		'as' => 'send_msg_post_owner'
		]);


	/*
	|--------------------------------------------------------------------------
	| Route use to go to users log 
	|--------------------------------------------------------------------------	
	*/
	Route::get('logs', [
		'uses' => 'UserController@userLog',
		'as' => 'user_log'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to update post and make it available
	|--------------------------------------------------------------------------	
	*/
	Route::post('make-available', [
		'uses' => 'PostController@makeAvailable',
		'as' => 'make_available'
		]);

	Route::get('make-available', function () {
		return redirect()->route('myposts');
	});

	/*
	|--------------------------------------------------------------------------
	| Route use to update post and make it reserved
	|--------------------------------------------------------------------------	
	*/
	Route::post('make-reserved', [
		'uses' => 'PostController@makeReserved',
		'as' => 'make_reserved'
		]);

	Route::get('make-reserved', function () {
		return redirect()->route('myposts');
	});

	/*
	|--------------------------------------------------------------------------
	| Route use to update post and make it occupied
	|--------------------------------------------------------------------------	
	*/
	Route::post('make-occupied', [
		'uses' => 'PostController@makeOccupied',
		'as' => 'make_occupied'
		]);

	Route::get('make-occupied', function () {
		return redirect()->route('myposts');
	});

	/*
	|--------------------------------------------------------------------------
	| Route use to go to inbox
	|--------------------------------------------------------------------------	
	*/
	Route::get('messages/inbox', [
		'uses' => 'GeneralController@inbox',
		'as' => 'inbox'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to read message in inbox
	|--------------------------------------------------------------------------	
	*/
	Route::post('message/inbox/read', [
		'uses' => 'GeneralController@readInboxMsg',
		'as' => 'read_msg'
		]);

	Route::get('message/inbox/read', function () {
		return redirect()->route('inbox');
	});


	/*
	|--------------------------------------------------------------------------
	| Route use to delete message
	|--------------------------------------------------------------------------	
	*/
	Route::post('message/inbox/delete', [
		'uses' => 'GeneralController@msgDelete',
		'as' => 'delete_msg'
		]);

	Route::get('message/delete', function () {
		return redirect()->route('inbox');
	});


	/*
	|--------------------------------------------------------------------------
	| Route use to show sent items
	|--------------------------------------------------------------------------	
	*/
	Route::get('message/sent', [
		'uses' => 'GeneralController@sentMessage',
		'as' => 'sent_msg'
		]);


	/*
	|--------------------------------------------------------------------------
	| Route use to view sent item
	|--------------------------------------------------------------------------	
	*/
	Route::post('message/read/sent', [
		'uses' => 'GeneralController@viewSentMessage',
		'as' => 'read_sent'
		]);

	Route::get('message/read/sent', function () {
		return redirect()->route('sent_msg');
	});


	/*
	|--------------------------------------------------------------------------
	| Route use to delete sent items
	|--------------------------------------------------------------------------	
	*/
	Route::post('message/sent/delete', [
		'uses' => 'GeneralController@deleteSentMsg',
		'as' => 'delete_sent'
		]);

	Route::get('message/delete', function () {
		return redirect()->route('sent_msg');
	});

	/*
	|--------------------------------------------------------------------------
	| Route use to activation payment method
	|--------------------------------------------------------------------------	
	*/
	Route::get('activate-member-account', [
		'uses' => 'GeneralController@selectActivation',
		'as' => 'select_payment'
		]);


	Route::post('activate-member-account', [
		'uses' => 'GeneralController@paymentMethod',
		'as' => 'payment_method'
		]);

});
/*
|--------------------------------------------------------------------------
| Group Route admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | This route is admin home route
    |--------------------------------------------------------------------------
    */
    // this is the original style in calling the home/root directory
	Route::get('/home', function () {
		return view('pages.admin.home');
	})->name('admin_home');

	Route::get('/', [
		'uses' => 'PostController@pendingPosts',
		'middleware' => 'App\Http\Middleware\AdminMiddleware'
		]);

    /*
    |--------------------------------------------------------------------------
    | Route to show all pending posts by users
    |--------------------------------------------------------------------------
    */
	Route::get('pending-posts', [
		'uses' => 'PostController@pendingPosts',
		'as' => 'pending-posts'
		]);
    /*
    |--------------------------------------------------------------------------
    | Route get to approve posts by admin
    |--------------------------------------------------------------------------
    */
	Route::get('aprove-post/{id}', [
		'uses' => 'PostController@aprovePendingPost',
		'as' => 'aprove-post'
		]);
    /*
    |--------------------------------------------------------------------------
    | Route get to delete unwanted posts by admin
    |--------------------------------------------------------------------------
    */
	Route::get('delete-pending-post/{id}', [
		'uses' => 'PostController@deletePendingPost',
		'as' => 'delete-pending-post'
		]);

	/*
    |--------------------------------------------------------------------------
    | Route to show all members of the app
    |--------------------------------------------------------------------------
    */
    Route::get('members', [
    	'uses' => 'UserController@showMembers',
    	'as' => 'members'
    	]);

	/*
    |--------------------------------------------------------------------------
    | Route to show all active posts in admin
    |--------------------------------------------------------------------------
    */
    Route::get('active-posts', [
    	'uses' => 'PostController@showActivePosts',
    	'as' => 'active-posts'
    	]);

	/*
    |--------------------------------------------------------------------------
    | Route to show admin profile
    |--------------------------------------------------------------------------
    */
    Route::get('admin-profile', [
    	'uses' => 'AdminController@showAdminProfile',
    	'as' => 'admin_profile'
    	]);
	/*
    |--------------------------------------------------------------------------
    | Route to show change password in admin
    |--------------------------------------------------------------------------
    */
    Route::get('change-admin-password', function() {
    	return view('pages.admin.change_admin_password');
    })->name('change_admin_password');


	/*
    |--------------------------------------------------------------------------
    | Route to edit profile of admin
    |--------------------------------------------------------------------------
    */
    Route::get('admin-profile-edit', [
    	'uses' => 'AdminController@ProfileEdit',
    	'as' => 'admin_profile_edit'
    	]);

	/*
    |--------------------------------------------------------------------------
    | Route to update admin profile
    |--------------------------------------------------------------------------
    */    
    Route::post('admin-profile-update', [
    	'uses' => 'AdminController@ProfileUpdate',
    	'as' => 'admin_profile_update'
    	]);
    /*
    |--------------------------------------------------------------------------
    | Route to update the password of the admin
    |--------------------------------------------------------------------------
    */
    Route::post('admin-password-update', [
    	'uses' => 'AdminController@PasswordUpdate',
    	'as' => 'update_admin_password'
    	]);

    /*
    |--------------------------------------------------------------------------
    | Route to go to log of admin
    |--------------------------------------------------------------------------
    */
    Route::get('log', [
    	'uses' => 'AdminController@adminLog',
    	'as' => 'admin_log'
    	]);

    /*
    |--------------------------------------------------------------------------
    | Route to search and activate members
    |--------------------------------------------------------------------------
    */
    Route::get('activate-member', function () {
    	return view('pages.admin.activate');
    })->name('activate_member');

    Route::get('search-member', function () {
    	return view('pages.admin.activate');
    });
    Route::post('search-member', [
    	'uses' => 'GeneralController@searchMember',
    	'as' => 'search_member'
    	]);

    Route::post('activate-member', [
    	'uses' => 'GeneralController@postActivateMember',
    	'as' => 'post_activate_member'
    	]);


});




/*
|--------------------------------------------------------------------------
| Route to Show Errors
|--------------------------------------------------------------------------
*/
Route::get('exception-error', function () {
	return view('pages.exceptionerror');
})->name('showerrors');