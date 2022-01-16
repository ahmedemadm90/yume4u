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
                            <li class="breadcrumb-item"><a href="{{route('admin.lotteries')}}"> السحوبات </a>
                            </li>
                            <li class="breadcrumb-item active">تعديل سحب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ trans('تعديل بيانات سحب') }}</h5>
                <form action="{{route('admin.lotteries.update',$lotteries->id)}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_id">{{ trans('منتج') }}</label>
                            <select id="product_id" class="js-example-basic-single form-control form-control-select2"
                                name="product_id">
                                <option selected disabled hidden>{{ trans('إختر منتج') }}</option>
                                @foreach ($products as $product)
                                <option @if($lotteries -> product_id == $product->id ) selected
                                    @endif
                                    label="{{ $product->name }}" value="{{ $product->id }}">
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="ticket_price">{{ trans('سعر التذكرة') }}</label>
                            <input type="text" name="ticket_price" class="form-control" id="ticket_price"
                                value="{{$lotteries -> ticket_price}}" placeholder="{{ trans('سعر التذكرة') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group mt-1">
                                    <label for="start_at">{{ trans('يبدأ في: ').$lotteries -> start_at}} </label>
                                    <input type="datetime" name="start_at" class="form-control" id="start_at"
                                        value="{{$lotteries -> start_at}}" placeholder="{{ trans('يبدأ في') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mt-1">
                                    <label for="end_at">{{ trans('ينتهي في').$lotteries -> end_at }}</label>
                                    <input type="datetime" name="end_at" class="form-control" id="end_at"
                                        value="{{$lotteries -> end_at}}" placeholder="{{ trans('ينتهي في') }}">
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-1">
                                    <input type="checkbox" value="1" name="active" id="switcheryColor4"
                                        class="switchery" data-color="success" @if ($lotteries->active ==1) checked
                                    @endif />
                                    <label for="switcheryColor4" class="card-title ml-1">الحالة</label>

                                    @error("lottery.active")
                                    <span class="text-danger"> </span>
                                    @enderror
                                </div>
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
