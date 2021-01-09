@extends('layouts.app')
@section('content')
   
<!-- Main Content -->
<div id="content" class="site-content">
        <!-- Breadcrumb -->
        @if(isset($product) && $product->count() > 0)
          @foreach($product as $pro)
          @foreach($pro->categories as $cat)
        <div id="breadcrumb">
            <div class="container">
                <h2 class="title text-capitalize">Organic {{$pro->title}} {{$cat->title}}</h2>
                <input type="hidden" name="pro_id" value="{{$pro->id}}" id="detail_pro_id">
                <ul class="breadcrumb text-capitalize">
                    <li><a href="#" title="Home">Home</a></li>
                    <li><a href="#" title="Fruit">{{$cat->title}}</a></li>
                    <li><span >{{$pro->title}}</span></li>
                </ul>
            </div>
        </div>
             @if($errors->any())
                  <div class = "alert alert-danger mx-2 mt-3">
                     <ul>
                        @foreach($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
              @endif
              @if(session()->has('message'))
                  <div class = "alert alert-success mx-2 mt-3">
                     {{ session("message")}}
                  </div>
              @endif    
     <div class="custum-container">
        <div class="container">
                <div class="row">
                        <!-- Page Content -->
                            <div id="center-column" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="product-detail">
                                    <div class="products-block layout-5">
                                        <div class="product-item">
                                            <div class="product-title text-capitalize">
                                                Organic {{$pro->title}} {{$cat->title}}
                                            </div>
                                                        
                                            <div class="row">
                                                <div class="product-left col-md-5 col-sm-5 col-xs-12 cus-owl-4img">
                                                    <div class="product-image horizontal">
                                                        <div class="main-image">
                                                            <img class="img-responsive" src="{{asset('storage/'.$pro->thumbnail)}}" alt="Product Image">
                                                        </div>
                                                        <div class="thumb-images owl-theme owl-carousel">
                                                            <img class="img-responsive" src="{{asset('storage/'.$pro->thumbnail)}}" alt="Product Image">
                                                            <img class="img-responsive" src="{{asset('frontend/img/product/3.jpg')}}" alt="Product Image">
                                                            <img class="img-responsive" src="{{asset('frontend/img/product/7.jpg')}}" alt="Product Image">
                                                            <img class="img-responsive" src="{{asset('frontend/img/product/30.jpg')}}" alt="Product Image">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="product-right col-md-7 col-sm-7 col-xs-12">
                                                    <div class="product-info">
                                                        <div class="product-price">
                                                            <span class="sale-price"><i class="fas fa-rupee-sign rupie-X"></i>{{$pro->price}}</span>
                                                            <span class="base-price"><i class="fas fa-rupee-sign rupie-X"></i>90.00</span>
                                                        </div>
                                                        
                                                        <div class="product-stock">
                                                            <span class="availability">Availability :</span>
                                                            @if($pro->status == '1')
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
                                                            @else
                                                            <i class="fa fa-check-square-o text-danget" aria-hidden="true"></i>Out stock
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="product-short-description">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sapien urna, commodo ut molestie vitae, feugiat tincidunt ligula. Nam gravida nulla in convallis condimentum.
                                                        </div>
                                                        
                                                        
                                                        <div class="product-add-to-cart border-bottom">
                                                           <form action="{{ route('cart.add', $pro->id) }}" method = "get">
                                                               @csrf
                                                            <div class="product-quantity">
                                                                    <span class="control-label">QTY :</span>
                                                                    <div class="qty">
                                                                        <div class="input-group">
                                                                            <input type="text" name="qty" value="1" data-min="1" id="qtyVal">
                                                                            <span class="adjust-qty">
                                                                                <span class="adjust-btn plus" id="increment">+</span>
                                                                                <span class="adjust-btn minus" id="decrement">-</span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="product-buttons">
                                                                    <button type = "submit" class="add-to-cart">
                                                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                                        <span>Add To Cart</span>
                                                                    </button>
                                                                    
                                                                    <a class="add-wishlist" href="#">
                                                                        <i class="fa fa-heart" aria-hidden="true"></i>												
                                                                    </a>
                                                                </div>
                                                           </form>
                                                            
                                                        </div>
                                                        
                                                        <div class="product-share border-bottom">
                                                            <div class="item">
                                                                <a href="#"><i class="zmdi zmdi-share" aria-hidden="true"></i><span class="text">Share</span></a>
                                                            </div>
                                                            <div class="item">
                                                                <a href="#"><i class="zmdi zmdi-email" aria-hidden="true"></i><span class="text">Send to a friend</span></a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="product-review border-bottom">
                                                            <div class="item">
                                                                <div class="product-quantity">
                                                                    <span class="control-label">Review :</span>
                                                                    <div class="product-rating">
                                                                        <div class="star avgRating" data-index="0"></div>
                                                                        <div class="star avgRating" data-index="1"></div>
                                                                        <div class="star avgRating" data-index="2"></div>
                                                                        <div class="star avgRating" data-index="3"></div>
                                                                        <div class="star avgRating" data-index="4"></div>
                                                                    </div>
                                                                </div>	
                                                            </div>
                                                            
                                                           
                                                            <div class="item">
                                                                <a href="#"><i class="zmdi zmdi-edit" aria-hidden="true"></i><span class="text">Write a review</span></a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="product-extra">
                                                            <div class="item">
                                                                <span class="control-label">Categories :</span>
                                                                <a href="#" title="Vegetables">Vegetables,</a>
                                                                <a href="#" title="Fruits">Fruits,</a>
                                                                <a href="#" title="Apple">Apple</a>
                                                            </div>
                                                            <div class="item">
                                                                <span class="control-label">Tags :</span>
                                                                <a href="#" title="Vegetables">Hot Trend,</a>
                                                                <a href="#" title="Fruits">Summer</a>			
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="product-tab">
                                                <!-- Tab Navigation -->
                                                <div class="tab-nav">
                                                    <ul>
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#description">
                                                                <span>Description</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#additional-information">
                                                                <span>Additional Information</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#review">
                                                                <span>Review</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                                <!-- Tab Content -->
                                                <div class="tab-content">
                                                    <!-- Description -->
                                                    <div role="tabpanel" class="tab-pane fade in active" id="description">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                                                    </div>
                                                    
                                                    <!-- Product Tag -->
                                                    <div role="tabpanel" class="tab-pane fade" id="additional-information">
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                                                    </div>
                                                    
                                                    <!-- Review -->
                                                    <div role="tabpanel" class="tab-pane fade" id="review">
                                                        <div class="reviews">
                                                            <div class="comments-list">
                                                            @if(isset($reviews) && $reviews->count() > 0)
                                                               @foreach($reviews as $review)
                                                                <div class="item d-flex">
                                                                    <div class="comment-left">
                                                                        <div class="avatar">
                                                                            <img src="{{asset('frontend/img/avatar.jpg')}}" alt="" width="70" height="70">
                                                                        </div>
                                                                        <div class="product-rating">
                                                                            <div class="star on"></div>
                                                                            <div class="star on"></div>
                                                                            <div class="star on"></div>
                                                                            <div class="star on"></div>
                                                                            <div class="star on"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-body">
                                                                        <div class="comment-meta">
                                                                            <span class="author">{{$review->user->name}}</span> - <span class="time">June 02, 2018</span>
                                                                        </div>
                                                                        <div class="comment-content">Look at the sunset, life is amazing, life is beautiful, life is what you make it. To succeed you must believe. When you believe, you will succeed. In life there will be road blocks but we will over come it. Celebrate success right, the only way, apple. The ladies always say Khaled you smell good, I use no cologne. Cocoa butter is the key. </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @else
                                                               <p>no review found</p>

                                                            @endif
                                                                
                                                            </div>
                                                            
                                                            <div class="review-form">
                                                                <h4 class="title">Write a review</h4>
                                                                
                                                                <form action="#" method="post" class="form-validate" id="reviewForm">
                                                                    <div class="form-group">
                                                                        <div class="text">Your Rating</div>
                                                                        <div class="product-rating">
                                                                            <div class="star rating" data-index="0"></div>
                                                                            <div class="star rating" data-index="1"></div>
                                                                            <div class="star rating" data-index="2"></div>
                                                                            <div class="star rating" data-index="3"></div>
                                                                            <div class="star rating" data-index="4"></div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="text">You review<sup class="required">*</sup></div>
                                                                        <textarea id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <button class="btn btn-primary">Send your review
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach
                             @endforeach
                            @endif
                                <!-- Related Products -->
                                <div class="products-block related-products">
                                    <div class="block-title">
                                        <h2 class="title">Related <span>Products</span></h2>
                                    </div>
                                    
                                    <div class="block-content">
                                        <div class="products owl-theme owl-carousel">
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <a href="product-detail-left-sidebar.html">
                                                        <img src="img/product/4.jpg" alt="Product Image">
                                                    </a>
                                                </div>
                                                
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
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
                                                    <span class="sale-price">$80.00</span>
                                                    <span class="base-price">$90.00</span>
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
                                            
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <a href="product-detail-left-sidebar.html">
                                                        <img src="img/product/15.jpg" alt="Product Image">
                                                    </a>
                                                </div>
                                                
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
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
                                                    <span class="sale-price">$120.00</span>
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
                                            
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <a href="product-detail-left-sidebar.html">
                                                        <img src="img/product/31.jpg" alt="Product Image">
                                                    </a>
                                                </div>
                                                
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
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
                                                    <span class="sale-price">$80.00</span>
                                                    <span class="base-price">$90.00</span>
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
                                            
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <a href="product-detail-left-sidebar.html">
                                                        <img src="img/product/9.jpg" alt="Product Image">
                                                    </a>
                                                </div>
                                                
                                                <div class="product-title">
                                                    <a href="product-detail-left-sidebar.html">
                                                        Organic Strawberry Fruits
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
                                                    <span class="sale-price">$80.00</span>
                                                    <span class="base-price">$90.00</span>
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
                                        </div>
                                </div>
                            </div>

                </div>
            </div>
     </div>
        
        
        
                
</div>
    
  
@endsection


@section('productJs')
  <script>
        $(document).ready(function(){
            // ajax header setup
            $.ajaxSetup({
                headers:{
                   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
           var qty = 2;
           $('#increment').on('click', function(){
            $('#qtyVal').val(qty++);
           });

           $('#decrement').on('click', function(){
             if($('#qtyVal').val() > 1){
                $('#qtyVal').val(qty--);
             }
           });
           // star rating system

                var ratedIndex = -1;
                // on page load give rating
                    var product_id = $('#detail_pro_id').val();
                    var data = {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id
                    }
                // Get avg rating
                $.ajax({
                        type:"get",
                        url: "{{route('avgRating')}}",
                        data: data,
                        success:function(response){
                            //avg rating
                            removeClassAvg();
                            setStarsAvg(response);
                        }
                });
                // Get user rating avg rating
                    $.ajax({
                        type:"get",
                        url: "{{route('showSating')}}",
                        data: data,
                        success:function(response){
                            
                            ratedIndex = response[0].ratings;
                            //avg rating
                            removeClassAvg();
                            setStarsAvg(response[1]);
                            //normalrating
                            removeClass();
                            var currentIndex = ratedIndex;
                            setStars(currentIndex);
                        },
                        error:function(response){
                            if(response.status == 401){
                                swal({
                                    text: "Please log in to give your review!",
                                    buttons: true,
                                    })
                                    .then((will) => {
                                    if (will) {
                                        window.location.assign("{{route('login')}}");
                                    } 
                                });
                           }
                            else{
                                swal("Some error accure, please try later", "error");
                            }
                            
                        }
                        
                    });
                    
                // on click rating
                $('.rating').on('click', function(){
                    var rated = parseInt($(this).data('index'));
                    var product_id = $('#detail_pro_id').val();
                    var data = {
                        _token: "{{ csrf_token() }}",
                        rated: rated,
                        product_id: product_id
                    }
                    $.ajax({
                        type:"post",
                        url: "{{route('rating')}}",
                        data: data,
                        success:function(response){
                            
                            ratedIndex = response[0].ratings;
                            //avg rating
                            removeClassAvg();
                            setStarsAvg(response[1]);
                            //normalrating
                            removeClass();
                            var currentIndex = ratedIndex;
                            setStars(currentIndex);
                        },
                        error:function(response){
                            if(response.status == 401){
                                swal({
                                    text: "Please log in to give your review!",
                                    buttons: true,
                                    })
                                    .then((will) => {
                                    if (will) {
                                        window.location.assign("{{route('login')}}");
                                    } 
                                });
                            }else{
                                swal("Some error accure, please try later", "error");
                            }
                            
                        }
                        
                    });

                });

                // on hover
                $('.rating').on('mouseover', function(){
                    removeClass();
                    var currentIndex = parseInt($(this).data('index'));
                    setStars(currentIndex);
                });
                // on mouseleave
                $('.rating').on('mouseleave', function(){
                    removeClass();
                    if(ratedIndex != -1)
                    {
                        setStars(ratedIndex);
                    }
                    
                });

                // Review system
                $('#reviewForm').on('submit', function(e){
                    e.preventDefault();
                    var product_id = $('#detail_pro_id').val();
                    var review = $('#comment').val();
                    var data = {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id,
                        reviewCom: review 
                    }
                    $.ajax({
                        type:"post",
                        url: "{{route('review')}}",
                        data: data,
                        success:function(response){
                            swal(response.success);
                            
                            
                        },
                        error:function(response){
                            if(response.status == 401){
                                swal({
                                    text: "Please log in to give your review!",
                                    buttons: true,
                                    })
                                    .then((will) => {
                                    if (will) {
                                        window.location.assign("{{route('login')}}");
                                    } 
                                });
                            }else{
                                swal("Some error accure, please try later", "error");
                            }
                            
                        }
                        
                    });
                    
                });
                
        });
        function setStars(max){
            for(var i=0; i<=max-1; i++)
            {
                 $('.rating:eq('+i+')').addClass("on");
            }
        }
        function removeClass(){
            $('.rating').removeClass("on");
        }
        function setStarsAvg(max){
            for(var i=0; i<=max-1; i++)
            {
                 $('.avgRating:eq('+i+')').addClass("on");
            }
        }
        function removeClassAvg(){
            $('.avgRating').removeClass("on");
        }
        
  </script>
@endsection