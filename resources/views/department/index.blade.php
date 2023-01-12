<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Index of departments</h1>

@if(session('success'))
    <p class="success-message">{{session("success")}}</p>
@endif


@foreach($departments as $department)
<div class="department">
    <p class="code">code of department: {{ $department->code }}</p>
    <p class="name">name of department: {{ $department->name }}</p>
    <p class="courses">no of courses: {{ count( $department->course ) }}</p>
    <a class="show" href="{{ route('departments.show', $department->id) }}">Show department</a>
</div>
<br>
@endforeach

<a class="new" href="{{ route('departments.create') }}">Create Department</a>

</body>
</html>

