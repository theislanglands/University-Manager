<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();

        return view('department.index')
            ->with('departments', $departments);
    }

    public function create(){
        // Displays the form that creates a new department
        return view('department.create');
    }

    public function store(request $dep){
        $department = new Department();
        $department->name = $dep -> name;
        $department->code = $dep -> code;
        $department->description = $dep -> description;
        $department->save();

        return redirect::to(route('departments.index'))
            ->with("success", "Department $department->code created successfully.");
    }

    public function show($department_id){
        $department = Department::findOrFail($department_id);

        return View('department.show')
            ->with('department', $department);
    }

    public function edit($department_id){
        $department = Department::findOrFail($department_id);

        return View('department.edit')
            ->with('department', $department);
    }

    public function update($id){
        $department = Department::findOrFail($id);
        $department->name = request()->name;
        $department->code = request()->code;
        $department->description = request()->description;
        $department->save();

        return redirect::to(route('departments.show', $department->id))
            ->with("success", "Department $department->code updated successfully.");
    }

    public function delete($id){
        $department = Department::findOrFail($id);
        Department::destroy($id);

        return redirect::to(route('departments.index'))
            ->with("success", "Department $department->code successfully removed.");
    }
}
