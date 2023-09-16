@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <!-- ... (header and breadcrumb code) ... -->
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">تعديل صلاحية</h4>
                                    <!-- ... (heading elements and buttons) ... -->
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Use the PUT method for updating -->
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> Basic Role Information</h4>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Role Name</label>
                                                        <input type="text" id="name" class="form-control" placeholder="" value="{{ $role->name }}" name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="guard_name">Guard Name</label>
                                                        <select id="guard_name" class="form-control" name="guard_name">
                                                            @foreach (config('auth.guards') as $guardName => $guardConfig)
                                                                <option value="{{ $guardName }}" {{ $role->guard_name == $guardName ? 'selected' : '' }}>
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
                                                                <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, $role->permissions->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                                {{ $permission->name }}
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
                                                    <i class="la la-check-square-o"></i> Update
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
