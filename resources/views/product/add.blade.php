@extends('layouts.app')
@section('title', 'Product')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Product</h5>
                    <form id="add-product-form">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" id="productName" name="name" value="{{ old('name') }}" class="form-control">
                            <div class="text-danger" id="nameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Product Price</label>
                            <input type="text" id="productPrice" name="price" value="{{ old('price') }}" class="form-control">
                            <div class="text-danger" id="priceError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea id="productDescription" name="description" class="form-control"> {{ old('description') }}</textarea>
                            <div class="text-danger" id="descriptionError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
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
    document.getElementById('add-product-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        document.getElementById('nameError').innerText = '';
        document.getElementById('descriptionError').innerText = '';
        document.getElementById('priceError').innerText = '';
        document.getElementById('errorMessage').style.display = 'none';

        const formData = new FormData(this);

        axios.post('/api/store/product', formData)
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
                    document.getElementById('errorMessage').innerText = 'An error occurred while saving the product.';
                    document.getElementById('errorMessage').style.display = 'block';
                }
            });
    });

</script>
@endpush
