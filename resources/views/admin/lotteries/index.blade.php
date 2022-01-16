@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> السحوبات </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> السحوبات
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        @include('admin.includes.alerts.success')
        @include('admin.includes.alerts.errors')
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>جميع السحوبات</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>{{ trans('Product') }}</th>
                                    <th>{{ trans('Ticket price') }}</th>
                                    <th>{{ trans('Start at') }}</th>
                                    <th>{{ trans('End at') }}</th>
                                    <th>{{ trans('Active') }}</th>
                                    <th>{{ trans('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotteries as $lottery)
                                <tr>
                                    <td>{{ $lottery->id }}</td>
                                    <td>{{ $lottery->product->name }}</td>
                                    <td>{{ $lottery->ticket_price }}</td>
                                    <td>{{ $lottery->start_at }}</td>
                                    <td>{{ $lottery->end_at }}</td>
                                    <td>
                                        @if ($lottery->active == 1)
                                        <span class="badge badge-success">active</span>
                                        @else
                                        <span class="badge badge-danger">disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ 'lotteries/edit/' . $lottery->id }}"
                                            class="btn btn-info btn-min-width box-shadow-3 mt-1 mb-1"><i
                                                data-feather="edit">
                                                {{ trans('تعديل') }}</a><br>
                                        <a href="{{route('admin.lotteries.delete',$lottery -> id)}}"
                                            class="btn btn-danger btn-min-width box-shadow-3 mt-1 mb-1">{{ trans('حذف') }}</a><br>
                                        @if ($lottery->active == 2)
                                        <a href="{{route('admin.winner.image',$lottery->id)}}"
                                            class="btn btn-danger btn-min-width box-shadow-3 mt-1 mb-1">{{ trans('صورة الفائز') }}</a>
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








        <div class="modal animated fadeInUp custo-fadeInUp" id="deleteModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans('Delete') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ 'products/delete' }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12 text-center">
                                <img src="" id="productImage" class="img-thumbnail" style="height:70px" alt="">
                                <p style="margin-top: 10px" class="text-info" id="productTitle"></p>
                            </div>
                            <input type="hidden" id="product_id" name="id" value="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                {{ trans('Close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {
                $("#delete ").click(function() {
                    var productImage = $(this).attr('data-image');
                    var productTitle = $(this).attr('data-title');
                    var productId = $(this).attr('data-id');
                    $("#productImage").attr('src', productImage);
                    $("#productTitle").text(productTitle);
                    $("#product_id").val(productId);
                    $("#deleteModal").modal('show');
                });
            });

</script>
@endpush
@endsection
