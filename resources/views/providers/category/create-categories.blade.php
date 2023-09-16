@extends('layouts.admin')
@section('content')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> الكوبونات </a>
                                    </li>
                                    <li class="breadcrumb-item active">إضافة كوبون
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- Basic form layout section start -->
                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form"> إضافة كوبون </h4>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
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

                                        <!-- order history start -->
    <section class="order-histry-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="order-history">
                        <div class="branch-form">
                            <h3 class="create">Create A Category</h3>
                            <form action="{{route('providers.categories.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label> صوره القسم </label>
                                    <input type="file" name="image" class="file-upload custom-file-input hidden" id="input_scr" onchange="previewFile()" hidden>
                                    <label class="border-0 mb-0 cursor" for="restaurant-logo">
                                        <img src="{{asset('provider-assets/images/camera-icon.png')}}" id="img_scr" alt="img" class="img-fluid" style="width: 130px; height: 130px">
                                        <span id="img_here"></span>
                                        <img src="{{asset('provider-assets/images/camera-icon.png')}}" id="img_scr" alt="img" class="provider-rest-img d-none" style="width: 130px; height: 130px">

                                        <span class="file-custom"></span>
                                    </label>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> اسم القسم
                                                </label>
                                                <input type="text" id="name"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('name')}}"
                                                       name="name">
                                                @error("name")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> اسم بالرابط
                                                </label>
                                                <input type="text" id="name"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('slug')}}"
                                                       name="slug">
                                                @error("slug")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row hidden" id="cats_list" >
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> اختر القسم الرئيسي
                                                </label>
                                                <select name="parent_id" class="select2 form-control">
                                                    <optgroup label="من فضلك أختر القسم ">
                                                        @if($categories && $categories -> count() > 0)
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category -> id }}">{{$category -> name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error('parent_id')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-1">
                                                <span>الحالة</span>
                                                <input type="checkbox" value="1" name="is_active" id="s6" checked="" hidden />
                                                <label class="slider-v3" for="s6" style="margin-bottom: 9px"></label>

                                                @error("is_active")
                                                <span class="text-danger">{{$message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div>
                                                <input type="radio" name="type" id="radio2" class="radio" value="1"/>
                                                <label for="radio2">قسم رئيسي</label>
                                            </div>
                                            @error("type")
                                            <span class="text-danger">{{$message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <input type="radio" name="type" id="radio3" class="radio" value="2"/>
                                                <label for="radio3">قسم فرعي</label>
                                                @error("type")
                                                <span class="text-danger">{{$message }}</span>
                                                @enderror
                                            </div>



                                            </div>
                                        </div>
                                    </div>


                        <ul class="pro-submit">
                            <li>
                                <button type="submit"  class="btn btn-style1" style="margin: 20px;">Update profile</button>
                            </li>
                        </ul>
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
                            </div>
                        </div>
                    </section>
                    <!-- // Basic form layout section end -->
                </div>
            </div>
        </div>


@stop
@section('script')

        <script>
            $('input:radio[name="type"]').change(
                function(){
                    if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                        $('#cats_list').removeClass('hidden');
                    }else{
                        $('#cats_list').addClass('hidden');
                    }
                });
        </script>
    @stop
