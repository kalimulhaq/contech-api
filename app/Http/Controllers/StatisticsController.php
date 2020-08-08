<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use DB;

class StatisticsController extends Controller {

    public function topPaidEmployees(Request $request) {
        $limit = $request->limit ?: 20;
        $query = Employee::query();
        $query->select('first_name', 'last_name', 'mobile', 'email', 'dob', 'salary');
        $query->orderBy('salary', 'desc');
        $query->limit($limit);
        $result = $query->get();
        return $this->success($result);
    }

    public function averageSalaryByAge(Request $request) {
        $query = Employee::query();
        $query->select('age', DB::raw('AVG(salary) as avg_salary'));
        $query->groupBy('age');
        $query->orderBy('avg_salary', 'desc');
        $result = $query->get();
        return $this->success($result);
    }

}
