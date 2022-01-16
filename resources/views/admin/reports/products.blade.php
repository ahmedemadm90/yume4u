@extends('layouts.admin')
@section('title')
{{$title}}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> المنتجات </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> {{$title}}
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
                    <h5>{{$title}}</h5>
                    <button class="btn btn-primary" id="print">Print</button>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="print_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Image') }}</th>
                                    <th>{{ trans('Name') }}</th>
                                    <th>{{ trans('Price') }}</th>
                                    <th>{{ trans('Category') }}</th>
                                    <th>{{ trans('User') }}</th>
                                    <th>{{ trans('Since') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <div class="">
                                            @if (isset($product->main_img))
                                            <img style="width: 60px; height: 40px;"
                                                src='{{asset("media/products/$product->main_img")}}'>
                                            @endif
                                        </div>

                                    </td>
                                    <td>{{ \Str::limit($product->name,30) }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->user->name}}</td>
                                    <td>{{ $product->time_ago }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->render() }}
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
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('#print').click(function(){
    /* $('#print_table').print; */
    $('#print_table').print();
    });
    });

</script>
@endsection
