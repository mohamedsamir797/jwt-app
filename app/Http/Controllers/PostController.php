<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use GeneralTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return $this->returnData('posts' , $posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required' ,
            'body' => 'required' ,
        ]);

        if ($validator->fails()){
           return $this->returnError('Er1',$validator->errors());
        }

        Post::create($request->all());

       return $this->returnSuccess('created successfully' , false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $this->returnData('post',$post);
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
        $validator = Validator::make($request->all(),[
            'title' => 'required' ,
            'body' => 'required' ,
        ]);

        if ($validator->fails()){
            return $this->returnError('Er1',$validator->errors());
        }

        $post = Post::find($id);

        if (!$post){
            return $this->returnError('Er1','this post is not exist');
        };

        $post->update($request->all());

        return $this->returnSuccess('updated successfully',false);
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

        if (!$post){
            return $this->returnError('Er1','this post is not exist');
        };

        $post->delete();

        return $this->returnSuccess('deleted successfully',false);

    }
}
