<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['company:id,name'])->paginate(10);

        return view('web.pages.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->companies();

        return view('web.pages.employees.create', compact('companies'));
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return redirect()->route('employees.show', $employee->id)
            ->with('success', __('The employee has been created successfully.'));
    }

    /**
     * Display the specified employee.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('web.pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = $this->companies();

        return view('web.pages.employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified employee in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.show', $employee->id)
            ->with('success', __('The employee has been updated successfully.'));
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        $deleted = $employee->delete();

        if (!$deleted) {
            return redirect()->route('employees.show', $employee->id)
                ->with('error', __('The employee could not be deleted. Please, try again!'));
        }

        return redirect()->route('employees.index')
            ->with('success', __('The employee has been deleted successfully.'));
    }

    /**
     * Get the companies.
     *
     * @return mixed
     */
    private function companies()
    {
        return Company::select('id', 'name')
            ->get();
    }
}
