@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="container">
        <h4>Companies</h4>
        <a href="{{ route('companies.create') }}" class="btn btn-success">Create New Company</a>
        <table class="table" style="border: 1px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" width="50">
                            @else
                                No Logo
                            @endif
                        </td>                    <td>{{ $company->website }}</td>
                        <td>
                            <button><a href="{{ route('companies.edit', $company) }}" style="text-decoration: none; color:black">Edit</a></button>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $companies->links() }}
    </div>
@endsection