<?php
namespace App\Http\Controllers;

use App\Models\Human;
use Illuminate\Http\Request;

class HumanController extends Controller
{
    public function index()
    {
        $posts = Human::OrderBy("id","DESC")->paginate(10);

        $outPut = [
            "message" => "posts",
            "results" => $posts
        ];

        return response()->json($outPut,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $post = Human::create($input);

        return response()->json($post,200);
    }

    public function show($id)
    {
        $post = Human::find($id);

        if(!$post){
            abort(404);
        }

        return response()->json($post,200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $post = Human::find($id);

        if(!$post){
            abort(404);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post,200);
    }

    public function destroy($id)
    {
        $post = Human::find($id);

        if(!$post){
            abort(404);
        }

        $post->delete();

        $message = [
            "message" => "Human deleted",
            "post_id" => $id
        ];

        return response()->json($message,200);
    }


}
