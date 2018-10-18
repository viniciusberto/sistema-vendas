@extends('layouts.app3')

@section('content')

@include('alert', [ 'msg' => $msg ])

@yield('form')

@endsection