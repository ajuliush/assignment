@extends('layouts.app')
@section('title', 'Product')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Product</h5>
                    <form id="edit-product-form" method="POST">
                        @csrf
                        <input type="hidden" id="product-id" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                            <div class="text-danger" id="nameError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                            <div class="text-danger" id="priceError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                            <div class="text-danger" id="descriptionError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>

                    <div id="errorMessage" class="alert alert-danger mt-3" style="display: none;"></div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    document.getElementById('edit-product-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        document.getElementById('nameError').innerText = '';
        document.getElementById('descriptionError').innerText = '';
        document.getElementById('priceError').innerText = '';
        document.getElementById('errorMessage').style.display = 'none';

        const formData = new FormData(this);
        const productId = document.getElementById('product-id').value;

        // Log form data to console for debugging
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        axios.post(`/api/product/${productId}`, formData)
            .then(function(response) {
                const redirectUrl = response.data.redirect;
                const message = encodeURIComponent(response.data.message); // Encode the message

                // Redirect to product-fetch page with the success message as a query parameter
                window.location.href = `${redirectUrl}?message=${message}`;
            })
            .catch(function(error) {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;

                    // Display validation errors
                    if (errors.name) {
                        document.getElementById('nameError').innerText = errors.name[0];
                    }
                    if (errors.description) {
                        document.getElementById('descriptionError').innerText = errors.description[0];
                    }
                    if (errors.price) {
                        document.getElementById('priceError').innerText = errors.price[0];
                    }
                } else {
                    // Show a general error message
                    document.getElementById('errorMessage').innerText = 'An error occurred while updating the product.';
                    document.getElementById('errorMessage').style.display = 'block';
                }
            });
    });

</script>

@endpush
