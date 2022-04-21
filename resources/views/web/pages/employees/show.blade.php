@extends('web.layouts.master')

@section('title')
    {{ __('Employee') }} - {{ $employee->id }}
@endsection

@section('content')
    <div>
        <h5>{{ __('Full Name') }}</h5>
        {{ $employee->fullName() }}
    </div>

    <div class="mt-4">
        <h5>{{ __('Company') }}</h5>
        {{ $employee->company->name ?? __('The employee does not belong to any company.') }}
    </div>

    <div class="mt-4">
        <h5>{{ __('Email Address') }}</h5>
        {{ $employee->email ?? __('No email address was given') }}
    </div>

    <div class="mt-4">
        <h5>{{ __('Phone') }}</h5>
        {{ $employee->phone ?? __('No phone number was given') }}
    </div>

    <div class="mt-4">
        <a class="btn btn-warning" href="{{ route('employees.edit', $employee->id) }}">{{ __('Edit') }}</a>
        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteEmployee{{ $employee->id }}">{{ __('Delete') }}</a>
        @include('web.pages.employees.modals.delete-modal', ['employee' => $employee])
    </div>
@endsection