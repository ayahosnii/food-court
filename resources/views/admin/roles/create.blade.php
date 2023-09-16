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
                                        <form class="form" action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Basic Role Information</h4>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Role Name</label>
                                                        <input type="text" id="name" class="form-control" placeholder="" value="{{ old('name') }}" name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guard_name">Guard Name</label>
                                                        <select id="guard_name" class="form-control" name="guard_name">
                                                            @foreach (config('auth.guards') as $guardName => $guardConfig)
                                                                <option value="{{ $guardName }}" {{ old('guard_name') == $guardName ? 'selected' : '' }}>
                                                                    {{ $guardName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="ft-lock"></i> Role Permissions</h4>
                                                <div class="row">
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-group col-md-4">
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $permission->name }}"> {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('permissions')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
