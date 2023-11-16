<?php
namespace App\Http\Controllers;

class phpServiceController extends Controller
{
    public function __construct()
    {
        return "Lumen Controller";
    }

    public function index()
    {
        echo json_encode(array('service_name' => 'PHP Service App', 'status' => 'Running'));
    }

    public function user($id = null) 
{
    $users = array (
        array('id' => 1, 'name' => 'Sumatrana', 'email' => 'sumatrana@gmail.com', 'address' =>
            'Padang', 'gender' => 'Laki-Laki'),
        array('id' => 2, 'name' => 'Jawarianto', 'email' => 'jawarianto@gmail.com', 'address' =>
            'Cimahi', 'gender' => 'Laki-laki'),
        array('id' => 3, 'name' => 'Kalimantanio', 'email' => 'kalimantanio@gmail.com', 'address' =>
            'Samarinda', 'gender' => 'Laki-laki'),
        array('id' => 4, 'name' => 'Sulawesiani', 'email' => 'sulawesiani@gmail.com', 'address' =>
            'makassar', 'gender' => 'Perempuan'),
        array('id' => 5, 'name' => 'Papuani', 'email' => 'papuani@gmail.com', 'address' =>
            'Jayapura', 'gender' => 'Perempuan'),
    );


    $foundUser = null;
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            $foundUser = $user;
            break;
        }
    }

    if ($foundUser) {
        return json_encode($foundUser);
    } else {
        return json_encode($users);
    }

}

}