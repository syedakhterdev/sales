<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getAllEmployees() {
        $employees = Employee::get();
        return response()->json($employees);
    }
}
