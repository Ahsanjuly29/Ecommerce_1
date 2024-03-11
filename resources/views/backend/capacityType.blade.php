@extends('backend.layouts.master')

<!-- Plugin; css for this page -->
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
<!-- End plugin css for this page -->

@section('main-content')
    <div class="row">
        <div class="col-md-6 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <a class="btn btn-outline-light" href="{{ route('capacity-type-index') }}">
                            Add new Capacity Type
                        </a>
                    </h4>
                    {{-- <p>comemnts whats this capacity type</p> --}}

                    <p>
                        @if (session('success'))
                            <span>
                                {{ session('success') }}
                            </span>
                        @elseif(session('error'))
                            <span class="invalid-feedback d-block">
                                {{ session('error') }}
                            </span>
                        @enderror
                </p>

                @if (empty($editCapacity))
                    <form action="{{ route('capacity-type-store') }}" class="form-group" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control text-white" placeholder="ex. kg, W, V, mAh"
                                name="slug" id="slug">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Create New Value</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('capacity-type-update', $editCapacity) }}" class="form-group" method="POST">
                        @method('PUT') @csrf

                        <div class="input-group">
                            <input type="text" class="form-control text-white" placeholder="ex. kg, W, V, mAh"
                                name="slug" id="slug" value="{{ $editCapacity->slug }}">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Update New Value</button>
                            </div>
                        </div>
                    </form>
                @endif


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 offset-md-2 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Capacity Types</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Name</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($capacityTypes as $capacityType)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-danger">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input checkboxes"
                                                    name="id" value="{{ $capacityType->id }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $capacityType->created_at ?? '--' }}</td>
                                    <td class="text-center">{{ $capacityType->slug }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary btn-md"
                                            href="{{ route('capacity-type-index', $capacityType->id) }}">
                                            Edit
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-md mr-2 delete-btn"
                                            data-id="{{ $capacityType->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="10">
                                    <button id="multiple_delete_btn" class="btn btn-danger btn-md mr-2 d-none"
                                        type="submit">
                                        Delete all
                                    </button>

                                    <form action="{{ route('capacity-type-delete') }}" method="post" id="delete_form">
                                        @csrf @method('delete')
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<!-- End plugin js for this page -->
@endsection

@section('custom-js')
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<script src="{{ asset('assets/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<script src="{{ asset('assets/custom/delete.js') }}"></script>
@endsection
