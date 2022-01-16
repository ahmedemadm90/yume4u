@extends('layouts.site')

@section('content')

<div id="wrapper-site">
                  
	<div class="container no-index">
		<div class="row">
	  		<div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    	

  <div id="main">
    
	


    
      <section id="content" class="page-content">        
        
	
	
		<h1 class="page_title">Contact us</h1>
	
	<div class="infomation-store">
		<div class="contact-rich row justify-content-between">
   
      <div class="block col col-xs-12">
      <div class="icon"><i class="material-icons"></i></div>
      <div class="data d-flex align-self-stretch email">
        <div class="mr-2"><b>Email:</b></div>
        <div><a href="mailto:demo@demo.com">demo@demo.com</a></div>
       </div>
    </div>
    <div class="block col col-xs-12 mt-xs-10">
    <div class="icon"><i class="material-icons">home</i></div>
    <div class="data d-flex align-self-stretch">
      <div class="mr-2"><b>Address:</b></div>
      <div>123 Suspendis matti, Visaosang Building VST  District, NY Accums ,  North American</div>
    </div>
  </div>
        <div class="block d-flex col col-xs-12 justify-content-md-end mt-xs-5">
      <div class="icon"><i class="material-icons"></i></div>
      <div class="data d-flex align-self-stretch">
        <div class="mr-2"><b>Hotline:</b></div>
        <div><a href="tel:0123-456-78910">0123-456-78910</a></div>
       </div>
    </div>
  </div>
	</div>
		<div class="desc-store text-center">
		<p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec<br>
sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Proin gravida nibh vel velit auctor</p>
	</div>
		<div class="text-center"><i class="icon-comment"></i></div>
	<div class="row justify-content-md-center">
		<div class="col-lg-6 co-md-6 col-sm-12 col-xs-12">
  			<section class="contact-form">
  <form action="http://demo.bestprestashoptheme.com/savemart/en/contact-us" method="post" enctype="multipart/form-data">

    
    <section class="form-fields">

      <div class="form-group row">
                <div class="col-md-6">
          <input class="form-control" name="name" placeholder="Your name">
        </div>
        <div class="col-md-6">
          <input class="form-control" name="from" type="email" value="" placeholder="Your email">
        </div>
      </div>

      <div class="form-group row">
                <div class="col-md-12">
          <select name="id_contact" class="form-control form-control-select">
                          <option value="2">Customer service</option>
                          <option value="1">Webmaster</option>
                      </select>
        </div>
      </div>


      
      
      <div class="form-group row">
                <div class="col-md-12">
          <textarea class="form-control" name="message" placeholder="Message" rows="15"></textarea>
        </div>
      </div>

    </section>

    <footer class="form-footer d-flex justify-content-end">
    <style>
          input[name=url] {
            display: none !important;
          }
        </style>
        <input type="text" name="url" value="">
        <input type="hidden" name="token" value="08d5d9a1b3f592f489ca56d56428b4e8">
      <input class="btn" type="submit" name="submitMessage" value="Send message">
    </footer>
  </form>
</section>

		</div>
	</div>

      </section>
    

    
      <footer class="page-footer">
        
          <!-- Footer content -->
        
      </footer>
    

  </div>


  			</div>
  		</div>
  	</div>


            
      </div>

      @endsection
