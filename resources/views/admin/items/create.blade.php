@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-4">
        
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div>
                <h3 class="mb-0 text-dark fw-bold">Create Item</h3>
                <ol class="breadcrumb mb-0 mt-1">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.items.index') }}" class="text-decoration-none">Items</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
            <a href="{{ route('backend.items.index') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-box-open me-1"></i> Item Details
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{route('backend.items.store')}}" method="post" enctype="multipart/form-data" id="createForm">
                    @csrf
                    
                    <div class="row g-4">
                        <!-- Code No -->
                        <div class="col-md-6">
                            <label for="code_no" class="form-label fw-semibold">Code No</label>
                            <input type="text" name="code_no" id="code_no" class="form-control bg-light @error('code_no') is-invalid @enderror" value="{{ old('code_no') }}" placeholder="Enter item code">
                            @error('code_no')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" id="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter item name">
                            @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Ks</span>
                                <input type="text" name="price" id="price" class="form-control bg-light @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="0.00 Ks">
                                @error('price')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Discount -->
                        <div class="col-md-6">
                            <label for="discount" class="form-label fw-semibold">Discount</label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input type="text" name="discount" id="discount" class="form-control bg-light @error('discount') is-invalid @enderror" value="{{ old('discount') }}" placeholder="0">
                                @error('discount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-semibold">Category</label>
                            <select class="form-select bg-light @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">Choose Category...</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- In Stock -->
                        <div class="col-md-6">
                            <label for="in_stock" class="form-label fw-semibold">In Stock Status</label>
                            <select name="in_stock" id="in_stock" class="form-select bg-light @error('in_stock') is-invalid @enderror">
                                <option value="1" {{ old('in_stock') == '1' ? 'selected' : '' }}>Yes (Available)</option>
                                <option value="0" {{ old('in_stock') == '0' ? 'selected' : '' }}>No (Out of Stock)</option>
                            </select>
                            @error('in_stock')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-12">
                            <label for="image" class="form-label fw-semibold">Item Image</label>
                            <input type="file" accept="image/.jpg,.jpeg,.png,.webp" name="image" id="image" class="form-control bg-light @error('image') is-invalid @enderror">
                            <div class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, WEBP.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control bg-light @error('description') is-invalid @enderror" placeholder="Enter detailed description here...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn btn-primary px-5 shadow-sm" id="submitBtn">
                            <span class="btn-text">Save Item</span>
                            <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true" id="submitSpinner"></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // Loading animation on form submit
            $('#createForm').on('submit', function() {
                let btn = $('#submitBtn');
                btn.prop('disabled', true); // Disable button to prevent double-click
                btn.find('.btn-text').text('Saving...'); // Change button text
                btn.find('#submitSpinner').removeClass('d-none'); // Show the spinner
            });
        });
    </script>
@endsection