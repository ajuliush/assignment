@extends('layouts.app')
@section('title', 'User')
@section('content')
@include('message')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">User List</h5>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Add</a>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </form>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->name }}y</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="javascript:void(0)" data-id="3" class="btn btn-danger btn-sm delete-user">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-user').forEach(function(button) {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?'
                    , text: "You won't be able to revert this!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, create a form and submit it
                        const form = document.createElement('form');
                        form.action = `{{ url('delete') }}/${userId}`;
                        form.method = 'POST';

                        // Add CSRF token input
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';
                        form.appendChild(csrfInput);

                        // Add method spoofing input for DELETE method
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);

                        // Append the form to the body and submit it
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });

</script>
@endpush
