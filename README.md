# Kun Academy Task

## Description
This is a very small simple app built using angular+4 and uses Code-Igniter or Laravel as backend API to provide the app with REST-full JSON backend We need to create a CRUD project for two entities “classes and students”. Every “class” has many "students". but the maximum number is 10 and we can detect that by class entity with field “maximum_students”. And every entity has the following fields:
"class" => code (without space), name, maximum_students,status(opened/closed),description(nullable)
"Students" => first_name , last_name , class ,date_of_birth
Install Apache + php + mysql server.
Create a database with tabels.
Create API Services for the following pages:
Run " Classes " add/edit/list/View functions in the system
Run " Students " add/edit/list functions in the system

## Extra Points
In view page for “Class” entity , show all Class students as a list.
date_of_birth field stored in field of type date.
use https://ng-bootstrap.github.io/#/components/datepicker/overview to provide a control for date_of_birth field.


## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
