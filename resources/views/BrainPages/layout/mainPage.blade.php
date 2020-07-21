@extends('layouts.app')

@section('pageTitle')
    @yield('pageTitle2')
@endsection

@section('content')
    <div class="col-md-10 offset-1">
        <div class="card-group">
            <div class="card col-1">
                <div class="card-body">
                    <a href="{{route('home')}}"><i class="fa fa-tachometer fa-2x"></i></a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if (isset($status))
                        <div class="container">
                            <div class="col-md-10 offset-1">
                                <div class="alert alert-success" role="alert">
                                    {{ $status }}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @include('includes.list')
                    @yield('mainContent')
@endsection