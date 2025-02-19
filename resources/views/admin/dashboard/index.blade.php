@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 xl:col-span-4">
            <x-chart.penduduk.pie-chart />
        </div>
        <div class="col-span-12 space-y-6 xl:col-span-8">
            <x-chart.penduduk.bar-chart />
        </div>
    </div>
@endsection
