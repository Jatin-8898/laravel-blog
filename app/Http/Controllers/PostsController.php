<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;           /* To bring the model named Post */
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* We want to display the login page if not logged in bt except these pages */
        $this->middleware('auth' ,['except' => 
                [
                    'index', 
                    'show',
                ]
        ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts =  Post::all();                                    //This is for fetching everything
        //return  Post::where('title', 'Post Two')->get();          //Find by specific title     
        //$posts = DB::select('SELECT * FROM posts');               //SQL QUERY
        //$posts =  Post::orderBy('title', 'desc')->take(1)->get(); //LIMIT QUERY BY 1     
        //$posts =  Post::orderBy('title', 'desc')->get();            //Order by title desc     

        $posts =  Post::orderBy('created_at', 'desc')->paginate(10);  //After 10 posts pagination comes
        return view('posts.index')->with('posts', $posts);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;      //Since this is from the auth
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);                        //This will find the post with the passed id
        return view('posts.show')->with('post', $post);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        /* Check for the correct user */
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        //Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

         /* Check for the correct user */
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
