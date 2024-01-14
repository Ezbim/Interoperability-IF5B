<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function getRequestJson(Request $request)
    {
        $url = 'https://dummy.restapiexample.com/api/v1/employees';
        $header = ['Accept: application/json'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        // echo"<pre>";print_r($response);die();
        return view('posts/getRequestJson', ['results' => $response]);
    }


    public function showRequestJson($id){
        $url = 'https://dummy.restapiexample.com/api/v1/employee/'.$id;
        $header = ['Accept: application/json'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        // echo"<pre>";print_r($response);die();
        return view('posts/getidRequestJson', ['result' => $response]);
    }

   
    public function createRequestJson(Request $request)
    {
        return view('posts/postRequestJson');
    }

    public function postRequestJson(Request $request)
    {
        // echo "<pre>";print_r($request->all());die();
        $url='https://dummy.restapiexample.com/api/v1/create';
        $headers = ['Accept: application/json','Content-Type: application/json'];
        $data = [
                "employee_name" => $request->input('employeeName'),
                "employee_salary" => $request->input('employeeSalary'),
                "employee_age" => $request->input('employeeAge'),
                'profile_image' => '',
                "id" => $request->input('employeeId')
        ];


        $dataJSON = json_encode($data);

        // initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // set url
        curl_setopt($ch, CURLOPT_URL,$url);
        // set headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // set posst data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJSON);
        // execute
        $result = curl_exec($ch);
        // closing
        curl_close($ch);

        // parse json response from request to be php object
        $response = json_decode($result, true);


    

        // echo"<pre>";print_r($response);die();
        return view('posts/resultRequestJson',['result'=> $response]);
    }


    public function updateRequestJson(Request $request, $id)
    {
        $url = 'https://dummy.restapiexample.com/api/v1/employee/'.$id;
        $header = ['Accept: application/json'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        // echo"<pre>";print_r($response);die();
        return view('posts/updateRequestJson', ['result' => $response]);
    }


    public function changeRequestJson(Request $request)
    {

        $id = $request->input('id'); 

        $url = 'https://dummy.restapiexample.com/api/v1/update/'.$id;
        $headers = ['Accept: application/json','Content-Type: application/json'];
        $data = [
                "employee_name" => $request->input('employeeName'),
                "employee_salary" => $request->input('employeeSalary'),
                "employee_age" => $request->input('employeeAge'),
                'profile_image' => '',
                "id" => $id
        ];

        

        $dataJSON = json_encode($data);

        // initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // set url
        curl_setopt($ch, CURLOPT_URL,$url);
        // set headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // set method update
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        // set post data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJSON);
        // execute
        $result = curl_exec($ch);
        // closing
        curl_close($ch);

        // parse json response from request to be php object
        $response = json_decode($result, true);

        
        return view('posts/changeRequestJson',['result'=> $response]);
    }

    
    public function deleteRequestJson(Request $request, $id)
    {
        $url = 'https://dummy.restapiexample.com/api/v1/delete/'.$id;
        $header = ['Accept: application/json'];

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $result = curl_exec($ch);
        // echo"<pre>";print_r($result);die();
        // closing
        curl_close($ch);
        $response = json_decode($result, true);

        return view('posts/getRequestJson',['result'=> $response]);
    }
}