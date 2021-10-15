<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        // return "Main Controller<br>Welcome to Assignment 1 of Web Technologies E2021<br>Edit this page to get started 😄";

        return view('main.welcome');
    }
}
