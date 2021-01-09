
@extends('layouts.app')
@section('content')
   
<!-- Main Content -->
<div class="custum-container">
    <div id="content" class="site-content">
				<!-- Breadcrumb -->
				<div id="breadcrumb">
					<div class="container">
						<h2 class="title">Shopping Cart</h2>
						
						<ul class="breadcrumb">
							<li><a href="#" title="Home">Home</a></li>
							<li><span>Shopping Cart</span></li>
						</ul>
					</div>
				</div>
			
				<div class="container">
					<div class="page-cart">
						<div class="table-responsive">
							<table class="cart-summary table table-bordered">
								<thead>
									<tr>
										<th class="width-20">&nbsp;</th>
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
                                            <td class="product-remove">
											  <form action="{{ route('cart.remove', $product) }}" method = "POST">
											     @csrf
												  <button type="submit" title="Remove this item" class="remove" style = "border:none">
                                                    <i class="fa fa-times"></i>
                                                </button>
											  </form>
                                               
                                            </td>
                                            <td>
                                                <a href="product-detail-left-sidebar.html">
                                                    <img width="80" alt="Product Image" class="img-responsive" src="{{asset('storage/'.$product['product']->thumbnail)}}">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="product-detail-left-sidebar.html" class="product-name text-capitalize">Organic {{ $product['product']->title }}</a>
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
								
								<tfoot>
									<tr class="cart-total">
										<td rowspan="3" colspan="3"></td>
										<td colspan="2" class="text-right">Total products</td>
										<td colspan="1" class="text-center">{{ $cart->getTotalQty()}}</td>
									</tr>
									<tr class="cart-total">
										<td colspan="2" class="text-right">Shipping charge</td>
										<td colspan="1" class="text-center"><i class = "fas fa-rupee-sign rupie-X" style="font-size:12px;"></i> 20</td>
									</tr>
									<tr class="cart-total">
										<td colspan="2" class="total text-right">Total</td>
										<td colspan="1" class="total text-center">
                                        <i class = "fas fa-rupee-sign rupie-X" style="font-size:12px;"></i>    
                                        {{ $cart->getTotalPrice()+20}}</td>
									</tr>
								</tfoot>
							</table>
						</div>
						
						<div class="checkout-btn">
							<a href="{{ route('cart.shipping') }}" class="btn btn-primary pull-right" title="Proceed to checkout">
								<span>Proceed to checkout</span>
								<i class="fa fa-angle-right ml-xs"></i>
							</a>
						</div>
					</div>
				</div>
            </div>
</div>
    
            
@endsection