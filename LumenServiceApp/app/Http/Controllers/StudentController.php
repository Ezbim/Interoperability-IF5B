<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $posts = Student::Where(['id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(10);

        $response = [
            "total_count" => $posts->total(),
            "limit" => $posts->perPage(),
            "pagination" => [
                "next_page" => $posts->nextPageUrl(),
                "current_page" => $posts->currentPage()
            ],
            "data" => $posts->items(),
        ];

        return response()->json($response,200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $post = Student::create($input);

        return response()->json($post,200);
    }

    public function show($id)
    {
        $post = Student::find($id);

        if(!$post){
            abort(404);
        }

        return response()->json($post,200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $post = Student::find($id);

        if(!$post){
            abort(404);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post,200);
    }

    public function destroy($id)
    {
        $post = Student::find($id);

        if(!$post){
            abort(404);
        }

        $post->delete();

        $message = [
            "message" => "students deleted",
            "post_id" => $id
        ];

        return response()->json($message,200);
    }
}
