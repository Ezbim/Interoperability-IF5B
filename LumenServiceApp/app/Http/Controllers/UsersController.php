<?php
namespace App\Http\Controllers;

use App\Models\User;
use illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        return "Lumen Controller";
    }

    public function store(Request $request){
        $input = $request->all();
        
    }
}