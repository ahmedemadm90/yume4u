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
                <h3 class="content-header-title"> إضافة مستخدم جديد </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> إضافة مستخدم جديد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{-- {{ $title }} --}}</h5>
                @include('layouts.errors')
                <form action="{{route('admin.users.store')}}" enctype="multipart/form-data" method="POST"
                    class="text-capitalize">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="name">{{ trans('User Name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ trans('User Name') }}" value="{{old('name')}}">
                            </div>


                            <div class="form-group col-md">
                                <label for="mobile">{{ trans('User Role') }}</label>
                                <select class="form form-control" name="role_id">
                                    <option class="" disabled hidden selected>Choose User Role</option>
                                    @foreach ($roles as $role)
                                    @if($role->id > 3)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="row">

                            <div class="form-group col-md">
                                <div class="form-floating">
                                    <label for="floatingInput">password</label>
                                    <input type="password" class="form-control" id="floatingInput"
                                        placeholder="user password" name="password">
                                </div>
                            </div>


                            <div class="form-group col-md">
                                <div class="form-floating">
                                    <label for="floatingInput">{{trans('Confirm Password')}}</label>
                                    <input type="password" class="form-control" id="floatingInput"
                                        placeholder="confirm-password" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        <div class="form-group col-md">
                                <label for="price">{{ trans('E-Mail') }}</label>
                                <input type="email" name="email" class="form-control" id="price"
                                    placeholder="{{ trans('E-Mail') }}" value="{{old('email')}}">
                            </div>

                        
                            <div class="form-group col-md">
                                <label for="mobile">{{ trans('Mobile') }}</label>
                                <input type="number" name="mobile" class="form-control" id="price"
                                    placeholder="{{ trans('Mobile') }}" value="{{old('mobile')}}">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="image" class="btn btn-primary">{{ trans('User Image') }}</label>
                            <input type="file" name="image" hidden id="image">
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
@endsection
