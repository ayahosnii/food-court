@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Form for Why Choose Our Restaurant -->
                <section id="why-choose-restaurant-form">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('providers.add_why_choose_our_restaurant')</h4>
                                </div>
                                <!-- Form Start -->
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('why-choose-restaurant.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section">@lang('providers.add_why_choose_our_restaurant')</h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="title">@lang('providers.title')</label>
                                                            <input type="text" id="title" class="form-control" name="title" placeholder="@lang('providers.enter_title')">
                                                            @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description">@lang('providers.description')</label>
                                                            <textarea id="description" class="form-control" name="description" placeholder="@lang('providers.enter_description')"></textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">@lang('providers.cancel')</button>
                                                <button type="submit" class="btn btn-primary">@lang('providers.save')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Form End -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Form for Why Choose Our Restaurant -->
            </div>
        </div>
    </div>
@endsection
