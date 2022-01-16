@extends('layouts.agent')
@section('title')
{{auth()->user()->name}} || {{__('السحوبات المنتهية')}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> {{trans('السحوبات المنتهية')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('السحوبات المنتهية')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{trans('السحوبات المنتهية')}}</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered text-capitalize text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('صورة المنتج') }}</th>
                                    <th>{{ trans('اسم المنتج') }}</th>
                                    <th>{{ trans('السعر') }}</th>
                                    <th>{{ trans('عدد المشاركين') }}</th>
                                    <th>{{ trans('تاريخ الانتهاء') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotteries as $lottery)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <img src='{{ asset("media/products/".$lottery->product->image)}}'
                                            style="width: 100px">
                                    </td>
                                    <td>{{ $lottery->product->name }}</td>
                                    <td>{{ $lottery->ticket_price }}</td>
                                    <td>{{App\Models\User_Lotteries::where('lottery_id',$lottery->id)->count()}}
                                    </td>
                                    <td>{{$lottery->end_at}}
                                    </td>
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
