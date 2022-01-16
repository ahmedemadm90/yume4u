{{-- @extends('layouts.agent')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/select2.min.css">
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/dropzone.min.css">
@endpush


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> إضافة منتج جديد </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> إضافة منتج جديد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                @include('layouts.errors')
                <form action="{{route('agent.products.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="category">{{ trans('Category') }}</label>

                                    <select id="category_id"
                                        class="js-example-basic-single form-control form-control-select2"
                                        name="category_id">
                                        <option selected hidden disabled>{{ trans('Choose Category') }}</option>
                                        @foreach ($categories as $category)
                                        <optgroup label="{{ $category->category_name }}">
                                            @foreach ($category->children as $child)
                                            <option value="{{ $child->id }}">{{ $child->category_name }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="category">{{ trans('User') }}</label>
                                    <input class="form-control" value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="name">{{ trans('Product Name') }}</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="{{ trans('Product Name') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('Price') }}</label>
                            <input type="number" name="price" class="form-control" id="price"
                                placeholder="{{ trans('Price') }}">
                        </div>
                        <div class="form-group">
                            <label for="details">{{ trans('Details') }}</label>
                            <textarea name="details" id="details" class="form-control" rows="6"
                                placeholder="{{ trans('Details') }}"></textarea>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md m-2">
                            <label for="images" class="btn btn-primary">{{trans('Product Image')}}</label>
                            <input class="form-control" type="file" id="images" name="main_img" style="display: none">
                        </div>
                        <div class="col-md m-2">
                            <label for="gallery" class="btn btn-info">{{ trans('Product Gallery Images') }} </label>
                            <input class="form-control" type="file" id="gallery" name="gallery[]" style="display: none"
                                multiple>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary"><i
                                class="feather mr-2 icon-thumbs-up"></i>&nbsp;{{ trans('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@push('script')
<script src="{{ asset('assets/js/forms/select2.full.min.js') }}"></script>
<script src="{{ asset('dashboard') }}/assets/js/pages/form-select-custom.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/plugins/dropzone-amd-module.min.js"></script>
<script>
    $(document).ready(function() {
                $("#imagesBtn").click(function() {
                    $("#images").click();
                });
            });

            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                    placeToInsertImagePreview);
                            }
                            reader.readAsDataURL(input.files[i]);

                        }
                    }
                };

                $('#images').on('change', function() {
                    $("div.img-box").empty();
                    imagesPreview(this, 'div.img-box');
                });
            });

</script>
@endpush
@endsection
--}}
@extends('layouts.agent')
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/select2.min.css">
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/dropzone.min.css">
@endpush


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> إضافة منتج جديد </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> إضافة منتج جديد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>
                @include('layouts.errors')
                <form action="{{route('agent.products.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="category">{{ trans('القسم') }}</label>

                                    <select id="category_id"
                                        class="js-example-basic-single form-control form-control-select2"
                                        name="category_id">
                                        <option selected hidden disabled>{{ trans('أختر قسم') }}</option>
                                        @foreach ($categories as $category)
                                        <optgroup label="{{ $category->category_name }}">
                                            @foreach ($category->children as $child)
                                            <option value="{{ $child->id }}">{{ $child->category_name }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="form-group">
                                    <label for="category">{{ trans('الوكيل') }}</label>
                                    <input class="form-control" value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="name">{{ trans('إسم المنتج') }}</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="{{ trans('إسم المنتج') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('السعر باليومي') }}</label>
                            <input type="number" name="price" class="form-control" id="price"
                                placeholder="{{ trans('السعر باليومي') }}">
                        </div>
                        <div class="form-group">
                            <label for="details">{{ trans('تفاصيل المنتج') }}</label>
                            <textarea name="details" id="details" class="form-control" rows="6"
                                placeholder="{{ trans('تفاصيل المنتج') }}"></textarea>
                        </div>



                        <div class="row">
                            <div class="m-2">
                                <label for="main_img" class="btn btn-primary">Main Image</label>
                                <input class="form-control" type="file" id="main_img" name="image"
                                    style="display: none">
                            </div>
                            <div class="m-2">
                                <label for="images" class="btn btn-info">Product Gallery Images</label>
                                <input class="form-control" type="file" id="images" name="gallery[]"
                                    style="display: none" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary"><i
                                class="feather mr-2 icon-thumbs-up"></i>&nbsp;{{ trans('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@push('script')
<script src="{{ asset('assets/js/forms/select2.full.min.js') }}"></script>
<script src="{{ asset('dashboard') }}/assets/js/pages/form-select-custom.js"></script>
<script src="{{ asset('dashboard') }}/assets/js/plugins/dropzone-amd-module.min.js"></script>
<script>
    $(document).ready(function() {
                $("#imagesBtn").click(function() {
                    $("#images").click();
                });
            });

            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                    placeToInsertImagePreview);
                            }
                            reader.readAsDataURL(input.files[i]);

                        }
                    }
                };

                $('#images').on('change', function() {
                    $("div.img-box").empty();
                    imagesPreview(this, 'div.img-box');
                });
            });

</script>
@endpush
@endsection
