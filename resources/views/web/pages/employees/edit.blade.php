@extends('web.layouts.master')

@section('title')
    {{ __('Edit employee') }} - {{ $employee->id }}
@endsection

@section('content')
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="first_name">{{ __('First name') }} <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" placeholder="{{ __('First name') }}" required>
            @error ('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="last_name">{{ __('Last name') }} <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" placeholder="{{ __('Last name') }}" required>
            @error ('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="company_id">{{ __('Company') }}</label>
            <select class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $employee->company->id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
            @error ('company_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employee->email) }}" placeholder="{{ __('Email Address') }}">
            @error ('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" placeholder="{{ __('Phone') }}" minlength="10" maxlength="10">
            @error ('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">{{ __('Update the employee') }}</button>
    </form>
@endsection