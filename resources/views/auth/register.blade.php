@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                    <h5>Register Akun Baru</h5>
            </div>
            <div class="widget-content">
                <table class="table table-bordered" style="width: 30%; margin-left: 35%;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <tr>
                        <td>
                            Nama
                        </td>
                        <td>
                            <input id="name" type="text" class="span12" name="name" value="{{ old('name') }}" required autofocus>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input id="email" type="text" class="span12" name="email" value="{{ old('email') }}" required autofocus>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input id="password" type="password" class="span12" name="password" value="{{ old('password') }}" required autofocus>
                        </td>
                    </tr>
                    <tr>
                        <td>Ulangi Password</td>
                        <td>
                            <input id="password-confirm" type="password" class="span12" name="password_confirmation" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary pull-right"><span class="icon-user"></span> Daftar</button>
                        </td>
                    </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
