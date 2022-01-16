@extends('front.members.layouts.user')
@section('title')
{{auth()->user()->name}} || {{__('عمليات الشحن')}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> عملياتي </h3>
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



        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('جميع عملياتي') }}</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered text-capitalize text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Agent Name') }}</th>
                                    <th>{{ trans('Points') }}</th>
                                    <th>{{ trans('state') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    {{-- {{dd($transaction)}} --}}
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $transaction->agent->name}}</td>
                                    <td>{{ $transaction->points }}</td>
                                    <td>{{$transaction->created_at}}</td>
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
