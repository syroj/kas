@extends('layouts.layout')

@section('content')
<div class="container-fluid">
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon"> <i class="icon-key"></i></span>
            <h5>Login</h5>
        </div>
        <div class="widget-content">
            <form class="form-inline" method="post" action="{{url('/login')}}">
            <input type="hidden" name="csrf-token" value="csrf_token()">
                <table class="table table-bordered" style="width: 30%; margin-left: 35%;">
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" class="span10" placeholder="Email"></tr>
                        </td>
                    <tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="password" class="span10" placeholder="Password"></tr>
                        </td>
                    <tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary pull-right">Login</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
