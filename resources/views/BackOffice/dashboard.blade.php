@extends('BackOffice.layout.layout1')
@section('title', 'Dashboard')
@section('main')
    <div style="margin-left: 5rem; margin-top:5rem">
        {{ Auth::user()->hasRole('admin') }}
    </div>
@endsection
