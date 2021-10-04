# Assignment 1: Towards itslearning

In this assignment, we will recreate the *itslearning* system using the Laravel MVC framework.

You must follow the instructions **to the letter**.
We use an automatic testing environment to test your code at different levels: model, controllers, and views interaction.
If you do not follow the instructions correctly, you may have a functional code that may not pass the tests.
If something like that happens, let us know to analyze your particular case and determine if we need to fix our tests.

For our first iteration of itslearning, you will develop a system where a user can manage courses and departments (entities that provide course: *eg,* Department of Software Engineering).

<span style="color:red">**Disclaimer:** Unless otherwise instructed, do not in any way, modify the contents of the `/tests` directory or the `.gitlab-ci.yml` file. Doing so will be considered cheating, and will in best case result in your assignment being failed.</span>

## Setup

1. Clone your project locally.
2. Run `composer install` to install php dependencies.
3. Create a copy of the .env.example file named .env. This can be done with the command `cp .env.example .env`
4. Run `php artisan key:generate` to generate a random encryption key for your application
5. Run `php artisan serve` to boot up your application


### The database
The project requires a connection to a database. Luckily, thanks to docker, this is extremely simple and platform agnostic. To spin up a MySQL server, simply run the `docker-compose up -d` within the directory. This will pull a MySQL server, port-forward it to port 3306 on your machine, and start it in detached mode. 

