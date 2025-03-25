<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

/*GET /employees: Calls EmployeeController@index
GET /employees/create: Calls EmployeeController@create
POST /employees: Calls EmployeeController@store
GET /employees/{employee}: Calls EmployeeController@show
GET /employees/{employee}/edit: Calls EmployeeController@edit
PUT/PATCH /employees/{employee}: Calls EmployeeController@update
DELETE /employees/{employee}: Calls EmployeeController@destroy*/


class EmployeeController extends Controller {
    public function index() {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create() {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request) {
        Employee::create($request->validated());
        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee) {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(StoreEmployeeRequest $request, Employee $employee) {
        $employee->update($request->validated());
        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}