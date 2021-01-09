@extends('layouts.app')

@section('content')
<!-- Slideshow -->
<div class="section slideshow">
    <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="{{asset('frontend/img/slideshow/home4-slideshow-1.jpg')}}" alt="Chania" style = "width:100%">
        <div class="carousel-caption">
          <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
      </div>

      <div class="item">
        <img src="{{asset('frontend/img/slideshow/home4-slideshow-2.jpg')}}" alt="Chania" class="img-responsive" style = "width:100%">
        <div class="carousel-caption">
          <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
        </div>
      </div>
    
      <div class="item">
        <img src="{{asset('frontend/img/slideshow/home4-slideshow-3.jpg')}}" alt="Flower" class="img-responsive" style = "width:100%">
        <div class="carousel-caption">
          <h3>Flowers</h3>
          <p>Beautiful flowers in Kolymbari, Crete.</p>
        </div>
      </div>

      <div class="item">
        <img src="{{asset('frontend/img/slideshow/home4-slideshow-3.jpg')}}" alt="Flower" class="img-responsive" style = "width:100%">
        <div class="carousel-caption">
          <h3>Flowers</h3>
          <p>Beautiful flowers in Kolymbari, Crete.</p>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
        
</div>

<!-- Product - Our Products -->
<div class="section products-block product-tab tab-2">
    <div class="block-title">
        <h2 class="title">Our <span>Products</span></h2>
    </div>
    
    <div class="block-content">
        <div class="container">
            <!-- Tab Navigation -->
            <div class="tab-nav">
                <ul>
                    <li class="active">
                        <a>
                            <img src="{{asset('frontend/img/product/product-category-0.png')}}" alt="All Product">
                            <span>All Products</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Tab Content -->
			<div class="owl-carousel owl-theme">
			   @if(isset($allProducts) && $allProducts->count() > 0)
			      @foreach($allProducts as $allProduct)
						<div class="item">
							<div class="product-item">
									<div class="product-image">
										<a href="{{ route('product.detail', $allProduct->slug) }}">
											<img src="{{asset('storage/'.$allProduct->thumbnail)}}" alt="Product Image">
										</a>
									</div>
									
									<div class="product-title">
										<a href="product-detail-left-sidebar.html" class="text-capitalize">
										  {{$allProduct->title}}
										</a>
									</div>
									
									<div class="product-rating">
										<div class="star on"></div>
										<div class="star on"></div>
										<div class="star on "></div>
										<div class="star on"></div>
										<div class="star"></div>
									</div>
									
									<div class="product-price">
										<span class="sale-price">&#8377;{{$allProduct->price}}</span>
									</div>
									
									<div class="product-buttons">
										<a class="add-to-cart" href="#">
											<i class="fa fa-shopping-basket" aria-hidden="true"></i>
										</a>
										
										<a class="add-wishlist" href="#">
											<i class="fa fa-heart" aria-hidden="true"></i>												
										</a>
										
										<a class="quickview" href="#">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</div>
								</div>
						</div>
				  @endforeach
				
			   @else
                  <h1 class="text-center"> No Product found..</h1>
			   @endif
			</div>
			<div class="tab-nav">
                <ul>
                    <li class = "active">
                        <a>
                            <img src="{{asset('frontend/img/product/product-category-1.png')}}" alt="Vegetables">
                            <span>Vegetables</span>
                        </a>
                    </li>
                </ul>
			</div>
			<!-- Tab Content -->
			<div class="owl-carousel owl-theme">
		    	@if(isset($vegCategory) && $vegCategory->count() > 0)
			      @foreach($vegCategory as $vegCategory)
				        @foreach($vegCategory->products as $product)
							<div class="item">
								<div class="product-item">
										<div class="product-image">
											<a href="{{ route('product.detail', $product->slug) }}">
												<img src="{{asset('storage/'.$product->thumbnail)}}" alt="Product Image">
											</a>
										</div>
										
										<div class="product-title">
											<a href="product-detail-left-sidebar.html" class="text-capitalize">
											{{$product->title}}
											</a>
										</div>
										
										<div class="product-rating">
											<div class="star on"></div>
											<div class="star on"></div>
											<div class="star on "></div>
											<div class="star on"></div>
											<div class="star"></div>
										</div>
										
										
										<div class="product-price">
											<span class="sale-price">&#8377;{{$product->price}}</span>
										</div>
										
										<div class="product-buttons">
											<a class="add-to-cart" href="#">
												<i class="fa fa-shopping-basket" aria-hidden="true"></i>
											</a>
											
											<a class="add-wishlist" href="#">
												<i class="fa fa-heart" aria-hidden="true"></i>												
											</a>
											
											<a class="quickview" href="#">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</a>
										</div>
									</div>
							</div>
						@endforeach
						
				  @endforeach
				
			   @else
                  <h1 class="text-center"> No Product found..</h1>
			   @endif
			</div>
			<div class="tab-nav">
                <ul>
                    <li class = "active">
                        <a>
                            <img src="{{asset('frontend/img/product/product-category-2.png')}}" alt="Fruits">
                            <span>Fruits</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Tab Content -->
			<div class="owl-carousel owl-theme">
			  @if(isset($fruitCategory) && $fruitCategory->count() > 0)
			      @foreach($fruitCategory as $fruitCategory)
				        @foreach($fruitCategory->products as $product)
							<div class="item">
								<div class="product-item">
										<div class="product-image">
											<a href="{{ route('product.detail', $product->slug) }}">
												<img src="{{asset('storage/'.$product->thumbnail)}}" alt="Product Image">
											</a>
										</div>
										
										<div class="product-title">
											<a href="product-detail-left-sidebar.html" class="text-capitalize">
											{{$product->title}}
											</a>
										</div>
										
										<div class="product-rating">
											<div class="star on"></div>
											<div class="star on"></div>
											<div class="star on "></div>
											<div class="star on"></div>
											<div class="star"></div>
										</div>
										
										<div class="product-price">
											<span class="sale-price">&#8377;{{$product->price}}</span>
										</div>
										
										<div class="product-buttons">
											<a class="add-to-cart" href="#">
												<i class="fa fa-shopping-basket" aria-hidden="true"></i>
											</a>
											
											<a class="add-wishlist" href="#">
												<i class="fa fa-heart" aria-hidden="true"></i>												
											</a>
											
											<a class="quickview" href="#">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</a>
										</div>
									</div>
							</div>
						@endforeach
						
				  @endforeach
				
			   @else
                  <!-- <h1 class="text-center"> No Product found..</h1> -->
			   @endif
			</div>
           
    
@endsection


@section('productJs')
  <script>
      $(document).ready(function(){
		  const nextIcon = '<i class = "fas fa-angle-left"></i>';
		  const prewIcon = '<i class = "fas fa-angle-right"></i>';
		$('.owl-carousel').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				navText:[
					nextIcon,
					prewIcon
				],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:5
					}
				}
			})
	  });
  
  
  
  </script>

@endsection