<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Show department</h1>

@if(session('success'))
<p class="success-message">{{session("success")}}</p>
@endif

<div class="department">
    <p class="code">code of department: {{ $department->code }}</p>
    <p class="name">name of department: {{ $department->name }}</p>
    <p class="description">description: {{ $department->description }}</p>
</div>

<h2>Coarses</h2>

@foreach($department->course  as $course)
    <div class="course">
        <p class="code">code of department: {{ $course->code }}</p>
        <p class="name">name of department: {{ $course->name }}</p>
        <p class="ects">ects: {{ $course->ects }}</p>
        <a class="show" href="{{route('courses.show', $course->id)}}">Show course details</a>
    </div>
@endforeach

<a class="edit" id="edit" href="{{route('departments.edit', $department->id)}}">Edit Department</a>



<form id="deleteDepartmentForm" action="{{route('departments.delete', $department->id)}}" method="post">
{{ method_field('delete') }}
{{ csrf_field() }}
</form>
<button type="submit" class="remove" form="deleteDepartmentForm">Delete Department</button>


</body>
</html>
<?php // TODO: success message?>
