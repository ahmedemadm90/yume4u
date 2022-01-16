@extends('front.members.layouts.user')
@section('title')
{{auth()->user()->name}} || {{trans('سحوباتي')}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('سحوباتي')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('سحوباتي')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered text-capitalize text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Category') }}</th>
                                    <th>{{ trans('Product Name') }}</th>
                                    <th>{{ trans('state') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotteries as $lottery)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $lottery->lottery->product->category->category_name}}</td>
                                    <td>{{ $lottery->lottery->product->name}}</td>
                                    <td>@if ($lottery->lottery->active == 1)
                                        <span class="badge badge-success">{{ trans('Active') }}</span>
                                        @elseif($lottery->lottery->active == 2)
                                        <a class="badge badge-danger"
                                            href="{{route('front.lotteries.view',$lottery->lottery->id)}}">{{ trans('The Lottery Ended, Click Here to Check The Winner') }}</a>
                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $lotteries->render() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
