<div class="nov-row  col-lg-12 col-xs-12">
    <div class="nov-row-wrap row">
        <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/countdown_product.tpl -->
        <div class="nov-productlist nov-countdown-productlist col-xl-4 col-lg-4 col-md-4  col-xs-12 col-md-12">
            <div class="block block-product clearfix">
                <h2 class="title_block">
                    السحوبات الساخنة
                </h2>
                <div class="block_content">
                    <div id="productlist706506225"
                        class="product_list countdown-productlist countdown-column-1 owl-carousel owl-theme"
                        data-autoplay="false" data-autoplayTimeout="6000" data-loop="false" data-margin="30"
                        data-dots="false" data-nav="true" data-items="1" data-items_large="1" data-items_tablet="2"
                        data-items_mobile="1">


                        @foreach (App\Models\Lottery::where('active',1)->orderBy('ticket_price','DESC')->limit(3)->get()
                        as $lottery)

                        <div class="item item-list">
                            <div class="product-miniature js-product-miniature first_item" data-id-product="12"
                                data-id-product-attribute="232" itemscope itemtype="#">

                                @foreach (App\Models\Product::where('active',1)->where('id',$lottery->product_id)->get()
                                as $product)

                                <div class="thumbnail-container">

                                    <a href="#" class="thumbnail product-thumbnail">
                                        @if (isset($product->image))
                                        <img class="img-fluid image-cover"
                                            src='{{asset("media/products/$product->image")}}' alt=""
                                            data-full-size-image-url='{{asset("media/products/$product->image")}}'
                                            width="600" height="600">
                                        {{-- @foreach ($product->images as $image)

                                        <img class="img-fluid image-cover"
                                            src='{{asset("public/media/products/$image")}}' alt=""
                                        data-full-size-image-url='{{asset("public/media/products/$image")}}'
                                        width="600" height="600">
                                        <img class="img-fluid image-secondary"
                                            src='{{asset("public/media/products/$image")}}' alt=""
                                            data-full-size-image-url='{{asset("public/media/products/$image")}}'
                                            width="600" height="600">

                                        @endforeach --}}
                                        @endif
                                    </a>

                                    <div class="product-flags discount">Sale</div>




                                </div>
                                <div class="product-description">
                                    <div class="product-groups">

                                        <div class="product-title" itemprop="name"><a
                                                href="#">{{ \Str::limit($product->name,40) }}</a></div>



                                        <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/jmarketplace/views/templates/hook/product-list.tpl -->
                                        <p class="seller_name">
                                            <a title="View seller profile" href="#">
                                                <i class="fa fa-check-square-o"></i>
                                                ينتهي في:
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lottery->end_at)->format('Y.m.d') }}
                                            </a>
                                        </p>

                                        <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/jmarketplace/views/templates/hook/product-list.tpl -->

                                        <div class="product-group-price">

                                            <div class="product-price-and-shipping">



                                                <span itemprop="price" class="price">
                                                    سعر التذكرة: {{ $lottery->ticket_price }} ¥
                                                </span>







                                            </div>

                                        </div>
                                    </div>

                                    <div class="product-buttons d-flex justify-content-center" itemprop="offers"
                                        itemscope itemtype="#">


                                        <a class="addToWishlist wishlistProd_12"
                                            href="{{route('front.lotteries.view',$lottery->id)}}" data-rel="12"
                                            onclick="WishlistCart('wishlist_block_list', 'add', '12', false, 1); return false;">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>المزيد من التفاصيل</span>
                                        </a>


                                    </div>

                                </div>
                                @endforeach

                                <!-- begin modules/novthemeconfig/views/templates/hook/countdown.tpl -->
                                <div class="countdownfree d-flex"
                                    data-date="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lottery->end_at)->format('Y/m/d') }}">
                                </div>

                                <!-- end modules/novthemeconfig/views/templates/hook/countdown.tpl -->

                            </div>
                        </div>

                        @endforeach



                    </div>
                </div>
            </div>
        </div>
        <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/countdown_product.tpl -->
