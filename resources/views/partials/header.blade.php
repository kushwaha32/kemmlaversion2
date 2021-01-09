<header id="header">
        <div class="container">
            <div class="header-top">
                <div class="row align-items-center">
                    <!-- Header Left -->
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <!-- Main Menu -->
                        <div id="main-menu">
                            <ul class="menu">
                                <li>
                                    <a href="{{ route('product.show') }}" title="Homepage">Home</a>
                                </li>
                                
                                <li class="dropdown">
                                    <a href="product-grid-left-sidebar.html" title="Product">Product</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="has-image">
                                                <img src="{{asset('frontend/img/product/product-category-1.png')}}" alt="Product Category Image">
                                                <a href="product-grid-left-sidebar.html" title="Vegetables">Vegetables</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="page-about-us.html">About Us</a>
                                </li>
                                
                                <li>
                                    <a href="page-contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Header Center -->
                    <div class="col-lg-2 col-md-2 col-sm-12 header-center justify-content-center">
                        <!-- Logo -->		
                        <div class="logo">
                            <a href="home-4.html">
                                <img class="img-responsive" src="{{asset('frontend/img/logo.png')}}" alt="Logo">
                            </a>
                        </div>
                        <span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
                    </div>
                    <!-- Header Right -->
                    <div class="col-lg-5 col-md-5 col-sm-12 header-right d-flex justify-content-end align-items-center">
                        <!-- Search -->							
                        <div class="form-search">
                            <form action="#" method="get">
                                <input type="text" class="form-input" placeholder="Search">
                                <button type="submit" class="fa fa-search"></button>
                            </form>
                        </div>
                        
                        <!-- Cart -->
                        <div class="block-cart dropdown">

                            <div class="cart-title">
                                <a href="{{ route('cart.show') }}">
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                    <span class="cart-count">
                                    @if(Session::has('cart'))
                                        {{ Session::get('cart')->getTotalQty()}}
                                        @else
                                        0
                                        @endif
                                    </span>
                                </a>
                                
                            </div>
                            
                            <div class="dropdown-content">
                                <div class="cart-content">
                                    <table>
                                        <thead class="product-pop-over"> 
                                           @if(Session::has('cart'))
                                              @foreach(Session::get('cart')->getContents() as $slug => $product)
                                                <tr>
                                                    <td class="product-image">
                                                        <a href="product-detail-left-sidebar.html">
                                                            <img src="{{asset('storage/'.$product['product']->thumbnail)}}" alt="Product">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="product-name">
                                                            <a href="product-detail-left-sidebar.html">{{ $product['product']->title }}</a>
                                                        </div>
                                                        <div>	
                                                            {{ $product['qty'] }} x 
                                                            <span class="product-price"><i class="fas fa-rupee-sign rupie-X"></i> {{ $product['product']->price }} </span>
                                                            
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                             @endforeach
                                            @endif
                                            
                                            </thead>
                                            <tbody>
                                            <tr class="total">
                                                <td>Total:</td>
                                                <td colspan="2"><i class="fas fa-rupee-sign rupie-X"></i> 
                                                 @if(Session::has('cart'))
                                                  {{ Session::get('cart')->getTotalPrice()  }}
                                                   @else null @endif</td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="3">
                                                    <div class="cart-button">
                                                        <a class="btn btn-primary" href="{{ route('cart.show') }}" title="View Cart">View Cart</a>
                                                        <a class="btn btn-primary" href="product-checkout.html" title="Checkout">Checkout</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- My Account -->
                        <div class="my-account dropdown toggle-icon">
                            <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                            <div class="dropdown-menu">										
                                <div class="item">
                                    <a href="#" title="Log in to your customer account"><i class="fa fa-cog"></i>My Account</a>
                                </div>
                                <div class="item">
                                    <a href="#" title="My Wishlists"><i class="fa fa-heart"></i>My Wishlists</a>
                                </div>
                                @guest
                                <div class="item">
                                    <a href="{{route('login')}}" title="Log in to your customer account"><i class="fa fa-sign-in"></i>Login</a>
                                </div>
                                <div class="item">
                                    <a href="{{route('register')}}" title="Register Account"><i class="fa fa-user"></i>Register</a>
                                </div>
                                @else
                                <div class="item">
                                    <a title="Log in to your customer account" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-in"></i>logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endguest
                                <!-- <div class="item"> -->
                                    <!-- Language  -->
                                     <!-- <div class="language switcher">
                                        <a href="#" title="Language English" class="active"><img src="img/language-en.jpg" alt="Language English"></a>
                                        <a href="#" title="Language French"><img src="img/language-fr.jpg" alt="Language French"></a>
                                        <a href="#" title="Language Deutsch"><img src="img/language-de.jpg" alt="Language Deutsch"></a>
                                    </div> -->
                                    
                                    <!-- Currency -->
                                     <!-- <div class="currency switcher">
                                        <a href="#" title="USD" class="active">USD</a>
                                        <a href="#" title="EUR">EUR</a>
                                        <a href="#" title="GBP">GBP</a>
                                    </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </header>