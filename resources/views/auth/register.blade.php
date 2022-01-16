@extends('layouts.site')
@section('title','التسجيل')
@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-6 col-10 box-shadow-2 p-0">
            <div class="">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                @include('layouts.errors')
                <form class="" action="{{route('member.store')}}" method="post" novalidate>
                    @csrf
                    <div class="img card-img-top text-center">
                        <img src="{{asset('assets/images/logo-02-wide.png')}}" class="w-25">
                    </div>
                    <div class="row">
                        <div class="form-group col-md">
                            <label for="name">{{ trans('Name') }}</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name"
                                placeholder="Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md">
                            <label for="email">{{ trans('E-Mail') }}</label>
                            <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email"
                                placeholder="{{ trans('E-Mail') }}">
                        </div>
                        <div class="form-group col-md">
                            <label for="mobile">{{ trans('Mobile') }}</label>
                            <input type="number" class="form-control mb-2 mr-sm-2" id="mobile" name="mobile"
                                placeholder="{{ trans('Mobile') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md">
                            <label for="password">{{ trans('Password') }}</label>
                            <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password"
                                placeholder="{{ trans('password') }}">
                        </div>
                        <div class="form-group col-md">
                            <label for="confirm-password">{{ trans('Confirm Password') }}</label>
                            <input type="password" class="form-control mb-2 mr-sm-2" id="confirm_password"
                                name="confirm_password" placeholder="{{ trans('Confirm Password') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md">
                            <label for="code">{{ trans('Invitaion Code') }}</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="code" name="code"
                                placeholder="{{ trans('Invitaion Code') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                        {{ trans('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
