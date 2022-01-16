@extends('layouts.site')
@section('content')
<div class="block-category hidden-sm-down">
    <div class="category-cover">
        <img class="img-fluid"
            src="http://demo.bestprestashoptheme.com/savemart/c/3-category_default/computer-networking.jpg" alt="">
    </div>
    <h1 class="h1">السحوبات المنتهية</h1>
</div>
<section id="products">
    <div id="nav-top">
        <div id="js-product-list-top" class="row products-selection">
            <div class="col-md-6 col-xs-6">
                <div class="change-type">
                    <span class="grid-type active" data-view-type="grid"><i class="fa fa-th-large"></i></span>
                    <span class="list-type" data-view-type="list"><i class="fa fa-bars"></i></span>
                </div>
                <div class="hidden-sm-down total-products">
                    <p>هناك {{App\Models\Lottery::where('active',2) ->count()}} سحب انتهي بالفعل.</p>
                </div>
            </div>
        </div>
    </div>
    @foreach ($lotteries as $lottery)
    <div class="product-miniature js-product-miniature item-one row" data-id-product="7" data-id-product-attribute="155"
        itemscope="" itemtype="http://schema.org/Product">
        <div class="thumbnail-container col-md-4 col-sm-4">

            <a href='{{route('front.lotteries.view',$lottery->id)}}' class="thumbnail product-thumbnail">

                <img class="img-fluid image-cover" src="{{asset("media/products/".$lottery->product->image)}}"
                    alt="Product Image" width="250" height="250">

            </a>

        </div>
        <div class="product-description col-md-8 col-sm-8">
            <div class="product-groups">
                <div class="category-title"><a href="#">{{$lottery->ticket_price}}</a></div>
            </div>
            <div class="product-title" itemprop="name"> <a href='{{route('front.lotteries.view',    $lottery->id)}}'>
                    <h1> {{$lottery->product->name}} </h1>
                </a></div>

            <div class="product-group-price">
                <div class="product-price-and-shipping">
                    <span itemprop="price" class="price">سعر التذكرة: {{$lottery->ticket_price}} ¥</span>
                </div>
            </div>
            <div class="product-group-price">
                <p class="">قسم:
                    <b><a href={{route('front.category',$lottery->product->category->id)}}>
                            {{$lottery->product->category->category_name}}</a></b>
                </p>
            </div>
            <div class="product-group-price">
                <p class="">الفائز:
                    <b>{{$lottery->winner->name}}</b>
                </p>
            </div>
            <div class="product-desc" itemprop="desciption">{{$lottery->product->details}}
            </div>
        </div>
        <div class="product-buttons d-flex m-auto" itemprop="offers" itemscope="" itemtype="#">
            <a href='{{route('front.lotteries.view',$lottery->id)}}' class="btn btn-danger btn-lg btn-block">
                تفاصيل السحب
            </a>
        </div>
    </div>
    </div>
    @endforeach

    </div>
    </div>
    </div>
    </div>
</section>
@endsection
