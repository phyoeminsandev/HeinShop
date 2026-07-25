@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-4">
        
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <div>
                <h3 class="mb-0 text-dark fw-bold">Items Management</h3>
                <ol class="breadcrumb mb-0 mt-1">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Items</li>
                </ol>
            </div>
            <a href="{{route('backend.items.create')}}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Create Item
            </a>
        </div>

        <!-- Data Table Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="fas fa-list me-1"></i> Item List
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Code No</th>
                                <th class="text-start">Name</th>
                                <th>Price</th>
                                <th>In Stock</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td class="text-muted">{{$i++}}</td>
                                    <td><span class="fw-bold text-secondary">{{$item->code_no}}</span></td>
                                    <td class="text-start fw-semibold">{{$item->name}}</td>
                                    <td>{{ number_format($item->price) }} Ks</td>
                                    <td>
                                        @if($item->in_stock > 0)
                                            <span class="badge bg-success rounded-pill px-3 py-2">{{$item->in_stock}}</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-2">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-info text-dark">{{$item->category->name}}</span></td>
                                    <td>
                                        <a href="{{ route('backend.items.edit',$item->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm delete" data-id="{{ $item->id }}" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-light border-0">
                <h6 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-trash-alt me-2"></i>Delete Item
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="fs-6 text-dark mb-0">Are you sure? This cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light shadow-sm px-3" data-bs-dismiss="modal">Cancel</button>
                <form action="" id="deleteForm" method="post">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger shadow-sm px-4" id="deleteBtn">
                        <span class="btn-text">Delete</span>
                        <span class="spinner-border spinner-border-sm d-none ms-1" role="status" aria-hidden="true" id="deleteSpinner"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('tbody').on('click', '.delete', function(){
                let id = $(this).data('id');
                $('#deleteForm').attr('action', `/backend/items/${id}`);
                $('#deleteModal').modal('show');
                
                $('#deleteBtn').prop('disabled', false);
                $('#deleteBtn .btn-text').text('Delete');
                $('#deleteSpinner').addClass('d-none');
            });
            $('#deleteForm').on('submit', function() {
                let btn = $('#deleteBtn');
                btn.prop('disabled', true);
                btn.find('.btn-text').text('Deleting...'); 
                btn.find('#deleteSpinner').removeClass('d-none'); 
            });
        });
    </script>
@endsection