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
                                <th>قیمت</th>
                                <th>شهر</th>
                                <th>حذف</th>                               
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->benum }}</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>
                                    <a href="{{route('dashboard.admin.voip.deletepost',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                    </td>
                                    <td>
                                    <a href="{{route('dashboard.admin.voip.updatepost',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>پیش شماره</th>
                                    <th>شماره تلفن</th>
                                    <th>قیمت</th>
                                    <th>شهر</th>
                                    <th>حذف</th>                                   
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <a href="{{route('dashboard.admin.voip.create')}}" class="btn btn-success">ثبت شماره جدید</a>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection