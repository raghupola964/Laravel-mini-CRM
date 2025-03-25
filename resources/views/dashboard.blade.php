@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Admin Panel</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-primary">Manage Companies</a>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Manage Employees</a>
    </div>
    <div class="container">
        
        <h2>Companies CRUD</h2>
        <p>Create: You can add a new company with a name, email, logo, and website.</p>
        <p>Read: All companies are listed here with their details, 10 per page.</p>
        <p>Update: You can edit a company's name, email, logo, or website.</p>
        <p>Delete: You can remove a company from the list.</p>

        <h2>Employees CRUD</h2>
        <p>Create: You can add a new employee with a first name, last name, company, email, and phone.</p>
        <p>Read: All employees are listed here with their company names, 10 per page.</p>
        <p>Update: You can edit an employee's details like name or company assignment.</p>
        <p>Delete: You can remove an employee from the list.</p>
    </div>
@endsection
