<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use DB;

class Employee extends Model {

    protected $table = 'employee';
    protected $fillable = ['first_name', 'last_name', 'mobile', 'email', 'dob', 'age', 'salary'];
    public static $nullable = [];
    public static $updatable = ['first_name', 'last_name', 'mobile', 'email', 'dob', 'age', 'salary'];
    public static $forcedSelect = ['first_name', 'last_name', 'mobile', 'email', 'dob', 'age', 'salary'];
    protected $appends = ['full_name'];

    public static function createRules() {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile' => ['required'],
            'email' => ['required', 'email'],
            'dob' => ['required', 'date'],
            'salary' => ['required', 'integer'],
        ];
    }

    public static function updateRules($record) {
        return [
            'first_name' => ['sometimes', 'required'],
            'last_name' => ['sometimes', 'required'],
            'mobile' => ['sometimes', 'required'],
            'email' => ['sometimes', 'required', 'email'],
            'dob' => ['sometimes', 'required', 'date'],
            'salary' => ['sometimes', 'required', 'integer'],
        ];
    }

    public function setAttribute($key, $val) {
        $value = (in_array($key, self::$nullable) && ($val === '' || $val === null)) ? null : trim($val);
        return parent::setAttribute($key, $value);
    }

    public function setDobAttribute($val) {
        $age = Carbon::make($val)->age;
        $this->attributes['dob'] = $val;
        $this->attributes['age'] = $age;
    }

     public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
