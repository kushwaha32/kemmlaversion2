@extends('layouts.app')
@section('content')
<div class="custum-container">
    <div id="content" class="site-content">
        <!-- Breadcrumb -->
        <div id="breadcrumb">
            <div class="container">
                <h2 class="title">Shipping Address</h2>
                
                <ul class="breadcrumb">
                    <li><a href="#" title="Home">Home</a></li>
                    <li><span>Shipping Address</span></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="page-checkout">
                <div class="row">
                @if(isset($ship_add) && $ship_add->count() > 0)   
                <div class="checkout-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading pannel-relative">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapseOne" style="outline:none;" id="toggleer">
                                        Shipping Address
                                        <span id="toggle_plus_icon"><i id="plusMinus" class="fas fa-plus"></i></span>
                                    </a>
                                </h4>
                                
                            </div>
                            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
                                <div class="panel-body">
                                    @foreach($ship_add as $ship_add)
                                    <table class="table ship_show_detail">
                                        <tr>
                                            <th>Name : </th>
                                            <td class="text-capitalize">{{ $ship_add->first_name }} {{ $ship_add->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact No : </th>
                                            <td class="text-capitalize">{{ $ship_add->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>E-mail : </th>
                                            <td class="text-capitalize">{{ $ship_add->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country : </th>
                                            <td class="text-capitalize">{{ $ship_add->country}}</td>
                                        </tr>
                                        <tr>
                                            <th>State : </th>
                                            <td class="text-capitalize">{{ $ship_add->state}}</td>
                                        </tr>
                                        <tr>
                                            <th>City : </th>
                                            <td class="text-capitalize">{{ $ship_add->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address : </th>
                                            <td class="text-capitalize">{{ $ship_add->address}}</td>
                                        </tr>
                                    </table>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading pannel-relative">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseThree" id="toggleerMinus">
                                        Payment
                                        <span id="toggle_plus_icon"><i id="minusPlus" class="fas fa-plus"></i></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="accordion-body collapse in" style="">
                                <div class="panel-body">
                                    <table class="cart-summary table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="width-80 text-center">Image</th>
                                                <th>Name</th>
                                                <th class="width-100 text-center">Unit price</th>
                                                <th class="width-100 text-center">Qty</th>
                                                <th class="width-100 text-center">Total</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        @foreach($cart->getContents() as $slug => $product)
                                            <tr>
                                                <td>
                                                    <a href="product-detail-left-sidebar.html">
                                                        <img width="80" alt="Product Image" class="img-responsive" src="{{asset('storage/'.$product['product']->thumbnail)}}">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="product-detail-left-sidebar.html" class="product-name">Organic {{ $product['product']->title }}</a>
                                                </td>
                                                <td class="text-center">
                                                    <i class = "fas fa-rupee-sign rupie-X" style="font-size:12px;"></i>
                                                    {{ $product['product']->price }}
                                                </td>
                                                <td class="text-center">
                                                {{ $product['qty'] }} Kg
                                                </td>
                                                <td class="text-center">
                                                <i class = "fas fa-rupee-sign rupie-X" style="font-size:12px;"></i>
                                                {{ $product['price'] }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <h4 class="heading-primary">Select Payment Method</h4>
                                    <form action="{{ route('cart.order.store') }}" method="post" id="storeOrder">
                                       @csrf
                                        <div class="item pannel-relative">
                                            <input type="radio" name="pamentOp" value="payumoney" id="payYouMoney" class="outline_none">
                                            <label for="payYouMoney" class="radio_pament">Pay by Pay You Money</label>
                                        </div>
                                        <div class="item pannel-relative">
                                            <input type="radio" name="pamentOp" value="craditcard"  id="creditCard" class="outline_none">
                                            <label for="creditCard" class="radio_pament">Pay by Credit Card</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pull-right">
                        <input type="button" value="Place Order" name="proceed" class="btn btn-primary" id="placeOrderBtn">
                    </div>
                </div>
                @else
                    <div class="checkout-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <form action="{{ route('cart.shipping.save') }}" id="formshipping" method="post" class="form-horizontal">
                        @csrf
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-top:0px;">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed">
                                            Shipping Address
                                        </a>
                                    </h4>
                                </div>
                                @if($errors->any())
                                    <div class = "alert alert-danger mt">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('message'))
                                    <div class = "alert alert-success mt">
                                        {{ session("message")}}
                                    </div>
                                @endif  
                                <div class="accordion-body">
                                    <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="firstName">First Name</label>
                                                    <input type="text" name="first_name" id="firstName"  class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="lastName">Last Name</label>
                                                    <input type="text" name="last_name" id="lastName" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="contactNo">Contact No</label>
                                                    <input type="text" name="contact" id="contactNo" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email">E-mail Id</label>
                                                    <input type="text" name="email" id="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="country">Country</label>
                                                    <select class="form-control" id="country" name="country">
                                                        <option value="india" selected>India</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="state">State</label>
                                                    <select class="form-control" id="state" name="state">
                                                        <option value="uttarpradesh" selected>Uttar Pradesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="city">City</label>
                                                    <select class="form-control" id="city" name="city">
                                                        <option value="prayagraj" selected>Prayagraj</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Address </label>
                                                    <input type="text" value="" name="address" class="form-control">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit"  class="btn btn-primary"  title="Save & Proceed" style="font-size:15px;">
                                <span style="margin-right:5px;">Save & Proceed</span>
								<i class="fa fa-angle-right ml-xs"></i>
                            </button>
                        </div>
                     </form>
                    </div>
                    @endif
                    <div class="checkout-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <h4 class="title">Cart Total</h4>
                        <table class="table cart-total">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>
                                        <strong>Cart Subtotal</strong>
                                    </th>
                                    <td>
                                        <strong><span class="amount"><i class="fas fa-rupee-sign rupie-X" style="font-size:12px;"></i>
                                        {{$cart->getTotalPrice()}}</span></strong>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>
                                        Shipping
                                    </th>
                                    <td>
                                    <i class="fas fa-rupee-sign rupie-X" style="font-size:12px;"></i> 20
                                        <input type="hidden" value="20" class="shipping-method" name="shipping_method">
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th>
                                        <strong>Order Total</strong>
                                    </th>
                                    <td>
                                        <strong><span class="amount">
                                        <i class="fas fa-rupee-sign rupie-X" style="font-size:12px;"></i>
                                        {{$cart->getTotalPrice() + 20}}</span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('productJs')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
       $(document).ready(function(){
          $('#placeOrderBtn').on('click', function(){
             if($('#creditCard').is(':checked') || $('#payYouMoney').is(':checked'))
             {
                 $('#storeOrder').submit();
             }else{
                swal({
                    text: "Please Select Pament Method!",
                    icon: "warning",
                    });
             }
          });
       });
  </script>

@endsection