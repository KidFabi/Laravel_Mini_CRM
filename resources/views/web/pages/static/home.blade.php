@extends('web.layouts.master')

@section('title')
    {{ __('Home') }}
@endsection

@section('content')
    @guest
        <a href="{{ route('login') }}">{{ __('Log in') }}</a>
    @endguest
    @auth
        <div class="row justify-content-center">
            <a href="{{ route('companies.index') }}" class="btn btn-primary">{{ __('Manage companies') }}</a>
            <span class="mt-3"></span>
            <a href="{{ route('employees.index') }}" class="btn btn-info">{{ __('Manage employees') }}</a>
        </div>
    @endauth
@endsection