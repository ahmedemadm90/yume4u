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
                <h3 class="content-header-title"> إضافة صورة الفائز لسحب منتهي </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> إضافة صورة الفائز لسحب منتهي
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.alerts.errors')
        @include('admin.includes.alerts.success')
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">إضافة سحب جديد</h5>
                @include('layouts.errors')
                <form action="{{route('admin.winner.imageupload')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <select class="form-control" name="lottery_id">
                                <option disabled hidden selected>{{ trans('اختار السحب') }}</option>
                                @foreach ($lotteries as $lottery)
                                <option value="{{$lottery->id}}">{{$lottery->product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-2">
                            <input type="file" id="winner_image" hidden required name="gallery[]" multiple>
                            <label for="winner_image" class="btn btn-primary">{{ trans('صورة الفائز') }}</label>
                        </div>
                        <div class="row mt-2">
                            <input type="text" id="winner_image" class="form-control" name="video"
                                placeholder="Winner Video Url">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary">{{ trans('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
