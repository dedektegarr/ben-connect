@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <x-panel.panel>
        <x-panel.panel-header title="Statistik Penduduk Provinsi Bengkulu" />
        <x-panel.panel-body>
            {{-- <livewire:penduduk.statistik-penduduk /> --}}
        </x-panel.panel-body>
    </x-panel.panel>
@endsection
