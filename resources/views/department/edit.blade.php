<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>

</head>

<body>
<h1 class="welcome">Edit departments</h1>
<form id="editDepartmentForm" action="{{ route('departments.update', [$department->id]) }}" method="post">
    {{ method_field('put') }}

    {{ csrf_field() }}

    <div>
        <label for="code">Code</label><br>
        <input type="text" name="code" id="code" value="{{ $department->code }}">
    </div>

    <div>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="{{ $department->name }}">
    </div>

    <div>
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description" value="{{ $department->description }}">
    </div>

    <input type="submit" value="Save Changes" id="submit" form="editDepartmentForm" class="submit">

</form>
</body>
</html>

<?php // TODO: fill out ?>
