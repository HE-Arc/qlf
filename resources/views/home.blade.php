@extends('layouts.app')

@section('main')
    @include('tabs.live')
    @include('tabs.games')
    @include('tabs.market')
    @include('tabs.settings')
@endsection