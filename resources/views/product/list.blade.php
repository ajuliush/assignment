@extends('layouts.app')
@section('title', 'Product')
@section('content')
@if(request()->query('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ htmlspecialchars(request()->query('message')) }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Product List</h5>
                        <a href="{{ route('product-create') }}" class="btn btn-primary btn-sm">Add</a>
                    </div>

                    <!-- Search Form -->
                    {{-- <form method="GET" action="" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </form> --}}

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="product-table-body">
                                <!-- Dynamic content will be inserted here -->
                            </tbody>
                        </table>
                        <!-- Pagination Controls -->
                        <div id="pagination-controls" class="mt-4">
                            <!-- Dynamic pagination links will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    function fetchProducts(page = 1) {
        axios.get(`/api/product?page=${page}`)
            .then(function(response) {
                const products = response.data.products || [];
                const message = response.data.message || 'No products found!';
                const pagination = response.data.pagination || {};
                const tableBody = document.getElementById('product-table-body');
                const paginationControls = document.getElementById('pagination-controls');

                tableBody.innerHTML = ''; // Clear previous content
                paginationControls.innerHTML = ''; // Clear pagination controls

                if (products.length === 0) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td colspan="5" class="text-center">${message}</td>
                `;
                    tableBody.appendChild(row);
                } else {
                    products.forEach(function(product, index) {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                        <th scope="row">${index + 1}</th>
                        <td>${product.name}</td>
                        <td>${product.description}</td>
                        <td>${product.price}</td>
                        <td>
                            <button class="btn btn-primary" onclick="editProduct(${product.id})">Edit</button>
                            <button class="btn btn-danger" onclick="deleteProduct(${product.id})">Delete</button>
                        </td>
                    `;

                        tableBody.appendChild(row);
                    });

                    // Create pagination links
                    for (let i = 1; i <= pagination.last_page; i++) {
                        const pageLink = document.createElement('button');
                        pageLink.innerText = i;
                        pageLink.classList.add('btn', 'btn-secondary', 'mx-1');
                        if (i === pagination.current_page) {
                            pageLink.classList.add('active');
                        }

                        pageLink.addEventListener('click', function() {
                            fetchProducts(i);
                        });

                        paginationControls.appendChild(pageLink);
                    }
                }
            })
            .catch(function(error) {
                console.error('Error fetching products:', error.message);

                const tableBody = document.getElementById('product-table-body');
                const row = document.createElement('tr');
                row.innerHTML = `
                <td colspan="5" class="text-center">${error.response ? error.response.data.message : 'Error fetching products'}</td>
            `;
                tableBody.appendChild(row);
            });
    }

    function editProduct(id) {
        // Redirect to an edit page or show an edit form
        window.location.href = `/api/product/${id}`;
    }

    function deleteProduct(productId) {
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Make DELETE request to the API endpoint
                axios.delete(`/api/product/${productId}`)
                    .then(function(response) {
                        Swal.fire({
                            title: 'Deleted!'
                            , text: 'The product has been deleted.'
                            , icon: 'success'
                            , timer: 2000
                            , showConfirmButton: false
                        }).then(() => {
                            fetchProducts();
                            // location.reload(); 
                        });
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Failed!'
                            , 'There was a problem deleting the product.'
                            , 'error'
                        );
                        console.error('Error deleting product:', error.message);
                    });
            }
        });
    }

    // Initial fetch for page 1
    fetchProducts();

    // Remove the query parameter from the URL after displaying the message
    window.history.replaceState({}, document.title, window.location.pathname);

</script>
@endpush
