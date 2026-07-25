@extends('layouts.front')
@section('content')
        <!-- Header / Hero Banner -->
        <header class="hero-header py-5 shadow-sm">
            <div class="container px-4 px-lg-5 my-0">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder mb-3">Elevate Your Style</h1>
                    <p class="lead fw-normal text-white-45 mb-0">Discover unique products tailored for you</p>
                </div>
            </div>
        </header>

        <!-- Product Section -->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    @foreach ($items as $item)
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
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{$items->links()}}
                </div>

            </div>
        </section>
@endsection