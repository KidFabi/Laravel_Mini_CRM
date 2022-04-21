@extends('web.layouts.master')

@section('title')
    {{ __('Companies') }}
@endsection

@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('companies.create') }}">{{ __('Create a company') }}</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email Address') }}</th>
                <th scope="col">{{ __('Website') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $company)
                <tr>
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email ?? __('No email address was given') }}</td>
                    <td>{{ $company->website ?? __('No website url was given') }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('companies.show', $company->id) }}">{{ __('View') }}</a>
                        <a class="btn btn-warning" href="{{ route('companies.edit', $company->id) }}">{{ __('Edit') }}</a>
                        <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteCompany{{ $company->id }}">{{ __('Delete') }}</a>
                        @include('web.pages.companies.modals.delete-modal', ['company' => $company])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No companies have been found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <ul class="pagination justify-content-center">
            {{ $companies->links() }}
        </ul>
    </div>
@endsection