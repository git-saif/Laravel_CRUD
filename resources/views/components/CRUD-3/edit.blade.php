@extends('layouts.app')

@section('content')
@section('title', 'Smart ERP - Edit Entry')

<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Edit Entry</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Edit Entry
                    <small><i class="ace-icon fa fa-angle-double-right"></i> Update Existing Data</small>
                </h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-2"></div>

                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="table-header d-flex justify-content-between align-items-stretch">
                                        <span>Edit Entry</span>
                                        <a href="{{ route('dashboard.crud-3.index') }}"
                                            class="pull-right btn btn-sm btn-white h-100 d-flex align-items-center"
                                            style="margin-left: auto;">
                                            <i class="fa fa-list me-1"></i> Back to List
                                        </a>
                                    </div>
                                </div>

                                <!-- Edit Form Start -->
                                <form action="{{ route('dashboard.crud-3.update', $crud3->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $crud3->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone No</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $crud3->phone }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $crud3->email }}" required>
                                    </div>

                                    <!-- Current Images Section -->
                                    <div class="form-group">
                                        <label>Current Images</label><br>
                                        @php
                                            $existingImages = is_array($crud3->image)
                                                ? $crud3->image
                                                : json_decode($crud3->image, true) ?? [];
                                        @endphp

                                        @if (count($existingImages) > 0)
                                            <div class="row mb-3">
                                                @foreach ($existingImages as $index => $image)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="card">
                                                            <img src="{{ asset($image) }}" class="card-img-top"
                                                                style="height: 150px; object-fit: cover;">
                                                            <div class="card-body p-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="delete_images[]"
                                                                        value="{{ $image }}"
                                                                        id="delete_img_{{ $index }}">
                                                                    <label class="form-check-label"
                                                                        for="delete_img_{{ $index }}">
                                                                        Delete
                                                                    </label>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <label class="btn btn-sm btn-outline-primary w-100">
                                                                        Change Image
                                                                        <input type="file"
                                                                            name="replace_images[{{ $index }}]"
                                                                            class="d-none replace-image"
                                                                            data-index="{{ $index }}">
                                                                    </label>
                                                                </div>
                                                                <input type="hidden" name="existing_images[]"
                                                                    value="{{ $image }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No images uploaded.</p>
                                        @endif
                                    </div>

                                    <!-- New Images Section -->
                                    <div class="form-group">
                                        <label>Add New Images</label>
                                        <div id="new-images-container">
                                            <div class="input-group mb-2">
                                                <input type="file" name="new_images[]" class="form-control">
                                                <button type="button" class="btn btn-danger remove-new-image">× Remove
                                                    Field</button>
                                            </div>
                                        </div>
                                        <button type="button" id="add-new-image" class="btn btn-sm btn-primary mt-2">
                                            <i class="fa fa-plus"></i> Add More Images
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label><br>
                                        <label>
                                            <input type="radio" name="status" value="active"
                                                {{ $crud3->status == 'active' ? 'checked' : '' }}> Active
                                        </label>
                                        <label>
                                            <input type="radio" name="status" value="inactive"
                                                {{ $crud3->status == 'inactive' ? 'checked' : '' }}> Inactive
                                        </label>
                                    </div>

                                    <div class="form-actions center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ace-icon fa fa-save bigger-110"></i>
                                            Update
                                        </button>

                                        <a href="{{ route('dashboard.crud-3.index') }}" class="btn btn-warning">
                                            <i class="ace-icon fa fa-arrow-left bigger-110"></i>
                                            Back
                                        </a>
                                    </div>
                                </form>
                                <!-- Edit Form End -->
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Add new image field
    $('#add-new-image').click(function() {
        $('#new-images-container').append(`
            <div class="input-group mb-2">
                <input type="file" name="new_images[]" class="form-control">
                <button type="button" class="btn btn-danger remove-new-image">× Remove Field</button>
            </div>
        `);
    });

    // Remove new image field
    $(document).on('click', '.remove-new-image', function() {
        $(this).closest('.input-group').remove();
    });

    // Preview image when replacing
    $(document).on('change', '.replace-image', function(e) {
        const index = $(this).data('index');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $(`#delete_img_${index}`).closest('.card').find('img').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
