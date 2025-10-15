<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::orderBy('id', 'asc')->paginate(5);
        return view('components.company-settings.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.company-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle images
            $data['company_logo'] = $this->uploadImage($request, 'company_logo');
            $data['company_favicon'] = $this->uploadImage($request, 'company_favicon');

            Company::create($data);

            return redirect()->route('dashboard.company.index')
                ->with('success', 'Company setting created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('components.company-settings.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id) 
    {
        try {
            $company = Company::findOrFail($id);
            $data = $request->validated();

            // Update images if new ones are uploaded
            if ($request->hasFile('company_logo')) {
                $this->deleteOldFile($company->company_logo);
                $data['company_logo'] = $this->uploadImage($request, 'company_logo');
            }

            if ($request->hasFile('company_favicon')) {
                $this->deleteOldFile($company->company_favicon);
                $data['company_favicon'] = $this->uploadImage($request, 'company_favicon');
            }

            $company->update($data);

            return redirect()->route('dashboard.company.index')
                ->with('success', 'Company setting updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $company = Company::findOrFail($id);
            $this->deleteOldFile($company->company_logo);
            $this->deleteOldFile($company->company_favicon);
            $company->delete();

            return redirect()->route('dashboard.company.index')
                ->with('success', 'Company setting deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    |                       Helper Functions
    |--------------------------------------------------------------------------
    */
    private function uploadImage($request, $field)
    {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $name = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/images/company-settings/';
            $file->move(public_path($path), $name);
            return $path . $name;
        }
        return null;
    }

    private function deleteOldFile($filePath)
    {
        if ($filePath && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }
    }
}
