@extends('web.layouts.master')

@section('title')
    {{ __('Employees') }}
@endsection

@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('employees.create') }}">{{ __('Create an employee') }}</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Full Name') }}</th>
                <th scope="col">{{ __('Email Address') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col">{{ __('Company') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->fullName() }}</td>
                    <td>{{ $employee->email ?? __('No email address was given') }}</td>
                    <td>{{ $employee->phone ?? __('No phone number was given') }}</td>
                    <td>{{ $employee->company->name ?? __('The employee does not belong to any company') }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('employees.show', $employee->id) }}">{{ __('View') }}</a>
                        <a class="btn btn-warning" href="{{ route('employees.edit', $employee->id) }}">{{ __('Edit') }}</a>
                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteEmployee{{ $employee->id }}">{{ __('Delete') }}</a>
                        @include('web.pages.employees.modals.delete-modal', ['employee' => $employee])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No employees have been found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <ul class="pagination justify-content-center">
            {{ $employees->links() }}
        </ul>
    </div>
@endsection