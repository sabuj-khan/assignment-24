@extends('layouts.sidenav-layout')
@section('content')   
    @include('components.category.event-category-list')
    @include('components.category.event-category-create')
    @include('components.category.event-category-update')
    @include('components.category.event-category-delete')
@endsection