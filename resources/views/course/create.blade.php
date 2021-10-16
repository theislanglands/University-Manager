<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Create course</h1>
<form id="createCourseForm" action="{{ route('courses.store') }}" method="post">
    {{ csrf_field() }}
    <div>
    <label for="code">Code</label><br>
    <input type="text" name="code" id="code">
    </div>

    <div>
    <label for="name">Name</label><br>
    <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="ects">ECTS</label><br>
        <input type="number" name="ects" id="ects">
    </div>

    <div>
    <label for="description">Description</label><br>
    <input type="text" name="description" id="description">
    </div>

    <div>
        <label for="department">Department</label><br>
        <select class="department", id="department", name="department">

        @foreach($departments as $department)
            <option value = "{{$department->id}}">{{$department->name}}</option>
        @endforeach
        </select>
    </div>

    <input type="submit" value="Create" id="submit" form="createCourseForm" class="submit">

</form>

</body>
</html>

<?php // TODO: fill out ?>
