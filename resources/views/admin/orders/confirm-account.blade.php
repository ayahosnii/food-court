@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.languages') }}">الكوبونات</a></li>
                                <li class="breadcrumb-item active">Add Raw Material</li>
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
                                    <h4 class="card-title" id="basic-layout-form">إضافة مادة خام</h4>
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
                                        <form class="form" action="{{ route('admin.orders.confirm.account.post') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>Confirm the account {{$id}}</h4>
                                                <div class="col-md-12" >
                                                    <label for="orderId">Order ID</label>
                                                    <input readonly type="text" name="orderId" value="{{$id}}" class="form-control">
                                                    @error('orderId')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @foreach($rawMaterials as $r)

                                                <div class="row my-3" style="background-color: #f4f5fa; padding: 3px">
                                                    @foreach($r->mealRawMaterials as $mealRawMaterials)
                                                        <h4>{{$r->name}} Of  {{\App\Models\providers\Meal::where('id', $mealRawMaterials->meal_id)->first()->name}}</h4>
                                                        @php
                                                            $totalDeduction = 0;
                                                            $unit = $mealRawMaterials->unit
                                                        @endphp
                                                        <div class="col-md-12">
                                                            <label for="deductiveWeight">Deductive weight in <span class="text-danger">{{$mealRawMaterials->unit}}</span></label>
                                                            <input type="text" value="{{$mealRawMaterials->quantity}}" class="form-control deductive-weight" data-raw-material-id="{{$r->id}}" data-unit="{{$r->unit}}">
                                                            @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            @php
                                                                $totalDeduction += $mealRawMaterials->quantity;
                                                            @endphp
                                                                @endforeach
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="totalWeightAfterDeduction">Total weight After deduction in <span class="text-warning">{{$r->unit}}</span></label>
                                                    <input readonly type="text" value="{{$r->inventory->total_weight}}" id="totalWeight" class="form-control totalWeight" data-raw-material-id="{{$r->id}}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                 </div>
                                                    @if($unit == $r->unit)
                                                            <div class="col-md-6">
                                                                <label for="price">Total weight After deduction in <span class="text-warning">{{$r->unit}}</span></label>
                                                                <input readonly type="text" data-raw-material-id="{{$r->id}}" class="form-control total-weight-after-deduction" value="" name="new_total_weight[]">
                                                                @error('new_total_weight')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                     @else

                                                    @endif

                                                        <div class="col-md-12" style="display: none">
                                                            <label for="rawMaterial">Raw Material ID</label>
                                                            <input readonly type="text" name="rawMaterialId[]" value="{{$r->id}}" class="form-control">
                                                            @error('rawMaterialId')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                </div>
                                                            @endforeach




                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Confirm the account
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
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.deductive-weight').each(function() {
                const rawMaterialId = $(this).data('raw-material-id');
                const unit = $(this).data('unit');
                const deductiveWeight = parseFloat($(this).val());

                if (!isNaN(deductiveWeight)) {
                    const totalWeightAfterDeductionElement = $('.total-weight-after-deduction[data-raw-material-id="' + rawMaterialId + '"]');
                    const totalWeight = $('#totalWeight[data-raw-material-id="' + rawMaterialId + '"]');
                    const theDeductiveWeight = $('.deductive-weight[data-raw-material-id="' + rawMaterialId + '"]');
                    const initialTotalWeight = parseFloat(totalWeight.val());

                    // Debugging output
                    console.log("Deductive Weight:", deductiveWeight);
                    console.log("Initial Total Weight:", initialTotalWeight);

                    totalWeightAfterDeductionElement.val(initialTotalWeight - deductiveWeight);

                    $(this).on("input", function() {
                        const deductiveWeight = parseFloat($(this).val());
                        if (!isNaN(deductiveWeight)) {
                            totalWeightAfterDeductionElement.val(initialTotalWeight - deductiveWeight);
                        } else {
                            totalWeightAfterDeductionElement.val(initialTotalWeight);
                        }
                    });
                }
            });
        });



    </script>

@endsection
