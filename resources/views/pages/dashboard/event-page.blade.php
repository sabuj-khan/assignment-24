@extends('layouts.sidenav-layout')
@section('content')   
    @include('components.events.event-list')
    @include('components.events.event-create')
    @include('components.events.event-update')
    @include('components.events.event-delete')
    
@endsection