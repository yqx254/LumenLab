<?php


namespace App\Http\Controllers\Filter;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller{
    public function index(Request $request){
        echo 'Your profile!';
    }

    public function edit(Request $request){
        echo 'Ha! edit';
    }
}