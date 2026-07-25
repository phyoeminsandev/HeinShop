@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-4">
        
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div>
                <h3 class="mb-0 text-dark fw-bold">Edit Item</h3>
                <ol class="breadcrumb mb-0 mt-1">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.items.index') }}" class="text-decoration-none">Items</a></li>
                    <li class="breadcrumb-item active">Edit Item</li>
                </ol>
            </div>
            <a href="{{ route('backend.items.index') }}" class="btn btn-outline-danger shadow-sm">
                <i class="fas fa-times me-1"></i> Cancel
            </a>
        </div>

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-edit me-1"></i> Item Details
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{route('backend.items.update',$item->id)}}" method="post" enctype="multipart/form-data" id="editItemForm">
                    @csrf
                    @method('put')

                    <!-- Row 1 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code_no" class="form-label fw-semibold">Code No</label>
                            <input type="text" name="code_no" id="code_no" class="form-control bg-light @error('code_no') is-invalid @enderror" value="{{$item->code_no}}">
                            @error('code_no')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" id="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{$item->name}}">
                            @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0">Ks</span>
                                <input type="text" name="price" id="price" class="form-control bg-light border-start-0 @error('price') is-invalid @enderror" value="{{$item->price}}">
                            </div>
                            @error('price')
                                <div class="text-danger small mt-1">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <label for="discount" class="form-label fw-semibold">Discount</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0">%</span>
                                <input type="text" name="discount" id="discount" class="form-control bg-light border-start-0 @error('discount') is-invalid @enderror" value="{{$item->discount}}">
                            </div>
                            @error('discount')
                                <div class="text-danger small mt-1">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <label for="in_stock" class="form-label fw-semibold">In Stock</label>
                            <select name="in_stock" id="in_stock" class="form-select bg-light @error('in_stock') is-invalid @enderror">
                                <option value="1" {{ $item->in_stock == 1 ? 'selected':''}}>Yes</option>
                                <option value="0" {{ $item->in_stock == 0 ? 'selected':''}}>No</option>
                            </select>
                            @error('in_stock')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-semibold">Category</label>
                            <select class="form-select bg-light @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">Choose....</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ $item->category_id == $category->id?'selected':''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Item Image</label>
                        <div class="card shadow-none border">
                            <div class="card-header bg-light border-bottom-0 pt-3 pb-0">
                                <ul class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active fw-semibold" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Current Image</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold" id="new_image-tab" data-bs-toggle="tab" data-bs-target="#new_image-tab-pane" type="button" role="tab" aria-controls="new_image-tab-pane" aria-selected="false">Upload New</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body border-top">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active py-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                        <img src="{{ $item->image }}" class="img-thumbnail shadow-sm" style="max-height: 200px; object-fit: cover;" alt="Current Item Image">
                                        <input type="hidden" name="old_image" id="old_image" value="{{ $item->image }}">
                                    </div>
                                    <div class="tab-pane fade py-3" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab" tabindex="0">
                                        <input type="file" accept="image/.jpg,.jpeg,.png,.webp" name="image" id="image" class="form-control bg-light @error('image') is-invalid @enderror">
                                        <small class="text-muted mt-2 d-block">Recommended formats: .jpg, .png, .webp</small>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control bg-light @error('description') is-invalid @enderror">{{$item->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm" id="updateBtn">
                            <i class="fas fa-save me-1" id="saveIcon"></i>
                            <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true" id="updateSpinner"></span>
                            <span class="btn-text">Update Item</span>
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
            //Click Form Submit show Loading Animation 
            $('#editItemForm').on('submit', function() {
                let btn = $('#updateBtn');
                btn.prop('disabled', true); 
                btn.find('.btn-text').text('Updating...'); 
                btn.find('#saveIcon').addClass('d-none'); 
                btn.find('#updateSpinner').removeClass('d-none'); 
                
                this.submit();
            });
        });
    </script>
@endsection