<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Show Course</h1>

@if(session('success'))
<p class="success-message">{{session("success")}}</p>
@endif

<div class="course">
    <p class="code">course code: {{ $course->code }}</p>
    <p class="name">name of course: {{ $course->name }}</p>
    <p class="ects">ects: {{ $course->ects }}</p>
    <p class="department">Department:
        <a class="department" href="{{ route('departments.show', $course->department->id) }}">
            {{ $course->department->name }}</a></p>
    <p class="description">description: {{ $course->description }}</p>
</div>


<a class="edit" id="edit" href="{{route('courses.edit', $course->id)}}">Edit Course</a>

<form id="deleteForm" action="{{route('courses.delete', $course->id)}}" method="post">
{{ method_field('delete') }}
{{ csrf_field() }}
</form>
<button type="submit" class="remove" form="deleteForm">Delete Course</button>


</body>
</html>

