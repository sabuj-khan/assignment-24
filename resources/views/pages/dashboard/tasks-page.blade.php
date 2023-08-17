@extends('layouts.sidenav-layout')
@section('content')
    @include('components.tasks.task-list')
    @include('components.tasks.task-create')
    @include('components.tasks.task-update')
    @include('components.tasks.task-delete')
@endsection