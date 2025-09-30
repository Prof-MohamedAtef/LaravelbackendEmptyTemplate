@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">PACKAGES</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">PACKAGES</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('packages.create') }}" class="btn btn-primary">Add package</a>
                        </div>
                        @if (session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('success') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                });
                            </script>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Description </th>
                                    <th> Percent </th>
                                    <th> Duration </th>
                                    <th> State </th>
                                    <th> Exiper At </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $key => $package)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $package->name }}</td>
                                        <td> {{ $package->description }}</td>
                                        <td> {{ $package->percent }}</td>
                                        <td> {{ $package->duration }}</td>
                                        <td>{{ $package->status ? 'true' : 'false' }}</td>
                                        <td> {{ $package->expire_at }}</td>


                                        <td>
                                            <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="confirmDelete(event)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $packages->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function confirmDelete(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(event.target.closest('form').action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                _method: 'DELETE'
                            })
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The city has been deleted.',
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'There was an error deleting the city.',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endsection
