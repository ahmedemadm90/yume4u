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
                <h3 class="content-header-title"> {{ trans('عرض بيانات الوكيل') }} || <span
                        class="text-danger">{{$user->name}}</span> </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{ trans('عرض بيانات وكيل') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <p class="text-center text-xl-center">بطاقة بيانات الوكيل</p>
                <div class="card m-auto" style="width: 18rem;">
                    <img src="{{asset("media/users/$user->image")}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-md-right">Title : Agent</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-md-right text-capitalize">ID : {{$user->id}}</li>
                        <li class="list-group-item text-md-right text-capitalize">Name : {{$user->name}}</li>
                        <li class="list-group-item text-md-right text-capitalize">invitation code :
                            {{$user->invitation_code}}
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>{{ trans('Product') }}</th>
                                    <th>{{ trans('Ticket price') }}</th>
                                    <th>{{ trans('Start at') }}</th>
                                    <th>{{ trans('End at') }}</th>
                                    <th>{{ trans('Active') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotteries as $lottery)
                                <tr>

                                    <td>{{ $lottery->product->name }}</td>
                                    <td>{{ $lottery->ticket_price }}</td>
                                    <td>{{ $lottery->start_at }}</td>
                                    <td>{{ $lottery->end_at }}</td>
                                    <td>
                                        @if ($lottery->active==1)
                                        <span class="badge badge-success">active</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>

</div>
@endsection
