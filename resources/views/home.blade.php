{{-- @extends('adminlte::page') --}}
@extends('layouts.page')

@section('title', 'Dashboard User')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    @component('cekLogin')
                        
    @endcomponent
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">You are logged in as {{Auth::user()->name}}!</p>
                <h1>INVENTORI SMK</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>Name </th><td>{{Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <th>Email </th><td>{{Auth::user()->email}}</td>
                    </tr>
                    <tr>
                        <th>Level</th><td>User</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
