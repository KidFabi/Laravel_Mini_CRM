@extends('web.layouts.master')

@section('title')
    {{ __('Edit company') }} - {{ $company->id }}
@endsection

@section('content')
    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">{{ __('Name') }} <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $company->name) }}" placeholder="{{ __('Company name') }}" required>
            @error ('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $company->email) }}" placeholder="{{ __('Company Email Address') }}">
            @error ('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="logo">{{ __('Logo') }}</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo">
            @error ('logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if (!empty($company->logo))
                <h5 class="mt-3">{{ __('Current logo') }}</h5>
                <img src="{{ $company->logo() }}" width="100" height="100" alt="{{ __('Logo') }}">
            @endif
        </div>
        <div class="form-group mt-3">
            <label for="website">{{ __('Website') }}</label>
            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $company->website) }}" placeholder="{{ __('Company website') }}">
            @error ('website')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">{{ __('Update the company') }}</button>
    </form>
@endsection