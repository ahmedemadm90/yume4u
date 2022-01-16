@extends('layouts.site')

@section('content')
<h1>{{$category->category_name}} || {{$category->id}}</h1>
<div class="content-wrapper">
    {{-- Start Sub Category Div --}}
    @if (!empty($category->children))
    <div class="row m-auto">
        @foreach ($category->children as $child)
        <div class="m-auto text-center m-2" style="width: 20rem;">
            <a href="{{route('front.category',$child->id)}}" class=""><img
                    src='{{asset("media/categories/$child->category_img")}}' class="rounded-circle"
                    style="width: 10rem;height:10rem; ">
            </a>
            <div class="card-body">
                <img class="" src='{{asset("media/categories/$child->image")}}'>
                <img class="" src='{{asset("public/media/products/".$lottery->product->image)}}'>

                <h5 class="card-title m-2">{{$child->category_name}}</h5>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    {{-- End Sub Category Div --}}
    {{-- {{var_dump($lotteries)}} --}}
    {{-- Start Lotteries of Category --}}
    <div class="row">
        @if ($lotteries)
        @foreach ($lotteries as $lottery)
        <div class="col-md-3">
            <div class="card text-center" style="width: 18rem;">
                @foreach ($lottery->product->images as $image)
                <img src='{{asset("media/products/$image")}}' class="card-img-top" alt="">
                @endforeach
                <div class="card-body">
                    <h5 class="card-title">{{$lottery->product->name}}</h5>
                    <p class="card-text">{{$lottery->ticket_price}} Y</p>
                    <a href='{{route('front.lotteries.view',$lottery->id)}}'
                        class="btn btn-primary">{{ trans('تفاصيل السحب') }}</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    {{-- End Lotteries of Category --}}
</div>

@endsection
