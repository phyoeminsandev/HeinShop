@extends('layouts.front')
@section('content')
    <div class="container my-5 py-5">
        
        <h2 class="fw-bolder mb-4 text-center">Shopping Cart</h2>
        
        <!-- Cart Table Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3">Item Name</th>
                                <th class="py-3">Item Image</th>
                                <th class="py-3">Item Price</th>
                                <th class="py-3">Item Discount</th>
                                <th class="py-3">Qty</th>
                                <th class="py-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" class="border-top-0">
                            <!-- JS မှ Data များ ဝင်လာမည့်နေရာ -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Checkout Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <h4 class="fw-bold mb-4 border-bottom pb-3">Checkout Details</h4>
                        
                        @guest
                            <div class="text-center py-4">
                                <p class="text-muted mb-4">You need to login first to place an order.</p>
                                <a href="/login" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">Login to Continue</a>
                            </div>
                        @else
                            <form method="post" id="paymentForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    
                                    <div class="col-md-6">
                                        <label for="payment_slip" class="form-label fw-bold">Payment Slip</label>
                                        <input type="file" name="payment_slip" id="payment_slip" class="form-control rounded-3 py-2">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-select rounded-3 py-2">
                                            <option value="">Choose payment method</option>
                                            @foreach ($payments as $payment)
                                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="address" class="form-label fw-bold">Delivery Address</label>
                                        <textarea name="address" id="address" class="form-control rounded-3" rows="3" placeholder="Enter your full address here..."></textarea>
                                    </div>
                                    
                                    <div class="col-12 text-end mt-4">
                                        <button class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm" id="order-now" type="submit">
                                            <i class="bi-check-circle me-2"></i> Order Now
                                        </button>
                                    </div>
                                    
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#paymentForm').on('submit',function(e){
                e.preventDefault();
                var formData = new FormData(this);
                // console.log(formData);
                
                let itemString = localStorage.getItem('shops');
                formData.append('orderItems', itemString);
                
                $.ajax({
                    type: 'POST',
                    url: "{{ route('orderNow') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        // console.log(response);
                        
                        if(response){
                            alert('Order Successful');
                            localStorage.removeItem('shops'); 
                            location.href = '/';
                        }
                    },
                    error: function(err) {
                        alert('Something went wrong. Please try again.');
                        console.log(err);
                    }
                })
            })
        })
    </script>
@endsection