@extends('layouts.content')
@section('index')
<div class="container-fluid">
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-3">
            <div class="success" style="text-align: center;">
                <p style="margin-top: 120px;font-weight: 800;font-size: x-large;">پرداخت با موفقیت انجام شد!</p>
                <img src="img/undraw_done_a34v.png" alt="" width="60%">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="unsuccess" style="text-align: center; display: none;">
                <p style="margin-top: 120px;font-weight: 800;font-size: x-large;">پرداخت ناموفق!</p>
                <img src="img/undraw_access_denied_6w73.png" alt="" width="60%">
            </div>
        </div>
    </div>
</div>
@endsection