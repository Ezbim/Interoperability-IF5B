<?php
namespace App\Http\Controllers;

use App\Models\Lucture;
use Illuminate\Http\Request;

class LuctureController extends Controller
{
    public function index()
    {
        $posts = Lucture::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "posts",
            "results" => $posts
        ];

        return response()->json($posts,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $post = Lucture::create($input);

        return response()->json($post,200);
    }

    public function show($id)
    {
        $post = Lucture::find($id);

        if(!$post){
            abort(404);
        }

        return response()->json($post,200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $post = Lucture::find($id);

        if(!$post){
            abort(404);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post,200);
    }

    public function destroy($id)
    {
        $post = Lucture::find($id);

        if(!$post){
            abort(404);
        }

        $post->delete();

        $message = [
            "message" => "post deleted",
            "post_id" => $id
        ];

        return response()->json($message,200);
    }
}
