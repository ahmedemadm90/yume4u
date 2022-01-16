@extends('layouts.site')
@section('title','الدخول')
@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">

            <div class="">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <form class="form-horizontal text-center" action="{{route('member.dologin')}}" method="post" novalidate>
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left m-5">
                        <input type="text" name="email" class="form-control form-control-lg input-lg"
                            value="{{old('email')}}" id="email" placeholder="أدخل البريد الالكتروني ">
                        <div class="form-control-position">
                            <i class="ft-user"></i>
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror

                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left m-5">
                        <input type="password" name="password" class="form-control form-control-lg input-lg"
                            id="user-password" placeholder="أدخل كلمة المرور">
                        <div class="form-control-position">
                            <i class="la la-key"></i>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-info btn-lg m-3"><i class="ft-unlock"></i>
                        دخول
                    </button>
                    <div class="text-center">
                        <a href="{{route('member.register')}}" class="">Don't Have Account? Get One!</a>
                    </div>
                </form>
            </div>
            {{-- <form class="form-horizontal form-simple" action="{{route('member.dologin')}}" method="post"
            novalidate>
            @csrf
            <fieldset class="form-group position-relative has-icon-left m-2">
                <input type="text" name="email" class="form-control form-control-lg input-lg" value="{{old('email')}}"
                    id="email" placeholder="أدخل البريد الالكتروني ">
                <div class="form-control-position">
                    <i class="ft-user"></i>
                </div>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </fieldset>
            <fieldset class="form-group position-relative has-icon-left m-2">
                <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password"
                    placeholder="أدخل كلمة المرور">
                <div class="form-control-position">
                    <i class="la la-key"></i>
                </div>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </fieldset>
            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                دخول
            </button>
            <div class="text-center">
                <a href="/register" class="">Don't Have Account? Get One!</a>
            </div>
            </form> --}}
        </div>
    </div>
</section>
@endsection
