# Assignment 1: Towards itslearning

This exersize, is the creation of a system for managing university departments and coarses using the Laravel MVC framework. 
It's possible to view, create, update and delete departments and Courses related to them.

## Setup
To run the application

1.  Run the `docker-compose up -d` within the directory to pull and start MySQL server on port 3306.
2.  Run `php artisan migrate:fresh --seed` to seed the database.
3.  Run `php artisan serve` to boot up your application at localhost port 8000.


### Route overview
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

