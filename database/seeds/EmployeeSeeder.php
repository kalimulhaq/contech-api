<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        for($i = 1; $i<=50; $i++){
            $faker = Faker\Factory::create();
            Employee::create([
                "first_name"=> $faker->firstName,
                "last_name"=> $faker->lastName,
                "email"=> $faker->email,
                "mobile"=> $faker->e164PhoneNumber,
                "dob"=> $faker->date('Y-m-d', '-18 years'),
                "salary"=> $faker->numberBetween(10, 30) * 500
            ]);
        }
    }
}
