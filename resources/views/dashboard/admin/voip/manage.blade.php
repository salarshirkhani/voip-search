@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن شماره تلفن" route="dashboard.admin.voip.create" />
    <x-breadcrumb-item title="مدیریت شماره تلفن" route="dashboard.admin.voip.manage" />
@endsection
@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>مدیریت شماره ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>پیش شماره</th>
                                <th>شماره تلفن</th>
                                <th>شهر</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->benum }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td></td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>پیش شماره</th>
                                    <th>شماره تلفن</th>
                                    <th>شهر</th>
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <button type="submit" class="btn btn-success">ثبت شماره جدید</button>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection