<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Edit courses</h1>
<form id="editDepartmentForm" action="{{ route('courses.update', [$course->id]) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}

    <div>
        <label for="code">Code</label><br>
        <input type="text" name="code" id="code" value="{{ $course->code }}">
    </div>

    <div>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="{{ $course->name }}">
    </div>

    <div>
        <label for="ects">ECTS</label><br>
        <input type="number" name="ects" id="ects" value="{{ $course->ects }}">
    </div>

    <div>
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description" value="{{ $course->description }}">
    </div>

    <div>
        <label for="department">Department</label><br>
        <select class="department", id="department", name="department">

            @foreach($departments as $department)
                @if($department->id == $course->department->id)
                    <option selected value = "{{$department->id}}">{{$department->name}}</option>
                @else
                    <option value = "{{$department->id}}">{{$department->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <input type="submit" value="Save Changes" id="submit" form="editDepartmentForm" class="submit">

</form>
</body>
</html>

<?php // TODO: fill out ?>
