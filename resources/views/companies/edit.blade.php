@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Company</h1>
        <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $company->email }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Logo (min 100x100)</label>
                <input type="file" name="logo" class="form-control">
                @if($company->logo)
                    <img src="{{ asset('storage/' . basename($company->logo)) }}" width="50">
                @endif
            </div>
            <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" value="{{ $company->website }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection