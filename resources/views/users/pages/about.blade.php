@extends('users.master')

@section('content')
    @include('users.elements.detail_page')
    @include('users.components.homes.introduce_component')
    @include('users.components.homes.satisfied_customer_component')
@endsection
