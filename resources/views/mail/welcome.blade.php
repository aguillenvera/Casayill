@extends('layouts.master')
@section('css')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Welcome {{$name}}</div>
                <div class="card-body">
                    <p>Lorem Ipsum Dolor Sit Amet</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
