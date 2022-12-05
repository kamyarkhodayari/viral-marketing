@extends('layouts.panel.layout')

@section('dashboard')
    Welcome {{ auth()->user()->name }}!
@endsection