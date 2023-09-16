@extends('layouts.admin')

@section('content')
    @extends('layouts.admin')

    @section('content')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">الرئيسية</a></li>
                                    <li class="breadcrumb-item"><a href="">الصلاحيات</a></li>
                                    <li class="breadcrumb-item active">أضافة صلاحية جديدة</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form">أضافة صلاحية جديدة</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @include('admin.includes.alerts.success')
                                    @include('admin.includes.alerts.errors')
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <h2>Assign Role to User</h2>
                                            <form action="{{ route('admin.assign-role') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="user">Select User:</label>
                                                    <select name="user" id="user" class="form-control">
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Select Role:</label>
                                                    <select name="role" id="role" class="form-control">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Assign Role</button>
                                            </form>                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @endsection
@endsection
