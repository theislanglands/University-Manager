<!Doctype html>
<html lang="eng" xmlns="http://www.w3.org/1999/html">

<head>
    <title>UCAS</title>
</head>

<body>
<h1 class="welcome">Create departments</h1>
<form id="createDepartmentForm" action="{{ route('departments.store') }}" method="post">
    {{ csrf_field() }}
    <div>
    <label for="code">Code</label><br>
    <input type="text" name="code" id="code">
    </div>

    <div>
    <label for="name">Name</label><br>
    <input type="text" name="name" id="code">
    </div>

    <div>
    <label for="description">Description</label><br>

    <input type="text" name="description" id="description">
    </div>

    <input type="submit" value="Create" id="submit" form="createDepartmentForm" class="submit">


</form>

</body>
</html>

<?php // TODO: fill out ?>
