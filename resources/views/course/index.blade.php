<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Index of courses</h1>

@if(session('success'))
    <p class="success-message">{{session("success")}}</p>
@endif

@foreach($courses as $course)
<ul>
<div class="course">
    <p class="code">Code: {{ $course->code }}</p>
    <p class="name">Name: {{ $course->name }}</p>
    <p class="ects">Ects: {{ $course->ects }}</p>
    <p class="department">Department:
        <a class="department" href="{{ route('departments.show', $course->department->id) }}">
            {{ $course->department->name }}</a></p>
    <a class="show" href="{{ route('courses.show', $course->id) }}">Show course</a>
</div>
</ul>
<br>
@endforeach

<a class="new" href="{{ route('courses.create') }}">Create new Course</a>

</body>
</html>
