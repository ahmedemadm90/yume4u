@extends('layouts.agent')
@section('title')
{{auth()->user()->name}} || {{__('Balance Recharge')}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> شحن رصيد </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $title }}
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
                <form action="{{route('agent.user.confirm')}}" method="POST" class="text-center">
                    @csrf
                    @include('admin.includes.alerts.errors')
                    @include('admin.includes.alerts.success')
                    <div class="card-body">
                        <p class="text-danger">{{ trans('برجاء التأكد من معرف المستخدم المراد تحويل الرصيد الية') }}</p>
                        <p class="text-danger">{{ trans('الرصيد المحول غير قابل للاسترجاع') }}</p>
                        <div class="row">
                            <input class="form-control m-2" id="user_id" name="user_id"
                                placeholder="{{ trans('كود دعوة المستخدم') }}" required>
                        </div>
                        <div class="row">

                            <input class="form-control m-2" id="points" name="points" type="number"
                                placeholder="{{ trans('النقاط') }}" required>
                        </div>
                        <hr>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary">{{ trans('شحن') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
