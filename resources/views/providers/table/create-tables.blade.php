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

                                   <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                                        <form method="POST" action="{{ route('providers.tables.store') }}">
                                        @csrf
                                        <div class="sm:col-span-6">
                                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                            <div class="mt-1">
                                                <input type="text" id="name" name="name"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </div>
                                            @error('name')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6">
                                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                            </label>
                                            <div class="mt-1">
                                                <input type="number" id="guest_number" name="guest_number"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                            </div>
                                            @error('guest_number')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 pt-5">
                                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                            <div class="mt-1">
                                                <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                                    @foreach (App\Enums\TableStatus::status() as $key => $status)
                                                        <option value="{{ $key }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('status')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 pt-5">
                                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                            <div class="mt-1">
                                                <select id="location" name="location" class="form-multiselect block w-full mt-1">
                                                    @foreach (App\Enums\TableLocation::locations() as $key => $location)
                                                        <option value="{{ $key }}">{{ $location }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('location')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-6 p-4">
                                            <button type="submit"
                                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Store</button>
                                        </div>
                                    </form>
                                   </div>

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

{{--
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
                                </li>

                                </ul>
                                <ul class="pro-submit">
                                    <li>


                                        <button type="submit"  class="btn btn-style1">Update profile</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- order history end -->
    @stop
--}}
