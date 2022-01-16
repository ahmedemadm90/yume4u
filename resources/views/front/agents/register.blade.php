@extends('layouts.site')
@section('title','التسجيل')
@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-6 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1">
                            <img src="{{asset('assets/images/logo-02-wide.png')}}" width="150" alt="Yume" />
                        </div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>{{ trans('Register New Account') }} </span>
                    </h6>
                </div>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                @include('layouts.errors')
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-vertical form-simple" action="{{route('agent.store')}}" method="post"
                            novalidate>
                            @csrf
                            <input name="active" value=0 type="hidden">
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="name">{{ trans('Name') }}</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name"
                                        placeholder="Name">
                                </div>
                                {{-- If The User Was Invited --}}
                                @if (!empty($user))
                                <input value="{{$user->invitation_code}}" name="code" hidden>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="email">{{ trans('E-Mail') }}</label>
                                    <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email"
                                        placeholder="{{ trans('E-Mail') }}">
                                </div>
                                <div class="form-group col-md">
                                    <label for="mobile">{{ trans('Mobile') }}</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" id="mobile" name="mobile"
                                        placeholder="{{ trans('Mobile') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="password">{{ trans('Password') }}</label>
                                    <input type="password" class="form-control mb-2 mr-sm-2" id="password"
                                        name="password" placeholder="{{ trans('password') }}">
                                </div>
                                <div class="form-group col-md">
                                    <label for="confirm-password">{{ trans('Confirm Password') }}</label>
                                    <input type="password" class="form-control mb-2 mr-sm-2" id="confirm-password"
                                        name="confirm-password" placeholder="{{ trans('Confirm Password') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                                {{ trans('Register') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
