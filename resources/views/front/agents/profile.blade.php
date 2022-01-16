@extends('layouts.site')
@section('content')
<div id="wrapper-site">
    <div class="container no-index">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="main">
                    <section id="content" class="page-content">

                        <div class="box box-sellerprofile">
                            <div class="row d-flex align-items-center mb-28">
                                <div class="col-md-12 col-xl-6 seller-header-left">
                                    <div class="d-flex">
                                        <div class="image-seller-home">
                                            <i class="icon-seller-home"> </i>
                                        </div>
                                        <div class="seller-title-home">
                                            @if (isset($agent->shop))
                                            <h1 class="page-subheading">SELLER SHOP: Electronic JonSon</h1>
                                            @endif
                                            <div class="d-inline-block ml-5 mt-13">
                                                <label><strong>Followers: </strong><span>5</span></label>
                                            </div>
                                            <div class="d-inline-block ml-4 mt-13">
                                                <label><strong>Average rating: </strong>
                                                    <div
                                                        class="average_rating buttons_bottom_block d-inline-block ml-2">
                                                        <a href="" title="View comments about Taylor Jonson">
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        </a>
                                                        <span id="average_total">(0)</span>
                                                    </div>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row vendor-content-detail">
                                <div class="vendor-img">
                                    @if (isset($agent->image))
                                    <img class="img-responsive" src='{{asset("media/users/$agent->image")}}'
                                        width="100%">
                                    @else
                                    <img class="img-responsive"
                                        src="http://demo.bestprestashoptheme.com/savemart//img/sellers/4.jpg"
                                        width="100%">
                                    @endif

                                </div>
                                <div class="content-seller-vendor">

                                    <div class="ps-vendor-fullname">
                                        <p>{{$agent->name}}</p>
                                    </div>
                                    @if (isset($agent->address))
                                    <div class="ps-vendor-detail">
                                        <p><i class="fa fa-fw fa-map-marker"></i><label><b>Seller Address :
                                                </b>{{$agent->address}}</label></p>
                                    </div>
                                    @endif

                                    <div class="ps-vendor-detail">
                                        @if (isset($agent->mobile))
                                        <p><i class="fa fa-fw fa-phone"></i><label><b>Seller Phone :
                                                </b>{{$agent->mobile}}</label></p>
                                        @endif

                                        @if (isset($agent->fax))
                                        <p><i class="fa fa-fax"></i><label><b>Seller Fax :</b>977591195</label></p>
                                        @endif
                                    </div>
                                    <div class="ps-vendor-detail">
                                        @if (isset($agent->email))
                                        <a href=""><i class="fa fa-fw fa-envelope"></i><b>Email :
                                            </b>{{$agent->email}}</a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <ul class="footer_links_ja list-inline m-2">
                            <li class="list-inline-item">
                                <a class="btn btn-secondary" href="{{route('site')}}">
                                    <span>
                                        <i class="fa fa-chevron-left"></i>
                                        Home
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
