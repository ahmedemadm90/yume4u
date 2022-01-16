<!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/productlist.tpl -->

<div class="nov-productlist  productlist-rows     col-xl-8 col-lg-8 col-md-8 col-xs-12 col-md-12">
    <div class="block block-product clearfix">
        <h2 class="title_block">
            أحدث السحوبات
        </h2>
        <div class="block_content">
            <div id="productlist1693764381" class="product_list grid owl-carousel owl-theme multi-row"
                data-autoplay="false" data-autoplayTimeout="6000" data-loop="false" data-margin="30" data-dots="false"
                data-nav="true" data-items="2" data-items_large="2" data-items_tablet="3" data-items_mobile="1">
                @foreach (App\Models\Lottery::where('active',1)->orderBy('ticket_price','DESC')->limit(6)->get() as
                $lottery)
                @foreach (App\Models\Product::where('id',$lottery->product_id)->get() as $product)

                <div class="product-miniature js-product-miniature item-one" data-id-product="7"
                    data-id-product-attribute="155" itemscope="" itemtype="http://schema.org/Product">
                    <div class="thumbnail-container">

                        <a href="#" class="thumbnail product-thumbnail">
                            @if (isset($product->image))
                            <img class="img-fluid image-cover" src='{{asset("media/products/$product->image")}}' alt=""
                                data-full-size-image-url='{{asset("media/products/$product->image")}}' width="600"
                                height="600">
                            {{-- @foreach ($product->images as $image)

                                                                <img class="img-fluid image-cover"
                                                                    src='{{asset("public/media/products/$image")}}'
                            alt=""
                            data-full-size-image-url='{{asset("public/media/products/$image")}}'
                            width="600" height="600">
                            <img class="img-fluid image-secondary" src='{{asset("public/media/products/$image")}}'
                                alt="" data-full-size-image-url='{{asset("public/media/products/$image")}}' width="600"
                                height="600">

                            @endforeach --}}
                            @endif
                        </a>
                        <div class="product-flags new">جديد</div>

                    </div>
                    <div class="product-description">
                        <div class="product-groups">

                            <div class="category-title"><a href="#">{{ $product->category_id }}</a></div>

                            <div class="group-reviews">
                                <div class="product-comments">



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
</div>
<!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/novpagemanage/views/source/productlist.tpl -->
