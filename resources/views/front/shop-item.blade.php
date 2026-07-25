@extends('layouts.front')
@section('content')
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    
                    <!-- Product Image -->
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0 rounded-4 shadow-sm" src="{{$item->image}}" alt="{{$item->name}}" />
                    </div>
                    
                    <!-- Product Details -->
                    <div class="col-md-6">
                        <div class="badge bg-primary text-white mb-2 px-3 py-2 rounded-pill">Code No: {{$item->code_no}}</div>
                        <h1 class="display-5 fw-bolder mb-3">{{$item->name}}</h1>
                        
                        <div class="fs-4 mb-4">
                            @if($item->discount > 0)
                                <span class="text-muted text-decoration-line-through me-2">{{$item->price}}</span>
                                <span class="fw-bold text-danger">{{$item->price - ($item->price*($item->discount/100))}} MMK</span>
                            @else 
                                <span class="fw-bold text-dark">{{$item->price}} MMK</span>
                            @endif
                        </div>
                        
                        <p class="lead text-secondary mb-4">{{$item->description}}</p>
                        
                        <div class="d-flex align-items-center">
                            <input class="form-control text-center me-3 qty rounded-pill border-secondary" id="inputQuantity" type="number" value="1" style="max-width: 4.5rem; height: 100%;" />
                            
                            <button class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm flex-shrink-0 addToCart" type="button" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $item->name }}" 
                                    data-price="{{ $item->price }}" 
                                    data-discount="{{ $item->discount }}" 
                                    data-image="{{ $item->image }}">
                                <i class="bi-cart-fill me-2"></i> Add to cart
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4 text-center">Related Products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    @foreach ($related_item as $item)
                        <div class="col mb-5">
                            <div class="card h-100 border-0 shadow-sm rounded-4 product-card overflow-hidden">
                                
                                <!-- Sale Badge -->
                                @if($item->discount > 0)
                                    <div class="badge bg-danger position-absolute shadow-sm" style="top: 1rem; right: 1rem; z-index: 1;">Sale</div>
                                @endif

                                <!-- Product image-->
                                <a href="{{route('shop-item', $item->id)}}">
                                    <img class="card-img-top product-img" src="{{$item->image}}" alt="{{$item->name}}">
                                </a>
                                
                                <!-- Product details-->
                                <div class="card-body p-4 text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder mb-2">
                                        <a href="{{route('shop-item', $item->id)}}" class="text-dark text-decoration-none">{{$item->name}}</a>
                                    </h5>
                                    
                                    <!-- Product price-->
                                    <div class="fs-6 mb-3">
                                        @if($item->discount > 0)
                                            <span class="text-muted text-decoration-line-through me-2">{{$item->price}}</span>
                                            <span class="fw-bold text-danger">{{$item->price - ($item->price*($item->discount/100))}} MMK</span>
                                        @else 
                                            <span class="fw-bold text-dark">{{$item->price}} MMK</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="d-grid gap-2">
                                        <input type="hidden" name="" class="qty" value="1">
                                        
                                        <!-- Add to Cart Button -->
                                        <button class="btn btn-primary rounded-pill fw-bold shadow-sm addToCart" 
                                                data-id="{{ $item->id }}" 
                                                data-name="{{ $item->name }}" 
                                                data-price="{{ $item->price }}" 
                                                data-discount="{{ $item->discount }}" 
                                                data-image="{{ $item->image }}">
                                            <i class="bi-cart-plus me-1"></i> Add to Cart
                                        </button>
                                        
                                        <!-- View Detail Button -->
                                        <a class="btn btn-outline-primary rounded-pill btn-sm fw-bold" href="{{route('shop-item', $item->id)}}">
                                            Detail
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
@endsection