<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the company.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select(['id', 'name', 'email', 'website'])
            ->latest()
            ->paginate(10);

        return view('web.pages.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.pages.companies.create');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->safe()->except('logo'));

        $this->uploadLogo($request, $company);

        return redirect()->route('companies.show', $company->id)
            ->with('success', __('The company has been created successfully.'));
    }

    /**
     * Display the specified company.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('web.pages.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('web.pages.companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->safe()->except('logo'));

        $this->uploadLogo($request, $company, true);

        return redirect()->route('companies.show', $company->id)
            ->with('success', __('The company has been updated successfully.'));
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $deleted = $company->delete();

        if (!$deleted) {
            return redirect()->route('companies.show', $company->id)
                ->with('fail', __('The company could not be deleted. Please, try again!'));
        }

        $this->deleteLogo($company);

        return redirect()->route('companies.index')
            ->with('success', __('The company has been deleted successfully.'));
    }

    /**
     * Upload a logo of the specified company.
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @param  boolean  $update
     * @return void
     */
    private function uploadLogo(CompanyRequest $request, Company $company, $update = false)
    {
        if ($request->hasFile('logo')) {
            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = rand(10000, 100000) . time() . '.' . $extension;

            $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);

            if ($update) {
                $this->deleteLogo($company);
            }

            $company->update(['logo' => $fileNameToStore]);
        }
    }

    /**
     * Delete a logo of the specified company.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    private function deleteLogo(Company $company)
    {
        Storage::delete('public/companies/logos/' . $company->logo);
    }
}
