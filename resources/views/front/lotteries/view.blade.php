@extends('layouts.site')
@section('content')
<hr>
<div id="wrapper-site">
    <div class="no-index">
        <div id="content-wrapper">
            <section id="main" itemscope="" itemtype="#">
                <div class="product-detail-top">
                    <div class="container">
                        <div class="row main-productdetail" data-product_layout_thumb="list_thumb"
                            style="position: relative;">
                            <div class="col-lg-5 col-md-4 col-xs-12 box-image">
                                <section class="page-content" id="content">
                                    @if (isset($product->images))
                                    @foreach($product->images as $image)
                                    <div class="carousel-item">
                                        <img src='{{asset("media/products/$image")}}' class="d-block w-100" alt="..."
                                            height="300" width="350">
                                    </div>
                                    @endforeach
                                    @endif
                                </section>
                            </div>
                            <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">

                                <h1 class="detail-product-name" itemprop="name">
                                    {{ $product->name }}
                                </h1>

                                <div class="group-price d-flex justify-content-start align-items-center">
                                    <div class="product-prices">

                                        <div class="product-price " itemprop="offers" itemscope="" itemtype="#">
                                            <div class="current-price">
                                                <hr>
                                                <span itemprop="price" class="price" content="30"><b>سعر التذكرة
                                                        {{ $lottery->ticket_price }} ¥</b></span>
                                            </div>
                                        </div>

                                        <div class="tax-shipping-delivery-label">
                                            <i class="fa fa-calendar"></i> يبدأ في: {{ $lottery->start_at }} <br>
                                            <i class="fa fa-calendar"></i> ينتهي في: {{ $lottery->end_at }}
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-cate">
                                    <label class="control-label">قسم:</label>
                                    <div><b> {{ $product->category->category_name }} </b></div>
                                </div>
                                <div id="_desktop_productcart_detail">
                                    <div class="product-add-to-cart in_border">
                                        @auth
                                        @if (!is_null($lottery->winner_id))
                                        <p> {{trans('لقد انتهي السحب والفائز هو')}} </p>
                                        <p class="text text-primary">{{$lottery->winner->name}}</p>
                                        @else
                                        @if (in_array($lottery->id,$arr))
                                        <div class="w-100">
                                            <h3 class="text-danger">{{ trans(' تم الاشتراك في هذا السحب من قبل ') }}
                                            </h3>
                                            <br>
                                        </div>
                                        @endif
                                        @if ($lottery->ticket_price <= auth()->user()->wallet)
                                            <div class="add">
                                                <button type="button" class="btn btn-primary add-to-cart"
                                                    data-toggle="modal" data-target="#exampleModal">
                                                    <div class="icon-cart btn-danger">
                                                        <i class="fa fa-fire fa-3" aria-hidden="true"></i>
                                                    </div>
                                                    <span>إشترك في السحب</span>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    {{trans('تأكيد الاشتراك بالسحب')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ trans("سيتم خصم عدد  $lottery->ticket_price من
                                                                رصيد محفظتكم الحالي وهو  ").auth()->user()->wallet}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary m-2"
                                                                    data-dismiss="modal">{{ trans('تراجع') }}</button>
                                                                <form
                                                                    action="{{route('front.lotteries.part',$lottery->id)}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input class="" hidden value="{{$lottery->id}}">
                                                                    <button type="submit" class="btn btn-primary m-2"
                                                                        id="confirm">
                                                                        {{ trans('تأكيد') }}</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <a class="text-danger col-md" href="{{route('recharge')}}">يرحى الشحن
                                                    واعادة المحاولة مرة اخري</a>
                                            </div>
                                            @endif
                                            @endif
                                    </div>
                                    @endauth
                                    @guest
                                    <div class="row text-center">
                                        @if ($lottery->active == 2 )
                                        <div id="carouselExampleControls" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <!-- Carousel Slideshow -->
                                                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                                    <!-- Carousel Images -->
                                                    <div class="carousel-inner">
                                                        @foreach($lottery->product->gallery as $img)
                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                            <img src='{{asset("media/products/$img")}}' class="d-block"
                                                                style="width: 240px">
                                                        </div>
                                                        @endforeach
                                                        <!-- Carouse Images -->
                                                        <!-- Carousel Controls -->
                                                        <a class="left carousel-control" href="#carousel-example"
                                                            data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                                        </a>
                                                        <a class="right carousel-control" href="#carousel-example"
                                                            data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </a>
                                                        <!-- End Carousel Controls -->
                                                    </div>
                                                    <!-- End Carousel Slideshow -->
                                                </div>

                                            </div>
                                        </div>
                                        @else
                                        <div class="add">
                                            <button class="btn btn-danger add-to-cart" data-button-action="add-to-cart"
                                                type="submit" disabled>
                                                <div class="icon-cart btn-danger">
                                                    <i class="fa fa-fire fa-3" aria-hidden="true"></i>
                                                </div>
                                                <span>إشترك في السحب</span>
                                            </button>
                                            يجب عليك تسجيل الدخول / الاشتراك لتتمكن من التفاعل
                                        </div>
                                        @endif

                                    </div>
                                    @endguest
                                </div>
                            </div>
                            <div class="productbuttons">
                                <div class="tabs">
                                </div>
                                <script type="text/javascript">
                                    var PS_REWRITING_SETTINGS = "1";

                                </script>
                                <div class="dropdown social-sharing">
                                    <button class="btn btn-link" type="button" id="social-sharingButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share With :</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="social-sharingButton">
                                        <a class="dropdown-item" href="#" title="Share" target="_blank"><i
                                                class="fa fa-facebook"></i>Facebook</a>
                                        <a class="dropdown-item" href="#" title="Tweet" target="_blank"><i
                                                class="fa fa-twitter"></i>Tweet</a>
                                        <a class="dropdown-item" href="#" title="Google+" target="_blank"><i
                                                class="fa fa-google-plus"></i>Google+</a>
                                        <a class="dropdown-item" href="#" title="Pinterest" target="_blank"><i
                                                class="fa fa-pinterest"></i>Pinterest</a>
                                    </div>
                                </div>


                                <a class="btn btn-link" href="javascript:print();">
                                    <span><i class="fa fa-print" aria-hidden="true"></i>Print</span>
                                </a>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
                <div class="product-detail-middle">
                    <div class="container">
                        <div class="row">
                            <div class="tabs col-lg-9 col-md-7 ">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#description">تفاصيل
                                            المنتج</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#lottery-details">تفاصيل السحب</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#reviews">شروط عامة للسحوبات</a>
                                    </li>

                                </ul>

                                <div class="tab-content" id="tab-content">
                                    <div class="tab-pane fade in active" id="description">

                                        <div class="product-description">
                                            <p>{{ $product->details }}</p>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade in" id="lottery-details">
                                        <div class="product-description">
                                            <p>{{ $product->details }}</p>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade in" id="reviews">
                                        <div class="product-description">
                                            <p>{{ $product->details }}</p>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-3 col-md-5">
                                <div
                                    class="nov-productlist     productlist-liststyle-3  col-xl-12 col-lg-12 col-md-12 col-xs-12 no-padding">
                                    <div class="block block-product clearfix">
                                        <h2 class="title_block">السحوبات الساخنة</h2>
                                        <div class="block_content">
                                            سحب 1
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade js-product-images-modal" id="product-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <figure>
                                    <img class="js-modal-product-cover product-cover-modal" width="600"
                                        src="http://demo.bestprestashoptheme.com/savemart/34-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                                        alt="" title="" itemprop="image">
                                </figure>
                                <aside id="thumbnails" class="thumbnails js-thumbnails text-xs-center">

                                    <div class="js-modal-mask mask  nomargin ">

                                    </div>

                                </aside>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </section>
        </div>
    </div>


    @endsection
    @section('scripts')
    <script>

    </script>

    @endsection
