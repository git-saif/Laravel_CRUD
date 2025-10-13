@extends('layouts.app')

@section('content')
@section('title', 'CRUD10 - Post Edit')
<!-- Edit form -->
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Edit Post</li>
      </ul>
    </div>

    <div class="page-content">
      <div class="page-header">
        <h1>
          Edit Entry
          <small><i class="ace-icon fa fa-angle-double-right"></i> Update Existing Post</small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12 ">
              <div class="col-md-2"></div>

              <div class="col-md-8">
                <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                  <h4 class="widget-title" style="color: #fff;">Edit Post</h4>

                  <span class="widget-toolbar">
                    <a href="{{ route('dashboard.crud-9.index') }}" style="color: #fff;">
                      <i class="ace-icon fa fa-list"></i> Back to List
                    </a>
                  </span>
                </div>

                <!-- Edit Form Start -->
                <form action="{{ route('dashboard.crud-10.update', $crud10->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label>Category *</label>
                    <select name="crud7_id" class="form-control" required>
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ $crud10->crud7_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label>Sub-Category</label>
                    <select name="crud8_id" class="form-control">
                      <option value="">-- Optional --</option>
                      @foreach($subcategories as $sub)
                      <option value="{{ $sub->id }}" {{ $crud10->crud8_id == $sub->id ? 'selected' : '' }}>
                        {{ $sub->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label>Sub-Sub-Category</label>
                    <select name="crud9_id" class="form-control">
                      <option value="">-- Optional --</option>
                      @foreach($subsubcategories as $subsub)
                      <option value="{{ $subsub->id }}" {{ $crud10->crud9_id == $subsub->id ? 'selected' : '' }}>
                        {{ $subsub->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label>Post Serial *</label>
                    <input type="number" name="post_serial" class="form-control" value="{{ $crud10->post_serial }}" required>
                  </div>

                  <div class="mb-3">
                    <label>Post Name *</label>
                    <input type="text" name="post_name" class="form-control" value="{{ $crud10->post_name }}" required>
                  </div>

                  <div class="mb-3">
                    <label>Post Title *</label>
                    <input type="text" name="post_title" class="form-control" value="{{ $crud10->post_title }}" required>
                  </div>

                  <div class="mb-3">
                    <label>Short Description</label>
                    <textarea name="short_description" class="form-control">{{ $crud10->short_description }}</textarea>
                  </div>

                  <div class="mb-3">
                    <label>Post Content *</label>
                    <textarea name="post" class="form-control" rows="5">{{ $crud10->post }}</textarea>
                  </div>

                  <div class="mb-3">
                    <label>Status *</label>
                    <select name="status" class="form-control" required>
                      <option value="active" {{ $crud10->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $crud10->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-success">Update Post</button>
                  <a href="{{ route('dashboard.crud-10.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

                <!-- Edit Form End -->
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div><!-- /.col -->
      </div>
    </div><!-- /.page-content -->
  </div>
</div>
<!-- /.main-content -->
@endsection


@push('scripts')

{{-- Slug Auto Generator Script --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('keyup', function() {
      let slug = nameInput.value
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // remove special chars
        .replace(/\s+/g, '-') // replace spaces with -
        .replace(/-+/g, '-'); // collapse multiple -
      slugInput.value = slug;
    });
  });

  nameInput.addEventListener('input', function() {
    // same slug generation logic
  });

</script>

@endpush


