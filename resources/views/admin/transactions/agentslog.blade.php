@extends('layouts.admin')
@section('title')
{{auth()->user()->name}} || {{trans('جميع عمليات الشحن')}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('جميع عمليات الشحن')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('جميع عمليات الشحن')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('جميع عمليات الشحن') }}</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered text-capitalize text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Agent Name') }}</th>
                                    <th>{{ trans('User Name') }}</th>
                                    <th>{{ trans('Points') }}</th>
                                    <th>{{ trans('state') }}</th>
                                    <th>{{ trans('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    {{-- {{dd($transaction)}} --}}
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $transaction->agent->name}}</td>
                                    <td>{{ $transaction->user->name}}</td>
                                    <td>{{ $transaction->points }}</td>
                                    <td>@if ($transaction->state =='pindding')
                                        <span class="badge badge-info">{{$transaction->state}}</span>
                                        @else
                                        <span class="badge badge-success">{{$transaction->state}}</span>
                                        @endif
                                    </td>
                                    <td>@if ($transaction->state !='settled')
                                        <a class="btn btn-success"
                                            href="{{route('admin.transaction.changestate',$transaction->id)}}">{{__('تسوية المعاملة')}}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->render() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
