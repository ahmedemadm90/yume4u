@extends('layouts.site')
@section('content')
<div class="block-category hidden-sm-down">
    <div class="category-cover">
        <img class="img-fluid"
            src="http://demo.bestprestashoptheme.com/savemart/c/3-category_default/computer-networking.jpg" alt="">
    </div>
    <h1 class="h1">كل السحوبات الفعالة الآن</h1>
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
                    <p>هناك {{App\Models\Lottery::defaultLottery() ->count()}} سحب فعال الآن.</p>
                </div>
            </div>


        </div>

    </div>


    <div id="categories-product">

        <div id="js-product-list">

            <div class="products product_list row grid" data-default-view="grid">







                @foreach ($lotteries as $lottery)
                @foreach (App\Models\Product::where('id',$lottery->product_id)->get() as $product)

                <div class="item  col-lg-4 col-md-6 col-xs-12 text-center no-padding">
                    <div class="product-miniature js-product-miniature item-one" data-id-product="7"
                        data-id-product-attribute="155" itemscope="" itemtype="http://schema.org/Product">
                        <div class="thumbnail-container">

                            <a href="{{route('front.lotteries.view',$lottery->id)}}"
                                class="thumbnail product-thumbnail two-image">
                                @if (isset($product->images))
                                @foreach ($product->images as $image)

                                <img class="img-fluid image-cover" src='{{asset("public/media/products/$image")}}'
                                    alt="" data-full-size-image-url='{{asset("public/media/products/$image")}}'
                                    width="600" height="600">
                                <img class="img-fluid image-secondary" src='{{asset("public/media/products/$image")}}'
                                    alt="" data-full-size-image-url='{{asset("public/media/products/$image")}}'
                                    width="600" height="600">

                                @endforeach
                                @endif

                            </a>
                            <div class="product-flags new">جديد</div>

                        </div>
                        <div class="product-description">
                            <div class="product-groups">

                                <div class="category-title"><a href="#">{{ $product->category_id }}</a></div>

                                <div class="group-reviews">
                                    <div class="product-comments">

                                    </div>

                                    <p class="">
                                        <p class="">
                                            <i class="fa fa-calendar"></i>
                                            ينتهي في: {{ $lottery->end_at }}
                                        </p>

                                        <div class="info-stock ml-auto">
                                            <label class="control-label">الفعالية:</label>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>

                                        </div>
                                </div>


                                <div class="product-title" itemprop="name"> <a
                                        href="{{route('front.lotteries.view',$lottery->id)}}">
                                        {{ \Str::limit($product->name,40) }}

                                    </a></div>

                                <div class="product-group-price">

                                    <div class="product-price-and-shipping">
                                        <span itemprop="price" class="price">سعر التذكرة: {{ $lottery->ticket_price }}
                                            ¥</span>
                                    </div>

                                </div>
                                <div class="product-desc" itemprop="desciption">{{ $product->details }}</div>


                            </div>
                            <div class="product-buttons d-flex justify-content-center" itemprop="offers" itemscope=""
                                itemtype="#">
                                <a href="{{route('front.lotteries.view',$lottery->id)}}"
                                    class="btn btn-danger btn-lg btn-block">
                                    تفاصيل السحب
                                </a>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach








            </div>
        </div>

    </div>


    <div id="js-product-list-bottom">

        <nav class="pagination row justify-content-around">
            <div class="col col-xs-12 col-lg-6 col-md-12">

                <span class="showing">
                    Showing 1-12 of 18 item(s)
                </span>

            </div>
            <div class="col col-xs-12 col-lg-6 col-md-12">

                <ul class="page-list">
                    <li class="current">
                        <a rel="nofollow" href="http://demo.bestprestashoptheme.com/savemart/en/3-computer-networking"
                            class="disabled js-search-link">
                            1
                        </a>
                    </li>
                    <li>
                        <a rel="nofollow"
                            href="http://demo.bestprestashoptheme.com/savemart/en/3-computer-networking?page=2"
                            class="js-search-link">
                            2
                        </a>
                    </li>
                    <li>
                        <a rel="next"
                            href="http://demo.bestprestashoptheme.com/savemart/en/3-computer-networking?page=2"
                            class="next js-search-link">
                            Next
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

    </div>


</section>









@endsection
