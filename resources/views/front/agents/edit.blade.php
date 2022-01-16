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
                <h3 class="content-header-title"> {{ trans('تعديل بياناتي') }} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{ trans('تعديل بياناتي') }}
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
                <form action="{{route('agent.update.myinfo',$agent->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        @include('admin.includes.alerts.success')
                        @include('admin.includes.alerts.errors')
                        <div class="card-body">
                            <div class="row text-center">
                                <img class="img card-img-top m-auto" src='{{asset("media/users/$agent->image")}}'
                                    style=" width: 100px">
                            </div>
                            <div class="row m-2">
                                <input class="hidden" type="file" id="image" name="image">
                                <label for="image" class="btn btn-primary m-auto">{{ trans('تحديث الصورة') }}</label>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="category">{{ trans('ألاسم') }}</label>
                                        <input class="form-control" value="{{$agent->name}}" name="name">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="name">{{ trans('البريد الالكتروني') }}</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="{{ trans('البريد الالكتروني') }}" value="{{$agent->email}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('كلمة المرور') }}</label>
                                <input type="password" name="password" class="form-control" id="name"
                                    placeholder="{{ trans('كلمة المرور') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('تأكيد كلمة المرور') }}</label>
                                <input type="password" name="confirm-password" class="form-control" id="name"
                                    placeholder="{{ trans('تأكيد كلمة المرور') }}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{ trans('رقم التليفون') }}</label>
                                <input type="number" name="mobile" class="form-control" id="price"
                                    placeholder="{{ trans('رقم التليفون') }}" value="{{$agent->mobile}}">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-primary">{{ trans('تحديث') }}</button>
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
