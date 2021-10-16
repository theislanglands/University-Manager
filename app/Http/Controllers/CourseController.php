<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    public function index(){
        return view('course.index')
            ->with('courses', Course::all());
    }

    public function create(){
        return view('course.create')
            ->with('departments', Department::all());
    }

    public function store(request $req){
        // retrieves the data from the previous form
        // and creates a new course associated with a department,

        $course = new Course();

        $course->code = $req->code;
        $course->name = $req->name;
        $course->ects = $req->ects;
        $course->description = $req->description;

        $course->department_id = $req->department;
        // alternativ løsning
        // $course->department()->associate(Department::find($req->department));

        $course->save();

        return redirect::to(route('courses.index'))
            ->with("success", "Course $course->code created successfully.");
    }

    public function show($course_id){

        return View('course.show')
            ->with('course', Course::findOrFail($course_id));
    }

    public function edit($course_id){
        return View('course.edit')
            ->with('departments', Department::all())
            ->with('course', Course::findOrFail($course_id));
    }

    public function update($course_id){
        $course = Course::findOrFail($course_id);

        //The action retrieves the data from the previous form
        //and updates the current course in the database.
        $course->code = request()->code;
        $course->name = request()->name;
        $course->ects = request()->ects;
        $course->description = request()->description;
        $course->department_id = request()->department;
        $course->save();

        return Redirect::route('courses.show', $course->id)
            ->with("success", "Course $course->code updated successfully");
    }

    public function delete($id){
        $course = Course::findOrFail($id);
        Course::destroy($id);
        return Redirect::route('courses.index')
            ->with("success", "Course $course->code successfully removed");
    }
}
