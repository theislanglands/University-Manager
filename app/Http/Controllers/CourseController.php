<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        return "CoarseController - index function - Lists coarses";

        //return view('main.welcome');
    }

    public function create(){
        return "Displays the form that creates a new coarse";
        // Displays the form that creates a new coarse
    }

    public function store(){
        return "Displays the form that creates a new coarse";

    }

    public function show(){
        return "Shows the {coarse}";
    }

    public function edit(){
        return "Displays the form that updates the coarse";
    }

    public function update(){
        return "Updates the {coarse}";
    }

    public function delete(){
        return "Deletes the {coarse}";
    }
}
