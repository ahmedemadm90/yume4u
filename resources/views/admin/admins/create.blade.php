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
                    <h3 class="content-header-title"> إضافة مشرف جديد </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة مشرف جديد
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <h5 class="card-header">إضافة مشرف جديد</h5>
                    <form action="{{route('admin.admins.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">{{ trans('إسم المشرف') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ trans('إسم المشرف') }}">
                            </div>

                            <div class="form-group">
                                <label for="category">{{ trans('Role') }}</label>

                                <select id="role_id" class="js-example-basic-single form-control form-control-select2" name="role_id">
                                    <option selected>{{ trans('Choose Role') }}</option>
                                    @foreach ($roles as $role)
                                        @if($role->id < 4)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="email">{{ trans('الإيميل') }}</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="{{ trans('الإيميل') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ trans('كلمة المرور') }}</label>
                                <input type="text" name="password" class="form-control" id="password"
                                    placeholder="{{ trans('كلمة المرور') }}">
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
