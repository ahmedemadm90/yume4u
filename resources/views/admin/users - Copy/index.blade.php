@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> المستخدمين </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> المستخدمين
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>كل المستخدمين</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Name') }}</th>
                                    <th>{{ trans('Email ') }}</th>
                                    <th>{{ trans('Mobile') }}</th>
                                    <th>{{ trans('wallet') }}</th>
                                    <th>{{ trans('active') }}</th>
                                    <th>{{ trans('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->wallet }}</td>
                                    <td>{{ $user->active }}</td>
                                    <td>
                                        <a href="{{ 'users/edit/' . $user->id }}" class="btn btn-info"><i
                                                data-feather="edit"></i>
                                            {{ trans('Edit') }}</a>

                                        <a href="{{route('admin.users.delete',$user->id)}}"
                                            data-id="{{ $user->id }}" data-title="{{ $user->name }}"
                                            data-image="{{ $user->image }}" id="delete" class="btn btn-danger"><i
                                                data-feather="trash"></i>
                                            {{ trans('Delete') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->render() }}
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
