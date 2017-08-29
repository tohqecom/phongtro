<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use DB;

use Illuminate\Support\Facades\Auth;

use Image;

use App\PostImage;

use App\UserLog;

use App\User;


class PostController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Method use to update post to make it reserved
    |--------------------------------------------------------------------------
    */
    public function makeOccupied(Request $request)
    {
        $id = $request['post_id'];

        $post = Post::findorfail($id);
        // check ownership
        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }

        $post->availability = 'Occupied';

        $post->save();

        return redirect()->route('myposts');
    }

    /*
    |--------------------------------------------------------------------------
    | Method use to update post to make it reserved
    |--------------------------------------------------------------------------
    */
    public function makeReserved(Request $request)
    {
        $id = $request['post_id'];

        $post = Post::findorfail($id);
        // check ownership
        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }        

        $post->availability = 'Not Available';

        $post->save();

        return redirect()->route('myposts');
    }


    /*
    |--------------------------------------------------------------------------
    | Method use to update post to make it available
    |--------------------------------------------------------------------------
    */
    public function makeAvailable(Request $request)
    {
        $id = $request['post_id'];

        $post = Post::findorfail($id);

        // check ownership
        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }

        $post->availability = 'Available';

        $post->save();

        return redirect()->route('myposts');
    }


    /*
    |--------------------------------------------------------------------------
    | Method use to show link in search result on guest
    |--------------------------------------------------------------------------
    */
    public function showGuestResult($id = null)
    {
        $post = Post::findorfail($id);

        return view('pages.post', ['post' => $post]);
    }

    /*
    |--------------------------------------------------------------------------
    | Method use to show active posts in admin
    |--------------------------------------------------------------------------
    */
    public function showActivePosts()
    {
        $posts = Post::where('status', 'Active')->orderby('updated_at','desc')->paginate(4);

        return view('pages.admin.active_posts', ['posts' => $posts]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method is delete pending posts by admin
    |--------------------------------------------------------------------------
    */
    public function deletePendingPost($id = null)
    {
        $delete = DB::table('posts')->delete($id);

        if($delete) {

            $user_log = new UserLog();

            $user_log->action = 'Delete Pending Post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('pending-posts')->with('message', 'Post Successfully Deleted!');
        }

        return redirect()->route('pending-posts')->with('error_msg', 'Can\'t Delete Post!');
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to aprove pending posts by admin
    |--------------------------------------------------------------------------
    */
    public function aprovePendingPost($id = null)
    {
        $post = Post::findorfail($id);

        $post->status = 'Active';

        if($post->save()) {

            $user_log = new UserLog();

            $user_log->action = 'Approve a post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();
            
            return redirect()->route('pending-posts')->with('message','Post is Active Now!');
        }
        else {
            return redirect()->route('pending-posts')->with('error_msg','Error!');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | This method methods is by admin to show pending posts
    |--------------------------------------------------------------------------
    */
    public function showPendingPosts()
    {
        $result = Post::where('status','Inactive')
                                    ->paginate(4);

        return view('pages.admin.pending_posts',['posts' => $result]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method methods is used by guest users to search for rooms
    |--------------------------------------------------------------------------
    */
    public function guestSearch(Request $request)
    {
        $this->validate($request,[
            'keyword' => 'required| min:2'
            ]);

        

        $keyword = $request['keyword'];

        $posts = Post::where('status', '=', "Active")
                                    ->where('location', 'like', "%$keyword%")
                                    ->orwhere('type', 'like', "%$keyword%")
                                    ->orwhere('title', 'like', "%$keyword%")
                                    ->orwhere('price', 'like', "%$keyword%")
                                    ->orwhere('description', 'like', "%$keyword")
                                    ->orderby('updated_at', 'desc')
                                    ->paginate(4);

        return view('pages.results', ['posts' => $posts]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method to search by loggedin users
    |--------------------------------------------------------------------------
    */
    public function searchResult(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'max_price' => 'required',
            'location' => 'required'
            ]);

        $type = $request['type'];
        $max_price = $request['max_price'];
        $location = $request['location'];

        $results = Post::where('type', $type)
                        ->where('status', 'Active')
                        ->where('price', '<=',  $max_price)
                        ->where('location', 'like', "%$location%")
                        ->orderby('updated_at','desc')
                        ->paginate(4);

        return view('pages.client.result', ['posts' => $results]);

    }

        public function searchResultHome(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|min:2'
            ]);

        $keyword = $request['keyword'];

        $results = Post::where('type', 'like', "%$keyword%")
                        ->orWhere('location', 'like', "%$keyword%")
                        ->orderby('updated_at','desc')
                        ->paginate(4);

        return view('pages.client.result', ['posts' => $results]);

    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to delete multiple selected posts ids
    |--------------------------------------------------------------------------
    */
    public function postDeleteMultiplePost(Request $request)
    {

        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }
        
        $ids = $request->input('postid');

        if(DB::table('posts')->whereIn('id',$ids)->delete()) {

            $user_log = new UserLog();

            $user_log->action = 'Delete posts.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('showposttodelete')->with('message', 'Posts Successfully Delete!');
        }

        return redirect()->route('showposttodelete')->with('error_msg', 'Error Occured. Please Try again later.');
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to show multiple post to delete
    |--------------------------------------------------------------------------
    */
    public function showPostToDelete()
    {

        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }

        $posts = Post::where('user_id', '=',Auth::user()->id)->paginate(10);

        return view('pages.client.showdelete',['posts' => $posts]);


    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to update the editted content of a post
    |--------------------------------------------------------------------------
    */
    public function postUpdatePost(Request $request)
    {

        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }

        $this->validate($request, [
            'title' => 'required|min:6|max:150',
            'price' => 'required',
            'description' => 'required|min:25',
            'location' => 'required',
            // upload multiple images for the room/appartment
            'images' => 'max:10240'
            ]); 
            
        $id = $request['post_id'];
        $title = $request['title'];
        $price = $request['price'];
        $description = $request['description'];
        $location = $request['location'];
        $images = $request['images'];

        $post = Post::findorfail($id);

        // check ownership
        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }

        $post->title = $title;
        $post->price = $price;
        $post->description = $description;
        $post->location = $location;

        if($post->save()) {

            if(!empty($images)) {
                $post_img_insert = array();

                foreach ($images as $image) {
                    $img = time() . "__n." . $image->getClientOriginalExtension();
                    Image::make($image)->resize(800, 500)->save(public_path('/uploads/posts/' . $img));

                    $post_img_insert[] = array('name' => $img, 'post_id' => $post->id);

                }

                $delete_post_img = PostImage::where('post_id', $post->id);

                $delete_post_img->delete();
            }

            PostImage::insert($post_img_insert);

            $user_log = new UserLog();

            $user_log->action = 'Updated post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('myposts')->with('message', 'Successfully Updated!');

        }

        return redirect()->route('myposts')->with('error_msg', 'Error Occured. Please try again later.');
    }


    /*
    |--------------------------------------------------------------------------
    | This method is use to edit post of the client/user
    |--------------------------------------------------------------------------
    */
    public function editPost($id = null)
    {

        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }

        // check ownership
        $post = Post::findorfail($id);

        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }

        $post = DB::table('posts')->where('id', $id)->first();

        if(!empty($post)) {
            $post_data['id'] = $post->id;
            $post_data['title'] = $post->title;
            $post_data['price'] = $post->price;
            $post_data['description'] = $post->description;
            $post_data['location'] = $post->location;

            return view('pages.client.postformedit', $post_data);
        }
        return redirect()->route('mypost')->with('error_msg', 'Error Occured. Please Try again later.');
    }

    /*
    |--------------------------------------------------------------------------------
    | This method is used by the user to delete single post
    | This is on the route('myposts') by the client
    |--------------------------------------------------------------------------------
    */
    public function deletePost($id = null)
    {
        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }

        // check ownership
        $post = Post::findorfail($id);

        if($post->user_id != Auth::user()->id) {
            return 'Error Occured. Try reloading this page.';
        }

        $delete = DB::table('posts')->delete($id);

        if($delete) {

            $user_log = new UserLog();

            $user_log->action = 'Deleted a post';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('myposts')->with('message', 'Post Successfully Deleted!');
        }

        return redirect()->route('myposts')->with('error_msg', 'Can\'t Delete Post!');
    }


    /*
    |--------------------------------------------------------------------------------
    | This is index method used by client to view their posts and the status of their post
    |--------------------------------------------------------------------------------
    */
	public function index()
    {
    	$id = Auth::user()->id;
        $posts = Post::where('user_id', $id)->paginate(4);

        return view('pages.client.posts', ['posts' => $posts]);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to view the specific post
    |--------------------------------------------------------------------------------
    */
    public function postView($id = null)
    {
        if($id == '') {
            return redirect()->back();
        }

    	$post = Post::findorfail($id);

        return view('pages.client.post', ['post' => $post]);

    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to browse all the posts in the database to view by the client
    |--------------------------------------------------------------------------------
    */
	public function browsePosts()
    {
        $posts = Post::where('status','Active')
                ->where('user_id', '!=', Auth::user()->id)
                ->orderby('updated_at','desc')
                ->paginate(4);
        return view('pages.client.browse', ['posts' => $posts]);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to add post by authenticated client/user
    |--------------------------------------------------------------------------------
    */
    public function postAddPost(Request $request)
    {
        if(Auth::user()->status == 'Inactive') {
            return view('pages.inactive_user');
        }


    	$this->validate($request, [
            'type' => 'required',
    		'title' => 'required|min:6|max:150',
    		'price' => 'required',
    		'description' => 'required|min:25',
    		'location' => 'required',
    		// upload multiple images for the room/appartment
            'images' => 'max:10240'
    		]);

        $type = $request['type'];
    	$title = $request['title'];
    	$price = $request['price'];
    	$description = $request['description'];
    	$location = $request['location'];
    	$user_id = $request['user_id'];


        $images = $request->file('images');
        // $img = [];

        $post = new Post();

        $post->title = $title;
        $post->price = $price;
        $post->description = $description;
        $post->location = $location;
        $post->user_id = $user_id;
        $post->type = $type;

        $post->save();


        $post_img_insert = array();

        foreach ($images as $image) {
            $img = time() . "__n." . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 500)->save(public_path('/uploads/posts/' . $img));


            $post_img_insert[] = array('name' => $img, 'post_id' => $post->id);

        }

        PostImage::insert($post_img_insert);

        $user_log = new UserLog();

        $user_log->action = 'New Post';
        $user_log->user_id = Auth::user()->id;

        $user_log->save();

    	return redirect()->route('addpost')->with('message', 'Post Successfully Saved!');
    }


    public function pendingPosts()
    {
        $posts = Post::where('status', 'Inactive')->orderby('updated_at','desc')->paginate(4);
        return view('pages.admin.pending_posts', ['posts' => $posts]);
    }


}
