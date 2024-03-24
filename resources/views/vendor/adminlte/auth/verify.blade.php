@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', trans('adminlte::adminlte.verify_message'))

@section('auth_body')

    @if(session('resent'))
        <div class="alert alert-success" role="alert">
            {{ trans('adminlte::adminlte.verify_email_sent') }}
        </div>
    @endif

    {{ trans('adminlte::adminlte.verify_check_your_email') }}
    {{ trans('adminlte::adminlte.verify_if_not_recieved') }},

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            {{ trans('adminlte::adminlte.verify_request_another') }}
        </button>.
    </form>

@stop