Additionally we have included an installation of _phpmyadmin_ that you can use to explore the database (this will start as part of the docker command), simply go to [http://localhost:8036](http://localhost:8036) and you should see something like this:

![](https://codimd.s3.shivering-isles.com/demo/uploads/upload_167959c79a2bdfdf204221075b524b59.png)
(if the database is empty, you haven't migrated it yet)

You are of course still free to use whichever tool you prefer.

The connection to the database is defined as follows:
- host: `localhost`
- port: `3306`
- username: `root`
- password: `secret`
- database: `webtech`

If you followed the steps mentioned earlier and copied your `.env.example` to `.env`, then Laravel should already be configured with the correct connection details.

_Hint: your JetBrains Student subscription comes bundled with __DataGrip__, which can be used to explore your database._

### Relevant commands

- `php artisan migrate` - This will synchronize your database structure to your migrations (read more [here](https://laravel.com/docs/8.x/migrations#introduction)), these can be viewed under `database/migrations`. Laravel comes bundled with some by default, which you can either ignore or delete.
- `php artisan migrate:fresh` - Deletes everything within your database and starts the migration from scratch, very useful during development.
- `php artisan make:controller {name of Controller}` - This creates a controller with a specified name. Controllers in Laravel use a singular noun with the `Controller` suffix (HomeController, UserControler... e.g.)
- `php artisan make:model {name of model}` - Creates a model with a specified name (usually singular (User, House, Apartment, Animal...))
- `php artisan make:model {name of model} -mr` - Allows us to create a model with a given name, as well as a controller for it and a migration.
- `php artisan serve` - Starts the development server for the application.

### Testing your solution

Every time you push your code to our source control (gitlab.sdu.dk) (which you will have to do to pass), your code will be validated to see if it meets the requirements of this assignment. This can be slow, especially if other people are also doing it simultaneously (then you will most likely be put in a queue). To mitigate this, you can run your tests locally. 

#### Route helper tests

We've created some tests to verify that you have created the correct routes and bound them correctly. This is __not__ a requirement to pass, but it can help if you are having trouble. Simply run: `php artisan test` and it wil tell you if you are missing a route or if it's not connected correctly.


#### Running browser tests

You should run our browser tests using Laravel Dusk.

The first time you run the tests on your machine, you will have to install the latest `Chrome` binaries; this can be done with the `php artisan dusk:chrome-driver` command (make sure you have the latest version of chrome).

In another terminal, run `php artisan serve` - this is needed as dusk actively uses the server to test your implementation. Make sure the server is up and running every time you test your implementation.

In your main terminal, run: `php artisan dusk --browse` - this will start running your tests.

##### Running individual browser tests

It's also possible to run a single test instead of all of them at once. This is beneficial if you just want to focus on one task before proceeding to the next.

The project contains 13 tests that you can run individually:

1. `php artisan dusk --browse --filter testHomepage` - tests that your homepage fulfills the requirements.
2. `php artisan dusk --browse --filter testDepartmentIndexWithNoCourses` - tests that the index page for your departments shows the relevant information while no curses is linked to the department.
3. `php artisan dusk --browse  --filter testCreateNewDepartment` - tests that your application can create a new department and show it on the index page and displays the correct success message.
4. `php artisan dusk --browse --filter testCreateNewCourse` - tests that your application can create a new course, link it to a department, and show it on the index page as well as displaying the correct success message.
5. `php artisan dusk --browse --filter testShowCourse` - tests that a course can be shown with the correct details and that it can follow a link to the appropriate department that owns the course.
6. `php artisan dusk --browse --filter testEditCourse` - tests that your application can update an existing course and display the correct success message.
7. `php artisan dusk --browse --filter testDeleteCourse` - tests that your application can delete an existing course and display the correct success message.
8. `php artisan dusk --browse --filter testShowDepartment` - tests that a department can be shown with the correct details and follow a link to the rightful courses linked to the department.
9. `php artisan dusk --browse --filter testEditDepartment` - tests that your application can update an existing department and display the correct success message.
10. `php artisan dusk --browse --filter testDeleteDepartment` - tests that your application can delete an existing department and display the correct success message.
11. `php artisan dusk --browse --filter testDepartmentIndexWithCourses` - tests that the index page of your departments shows the correct number of departments in the overview.
12. `php artisan dusk --browse --filter testCoursesAreRemovedWhenWhenADepartmentIsDeleted` - tests that related courses are deleted when a department is deleted.
13. `php artisan dusk --browse --filter testCourseIndexPage` - tests that the course index page shows the right info and is able to redirect to the department that owns the course.


## Logic

### Route overview
The following routes should be created and wired to the appropriate controller:

| URL | Method | Controller | Description |
| -------- | -------- | -------- | ----- |
| /     | GET     | MainController     | Shows welcome page |
| /departments | GET | DepartmentController | Lists departments |
| /departments/create | GET | DepartmentController| Displays the form that creates a new department |
| /departments | POST | DepartmentController  | Creates a new department |
|/departments/{department} | GET | DepartmentController | Shows the {department} |
| /departments/{department}/edit | GET | DepartmentController | Displays the form that updates the department |
| /departments/{department} | PUT | DepartmentController | Updates the {department} |
| /departments/{department} | DELETE | DepartmentController | Deletes the {department} |
| /courses | GET | CoursesController | Lists courses |
| /courses/create | GET | CoursesController| Displays the form that creates a new course |
| /courses | POST | CoursesController  | Creates a new course |
|/courses/{course} | GET | CoursesController | Shows the {course} |
| /courses/{course}/edit | GET | CoursesController | Displays the form that updates the course |
| /courses/{course} | PUT | CoursesController | Updates the {course} |
| /courses/{course} | DELETE | CoursesController | Deletes the {course} |

We will work with two models: ```Course``` and ```Department```.
Both models have their own ID, which is a unique identifier provided by the system.

The Department model has the following required fields: name, code, description.
A department should always provide a course (*ie,* courses cannot be created without a department).
Name and code are unique fields: not two departments may exist with the same name or with the same code.

The Course model has the following required fields: name, code, ects (the ects value of the course), description (*ie*, a text describing the content of the course), department_id (remember to create a foreign key in your migration).

![](https://codimd.s3.shivering-isles.com/demo/uploads/upload_44c53114941d7343401811419d5bc288.png)


Any of the fields listed above in course and department can be modified.
If a department is removed from the system, its associated courses should be removed too.
If a course is removed, nothing else is needed.

## Tasks

### 1. Home of your app

Your app's home is a web page that shows a welcome message in a tag with class: `welcome`.
The message in this tag is: `Welcome to <my system>` (you can pick the name of your system).

It also has links to access the index of departments and courses.
Each link has the class `departments-link` and `courses-link`, respectively.

The home is managed by the `MainController` using the `index` method.
The URL to access the home is the root of your application: `/`.

### 2. Department: index

This page is accessed using the route `/departments` and it will display a list of all the departments in the system.

Every department displayed is inside an HTML tag with class: `department` (tip: you can use a div).
Inside this HTML tag, HTML tags with a specific class are created for each field displayed:

* `code`, for the code.
* `name`, for the name.
* `courses`, to display the number of courses: `<n> courses`.
* `show`,  link tag that points to the view of the respective department (Task 4).

In addition, a link is displayed that redirects to the form to create departments (Task 3).

This view should also have an HTML tag with class `success-message`.
This tag is used to display a message when a new department is created.

This view is managed by the `DeparmentController` with method `index` and HTTP method `GET`.


### 3. Department: create

This page is accessed using the url`/departments/create` and displays a form with the necessary inputs to create a department.
You should use the following names per input:

* `code`, for the code.
* `name`, for the name.
* `description`, for the description.

A submit input is also presented to submit the form to the URL `/departments` with HTTP method `POST`.  The submit input needs to have the class `submit`.
The method `create` from the controller `DepartmentController` manages this view.

When submitting the form, the method `store` from the same controller takes action.
The action retrieves the data from the previous form and creates a new department, persisting it to a database.
Then, it redirects to the departments index (Task 2).
When displaying the next web page, it should show the following success message: `Department <code> created successfully`.

### 4. Deparment: show

This page is accessed via the URL `/departments/{department}` and displays all the information associated with the department `{department}`.
This information is presented with the following HTML tags with classes:

* `code`, for the code.
* `name`, for the name.
* `description`, for the description.

In addition, a list of courses is displayed, and, for each course, the class `course` is used.
Inside this HTML tag, HTML tags with specific classes are created for each displayed field:

* `code`, for the code.
* `name`, for the name.
* `ects`, for the ECTS value.
* `show`, link tag that points to the view of the respective course (Task 9).

This view should also have an HTML tag with class `success-message`.
This tag displays a message when this department has been updated successfully (Task 5).

In addition to this form, two extra buttons should be created: one to edit the department and another to remove it from the database.
These buttons have the classes `edit` and `remove` respectively, pointing the respective actions (Task 5 and Task 6).

The method `show` from the `DepartmentController` manages this web page.

### 5. Department: edit

This page is accessed via the URL `/departments/{department}/edit` and displays a form with the necessary inputs to edit the department `{department}`.
Every input should be previously filled with the correct data.
You should use the following names per input:

* ```code```, for the code.
* ```name```, for the name.
* ```description```, for the description.


A submit input is also presented to allow for the submission of the form to the URL `/departments/{department}` with HTTP method `PUT`.  The submit input needs to have the class `submit`.
The method `edit` from the controller `DepartmentController` manages this view.

When submitting the form, the method `update` from the same controller takes action.
The action retrieves the data from the previous form and updates the current department in the database.
Then, it redirects to the view of the specific department (Task 4).
When displaying the next web page, it should show the following success message: `Department <code> updated successfully`.

### 6. Department: destroy

To remove a department from the database, a call to the page `/departments/{department}` is performed with method `DELETE`.
When removing the correspondent department, it redirects to the index of departments (Task 2), displaying the success message: `Department <code> successfully removed`.

The method `destroy` from the controller `DepartmentController` manages this action.

### 7. Courses: index

This page is accessed using the route `/courses` and it will display a list of all the courses in the system.

Every course displayed is inside an HTML tag with class: `course` (tip: you can use a div).
Inside this HTML tag, HTML tags with a specific class are created for each field displayed:

* `code`, for the code.
* `name`, for the name.
* `ects`, for the ECTS value.
* `department`, for name of the department. This also includes a link that redirects to the web page to see the information of the department (Task 4).
* `show`, link tag that points to the view of the respective course (Task 9).

In addition, a link is displayed that redirects to the form to create courses (Task 8).

This view should also have an HTML tag with class `success-message`.
This tag is used to display a message when a new course is created.

This view is managed by the `CourseController` with method `index` and HTTP method `GET`.

### 8. Course: create

This page is accessed using the url`/courses/create` and displays a form with the necessary inputs to create a course.
You should use the following names per input:

* `code`, for the code.
* `name`, for the name.
* `ects`, for the ECTS value.
* `department`, this field should be a select tag that shows all the departments (value is the id of the database, and every option shows the department's name).
* `description`, for the description.

A submit input is also presented to submit the form to the URL `/courses` with method `POST`. The submit input needs to have the class `submit`.
The method `create` from the controller `CourseController` manages this view.

When submitting the form, the method `store` from the same controller takes action.
The action retrieves the data from the previous form and creates a new course associated with a department, persisting it to a database.
Then, it redirects to the courses index (Task 7).
When displaying the next web page, it should show the following success message: `Course <code> created successfully`.

### 9. Course: show

This page is accessed via the URL `/courses/{course}` and displays all the information associated with the course `{course}`.
This information is presented with the following HTML tags with classes:

* `code`, for the code.
* `name`, for the name.
* `ects`, for the ECTS value.
* `department`, for the name of the department. This also includes a link that redirects to the web page to see the information of the department (Task 4).
* `description`, for the description.

This view should also have an HTML tag with class `success-message`.
This tag is used to display a message when this course has been updated successfully (Task 10).

In addition to this form, two extra buttons should be created: one to edit the course and another to remove it from the database.
These buttons have the classes `edit` and `remove`, respectively, pointing the respective actions (Task 10 and Task 11).

The method `show` from the `CourseController` manages this web page.


### 10. Course: edit

This page is accessed via the URL `/courses/{course}/edit` and displays a form with the necessary inputs to edit the course `{course}`.
Every input should be previously filled with the right data.
You should use the following names per input:

* `code`, for the code.
* `name`, for the name.
* `ects`, for the ECTS value.
* `department`, for the department. This field should be a select tag that shows all the departments, but the current department of this course is the default value.
* `description`, for the description.


A submit input is also presented to allow for the submission of the form to the URL `/courses/{course}` with method `PUT`. The submit input needs to have the class `submit`.
The method `edit` from the controller `CourseController` manages this view.

When submitting the form, the method `update` from the same controller takes action.
The action retrieves the data from the previous form and updates the current course in the database.
Then, it redirects to the view of the specific course (Task 9).
When displaying the next web page, it should show the following success message: `Course <code> updated successfully`.

### 11. Course: destroy

To remove a course from the database, a call to the page `/courses/{department}` is performed with method `DELETE`.
After removing the correspondent course, a redirection is performed to the index of courses (Task 7), displaying the success message: `Course <code> successfully removed`.

The method `destroy` from the controller `CourseController` manages this action.
