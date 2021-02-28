@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت کاربران" route="dashboard.admin.users.index" />
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
            <x-card-header>مدیریت کاربرها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>کد ملی</th>
                                <th>ایمیل</th>
                                <th>شهر</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->first_name }}    {{ $item->last_name }}</td>
                                    <td>{{ $item->national_code }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td></td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>کد ملی</th>
                                    <th>ایمیل</th>
                                    <th>شهر</th>
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection