@extends('admin.layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Add package </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Packages</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add package </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">



                        <form class="forms-sample" action="{{ route('packages.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputName1">Name OF package</label>
                                <input type="text" class="form-control" name='name' id="name"
                                    placeholder="Name ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Description</label>
                                <input type="text" class="form-control" name='description' id="description"
                                    placeholder="description ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Percent</label>
                                <input type="number" max="100" min="1" class="form-control" name='percent'
                                    id="percent" placeholder="percent">
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <select class="form-control" name="duration" id="duration">
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="expire_at">Expire At</label>
                                <input type="date" class="form-control" name="expire_at" id="expire_at"
                                    min="{{ date('Y-m-d') }}">
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Submit</button>

                            <a href="{{ route('packages.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
