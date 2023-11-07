@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item active"> أضافه وظيفة
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
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

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.store.meal.raw.material') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="meal_id" value="{{ $meal->id }}">


                                            <div class="form-body">

                                                <div id="activities-container">
                                                    <h2>Add {{$meal->name}} Ingredients</h2>
                                                    <!-- Update the dynamic activity input field -->
                                                    @if(old('activities'))
                                                        @foreach(old('activities') as $activity)
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <select type="text" class="form-control" name="activities[]" required>
                                                                        <option></option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="activities[]" required> <!-- Add 'required' attribute -->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mt-2">
                                                                        <button type="button" class="btn btn-danger remove-activity">Remove</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="raw_material_id">Select a Raw Material:</label>
                                                                    <select id="raw_material_id" name="raw_material_id" class="form-control" required>
                                                                        @foreach ($rawMaterials as $rawMaterial)
                                                                            <option value="{{ $rawMaterial->id }}">{{ $rawMaterial->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input type="number" name="quantity" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="unit">Select a Weight Unit:</label>
                                                                    <select id="unit" name="unit" class="form-control" required>
                                                                        <option value="grams">Grams (g)</option>
                                                                        <option value="kilograms">Kilograms (kg)</option>
                                                                        <option value="ounces">Ounces (oz)</option>
                                                                        <option value="pounds">Pounds (lb)</option>
                                                                        <option value="milligrams">Milligrams (mg)</option>
                                                                        <option value="micrograms">Micrograms (µg)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mt-1">
                                                                <div class="col-md-3">
                                                                    <button type="button" class="btn btn-success add-activity">اضف المزيد</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endif
                                                </div>

                                                @error('activities.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> إضافة
                                                </button>
                                            </div>
                                        </form>
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
        $(document).ready(function() {
            // Function to add a new activity input field
            function addActivityInput() {
                var activityInput = `
        <div class="row" id="activity-input">
            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="unit">Select a Weight Unit:</label>
                                                                    <select id="unit" name="unit" class="form-control">
                                                                        @foreach($rawMaterials as $rawMaterial)
                <option value="{{$rawMaterial->id}}">{{$rawMaterial->name}}</option>
                                                                        @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="projectinput1"> quantity</label>
                <input type="number" class="form-control" name="activities[]">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="unit">Select a Weight Unit:</label>
                <select id="unit" name="unit" class="form-control">
                    <option value="grams">Grams (g)</option>
                    <option value="kilograms">Kilograms (kg)</option>
                    <option value="ounces">Ounces (oz)</option>
                    <option value="pounds">Pounds (lb)</option>
                    <option value="milligrams">Milligrams (mg)</option>
                    <option value="micrograms">Micrograms (µg)</option>
                </select>
            </div>
        </div>
<div class="col-md-4">
<div class="form-group mt-2">
<button type="button" class="btn btn-danger remove-activity">X</button>
</div>
</div>
</div>
`;

                $('#activities-container').append(activityInput);
            }

            // Add Activity button click event
            $('.add-activity').click(function() {
                addActivityInput();
            });



            // Remove Activity button click event
            $(document).on('click', '.remove-activity', function() {
                $(this).closest('#activity-input').remove();
            });
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/2hiuvs7pfrjea2zdpl7ldavojp466ihbpx4p57jxkzrr6osc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
