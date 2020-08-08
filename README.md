# Task

## RUN

- Git clone this repo
- Composer install 
```
composer install
```
- Run DB migration using 
```
php artisan migrate
```
- Run DB Seeder to add some fake employees 
```
php artisan db:seed --class=EmployeeSeeder
```
- Start the php server 
```
php -S localhost:8000 -t public/
```
- Test that API is working
```
http://localhost:8000/
```

## End Points
- Get Employees List: GET http://localhost:8000/employees
- Get Employee Details: GET http://localhost:8000/employees/{id}
- Add Employee: POST http://localhost:8000/employees
- Update Employee: PUT http://localhost:8000/employees/{id}
- Delete Employee: DELETE http://localhost:8000/employees/{id}
- Get Top Paid Employees: GET http://localhost:8000/statistics/top-paid-employees?limit=20
- Average Salary by Age: GET http://localhost:8000/statistics/average-salary-by-age

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
