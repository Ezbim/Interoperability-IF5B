<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
    $acceptHeader = $request->header('Accept');

    // validate: only application/json or application/xml are valid
    if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
        $posts = Post::Where(['user_id' => Auth::user()->id])->orderBy('id', 'desc')->paginate(10);
        $response = [
            "total_count" => $posts->total(),
            "limit" => $posts->perPage(),
            "pagination" => [
                "next_page" => $posts->nextPageUrl(),
                "current_page" => $posts->currentPage()
            ],
            "data" => $posts->items(),
        ];



        if ($acceptHeader === 'application/json') {
            // response json
            return response()->json($response, 200);
        } else {
            // create xml posts element
            $xml = new \SimpleXMLElement('<posts/>');
            foreach ($posts->items('data') as $item) {
                // create xml posts element
                $xmlItem = $xml->addChild('post');
                // convert each post field to xml format
                $xmlItem->addChild('id', $item->id);
                $xmlItem->addChild('title', $item->title);
                $xmlItem->addChild('status', $item->status);
                $xmlItem->addChild('content', $item->content);
                $xmlItem->addChild('user_id', $item->user_id);
                $xmlItem->addchild('categories_id', $item->categories_id);
                $xmlItem->addchild('students_id', $item->students_id);
                $xmlItem->addChild('created_at', $item->created_at);
                $xmlItem->addChild('updated_at', $item->updated_at);
            }
            return $xml->asXML();
        }
    } else {
        return response('Not Acceptable!', 406);
    }
}


    public function store(Request $request)
    {
        $input = $request->all();
        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|numeric',
            'categories_id' => 'required|numeric',
            'students_id' => 'required|numeric',
        ];

        $validator = Validator::make($input, $validationRules);


        $acceptHeader = $request->header('Accept');

         
        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json') {

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $post = Post::create($input);
                return response()->json($post, 200);
            }
            else if ($contentTypeHeader === 'application/xml') {
                $xml = new \SimpleXMLElement($request->getContent());
                
                if ($xml === false) {
                    return response('Invalid XML', 400);
                }
        
                $post = new Post([
                    'id' => $xml->id,
                    'title' => $xml->title,
                    'status' => $xml->status,
                    'content' => $xml->content,
                    'user_id' => $xml->user_id,
                    'categories_id' => $xml->categories_id,
                    'students_id' => $xml->students_id,
                ]);
            
                if ($post->save()) {
                    return $xml->asXML();
                } else {
                    return response('Gagal menyimpan data ke database', 500);
                }
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function show($id)
    {

        $acceptHeader = request()->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $post = Post::find($id);

            if(!$post){
                abort(404);
            }

            if($acceptHeader === 'application/json'){
                return response()->json($post,200);
            }
            else{
                $xml = new \SimpleXMLElement('<post/>');
                $xml->addChild('id',$post->id);
                $xml->addChild('title',$post->title);
                $xml->addChild('status',$post->status);
                $xml->addChild('content',$post->content);
                $xml->addChild('user_id',$post->user_id);
                $xml->addChild('categories_id',$post->categories_id);
                $xml->addChild('students_id',$post->students_id);
                $xml->addChild('created_at',$post->created_at);
                $xml->addChild('updated_at',$post->updated_at);

                return $xml->asXML();
            }
        }
        else{
            return response('Not Acceptable!',406);
        }
        
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $acceptHeader = $request->header('Accept');

        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|numeric',
            'categories_id' => 'required|numeric',
            'students_id' => 'required|numeric',
        ];

        $validator = Validator::make($input,$validationRules);

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $contentTypeHeader = $request->header('Content-Type');

            if($contentTypeHeader === 'application/json'){
                
                $post = Post::find($id);

                if(!$post){
                    abort(404);
                }

                if($validator->fails()){
                    return response()->json($validator->errors(),400);
                }

                $post->fill($input);
                $post->save();

                return response()->json($post,200);
            }
            else if($contentTypeHeader === 'application/xml'){
                $xmlData = $request->getContent();
                $xml = simplexml_load_string($xmlData);

                if($xml === false){
                    return response('Invalid XML',400);
                }

                $post = Post::find($id);

                if(!$post){
                    abort(404);
                }

                $post->id = $xml->id;
                $post->title = $xml->title;
                $post->status = $xml->status;
                $post->content = $xml->content;
                $post->user_id = $xml->user_id;
                $post->categories_id = $xml->categories_id;
                $post->students_id = $xml->students_id;

                if($post->save()){
                    return $xml->asXML();
                }
                else{
                    return response('Gagal menyimpan data ke database',500);
                }
            }
            else{
                return response('Unsupported Media Type',415);
            }
        }
        else{
            return response('Not Acceptable!',406);
        }
    }

    public function destroy($id)
    {
       $acceptHeader = request()->header('Accept');

       if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
           $post = Post::find($id);

           if (!$post) {
               abort(404);
           }

           $post->delete();

           $message = ['message' => 'deleted successfully', 'post_id' => $id];

           if ($acceptHeader === 'application/json') {
               return response()->json($message, 200);
           } else {
               $xml = new \SimpleXMLElement('<message/>');
               $xml->addChild('message', 'deleted successfully');
               $xml->addChild('post_id', $id);

               return $xml->asXML();
           }
       } else {
           return response('Not Acceptable!', 406);
       }
    }
}
