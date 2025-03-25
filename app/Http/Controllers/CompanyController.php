<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


/*GET /companies: Calls CompanyController@index
GET /companies/create: Calls CompanyController@create
POST /companies: Calls CompanyController@store
GET /companies/{company}: Calls CompanyController@show
GET /companies/{company}/edit: Calls CompanyController@edit
PUT/PATCH /companies/{company}: Calls CompanyController@update
DELETE /companies/{company}: Calls CompanyController@destroy*/

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->hashName(); // e.g., "randomstring.jpg"
            // Manually save to public/logos
            $file->move(storage_path('app/public/logos'), $filename);
            $data['logo'] = 'logos/' . $filename;
        }
        Company::create($data);
        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(StoreCompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->hashName();
            $file->move(storage_path('app/public/logos'), $filename);
            $data['logo'] = 'logos/' . $filename;
        }
        $company->update($data);
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }
}