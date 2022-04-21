@extends('web.layouts.master')

@section('title')
    {{ __('Company') }} - {{ $company->id }}
@endsection

@section('content')
    <div>
        <h5>{{ __('Name') }}</h5>
        {{ $company->name }}
    </div>

    <div class="mt-4">
        <h5>{{ __('Logo') }}</h5>
        <img src="{{ $company->logo() }}" width="100" height="100" alt="{{ __('Logo') }}">
    </div>

    <div class="mt-4">
        <h5>{{ __('Email Address') }}</h5>
        {{ $company->email ?? __('No email address was given') }}
    </div>

    <div class="mt-4">
        <h5>{{ __('Website') }}</h5>
        {{ $company->website ?? __('No website url was given') }}
    </div>

    <div class="mt-4">
        <a class="btn btn-warning" href="{{ route('companies.edit', $company->id) }}">{{ __('Edit') }}</a>
        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteCompany{{ $company->id }}">{{ __('Delete') }}</a>
        @include('web.pages.companies.modals.delete-modal', ['company' => $company])
    </div>
@endsection