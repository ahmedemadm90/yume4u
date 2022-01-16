@extends('layouts.admin')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/select2.min.css">
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/plugins/dropzone.min.css">
    @endpush


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.roles')}}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.includes.alerts.success')
            @include('admin.includes.alerts.errors')

            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <h5 class="card-header">تعديل منتج : {{$product -> name}}</h5>
                    <form action="{{route('admin.products.update',$product -> id)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input name="id" value="{{$product->id}}" type="hidden">
                        
                        <div class="card-body">


                            <div class="form-group">
                                <div class="text-center">
                                <img src='{{asset("media/products/$product->images")}}'  class="height-150" alt="صورة المنتج  ">
                                </div>
                            </div>

                            <div class="form-group">
                                            <label>تعديل صوره المنتج </label>
                                            <label id="images" class="file center-block">
                                                <input type="file" id="file" name="images">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('images')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                    <div class="row">

                        <div class="col-md-6 col-xl-6">

                            <div class="form-group">
                            <label for="category">{{ trans('Category') }}</label>

                            <select id="category_id" class="js-example-basic-single form-control form-control-select2" name="category_id">
                                <option selected>{{ trans('Choose Category') }}</option>
                                @foreach ($categories as $category)
                                    <optgroup label="{{ $category->category_name }}">
                                        @foreach ($category->children as $child)
                                            <option value="{{ $child->id }}" 
                                            @if($child->id == $product->category_id) selected @endif
                                            >
                                            {{ $child->category_name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>


                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="form-group">
                                <label for="category">{{ trans('User') }}</label>

                                <select id="user_id" class="js-example-basic-single form-control form-control-select2" name="user_id">
                                    <option selected>{{ trans('Choose User') }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                        @if($user->id == $product->user_id) selected @endif
                                        >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>
                        <hr>

                            <div class="form-group">
                                <label for="name">{{ trans('إسم المنتج') }}</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$product -> name}}">
                            </div>

                            <div class="form-group">
                                <label for="price">{{ trans('Price') }}</label>
                                <input type="number" name="price" class="form-control" id="price"
                                value="{{$product -> price}}">
                            </div>

                            <div class="form-group">
                                <label for="details">{{ trans('Details') }}</label>
                                <textarea name="details" id="details" class="form-control" rows="6">{{$product -> details}}</textarea>
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
        <script src="{{ asset('dashboard') }}/assets/js/plugins/select2.full.min.js"></script>
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
