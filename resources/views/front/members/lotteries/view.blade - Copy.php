@extends('layouts.site')
@section('content')

@foreach($product as $pro_name)




<hr>

    <div id="wrapper-site">
                  
      
                    
      <div class="no-index">
        <div id="content-wrapper">
          
            <section id="main" itemscope="" itemtype="#">
              <meta itemprop="url" content="#">
              <div class="product-detail-top">
                <div class="container">
                  
                    
                  
                  <div class="row main-productdetail" data-product_layout_thumb="list_thumb" style="position: relative;">
                    <div class="col-lg-5 col-md-4 col-xs-12 box-image">
                      
                        <section class="page-content" id="content">
                          
                            
                              
        <div class="images-container list_thumb">
            <div class="product-cover">

            @if (isset($pro_name->images))
              @foreach ($pro_name->images as $image)

              <img class="js-qv-product-cover img-fluid" src="/public/media/products/{{  $image }}" alt="sdsdfsd" title="" style="width:100%;" itemprop="image">

              @endforeach
            @endif


              <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                <i class="fa fa-expand"></i>
              </div>
            </div>
          
      
          

          
        </div>
      
                            
                          
                        </section>
                      
                    </div>
      
                    <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">
                      <div class="product-information">
      
          
                      </div>
      
                                <h1 class="detail-product-name" itemprop="name">
                                    {{ $pro_name['name'] }}
                                </h1>
      
                                
                                
                                <div class="group-price d-flex justify-content-start align-items-center">
                                  
                                      <div class="product-prices">
          
          
            <div class="product-price " itemprop="offers" itemscope="" itemtype="#">
      
              <div class="current-price">
                <hr>
                <span itemprop="price" class="price" content="30"><b>سعر التذكرة {{ $lottery->ticket_price }} ¥</b></span>
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
                                      <div><b> {{ $pro_name->Category->category_name }} </b></div>
                                </div>
         
                                
                                <div id="_desktop_productcart_detail">
                                    <div class="product-add-to-cart in_border">

                    @auth                
									  <div class="add">
										  <button class="btn btn-danger add-to-cart" data-button-action="add-to-cart" type="submit">
											  <div class="icon-cart btn-danger">
											  <i class="fa fa-fire fa-3" aria-hidden="true"></i>
											  </div>
											  <span>إشترك في السحب</span>
										  </button>
									  </div>
                    @endauth
                                    
									  <div class="add">
										  <button class="btn btn-danger add-to-cart" data-button-action="add-to-cart" type="submit" disabled>
											  <div class="icon-cart btn-danger">
											  <i class="fa fa-fire fa-3" aria-hidden="true"></i>
											  </div>
											  <span>إشترك في السحب</span>
										  </button>
                      يجب عليك الإشتراك لتتمكن من التفاعل
									  </div>
                    


								  </div>
                                </div>
                                
                                                                
                    </div>
        
                                
            
                    <div class="productbuttons">
                                      <div class="tabs">
          </div>
      <script type="text/javascript">
      var PS_REWRITING_SETTINGS = "1";
      </script>
      
      
          <div class="dropdown social-sharing">
          <button class="btn btn-link" type="button" id="social-sharingButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share With :</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="social-sharingButton">
                              <a class="dropdown-item" href="#" title="Share" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                                      <a class="dropdown-item" href="#" title="Tweet" target="_blank"><i class="fa fa-twitter"></i>Tweet</a>
                                      <a class="dropdown-item" href="#" title="Google+" target="_blank"><i class="fa fa-google-plus"></i>Google+</a>
                                      <a class="dropdown-item" href="#" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i>Pinterest</a>
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
                          <a class="nav-link active" data-toggle="tab" href="#description">تفاصيل المنتج</a>
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
                                <p>{{ $pro_name['details'] }}</p>
                             </div>
                           
                         </div>
                         
                        <div class="tab-pane fade in" id="lottery-details">
                           <div class="product-description">
                                <p>{{ $pro_name['details'] }}</p>
                          </div>
                        </div>
                         
      
                        <div class="tab-pane fade in" id="reviews">
                           <div class="product-description">
                                <p>{{ $pro_name['details'] }}</p>
                          </div>
                        </div>

            

       
                         </div>
                    </div>
                                  <div class="col-lg-3 col-md-5">
                    



      <div class="nov-productlist     productlist-liststyle-3  col-xl-12 col-lg-12 col-md-12 col-xs-12 no-padding">
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
      
              
                <div class="modal fade js-product-images-modal" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
                      <figure>


            @if (isset($pro_name->images))
              @foreach ($pro_name->images as $image)
                <img class="js-modal-product-cover product-cover-modal" width="600" src="/public/media/products/{{  $image }}" alt="" title="" itemprop="image">
              @endforeach
            @endif


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
      
      
                  
            </div>




            @endforeach

@endsection
