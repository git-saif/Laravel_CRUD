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
                <form action="{{ route('dashboard.crud-10.update', $crud10->id) }} " method="POST">
                  @csrf
                  @method('PUT')

                   <!-- Hidden input for redirect to show page after update -->
                   @if (request()->query('from') === 'show')
                   <input type="hidden" name="redirect_to_show" value="1">
                   @endif

                  {{-- Parent Category (From Crud7) --}}
                  <div class="mb-3">
                    <label>Category *</label>
                    <select name="crud7_id" id="crud7_id" class="form-control" required>
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ $crud10->crud7_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  {{-- Parent Subcategory (From Crud8) --}}
                  <div class="mb-3">
                    <label>Sub-Category</label>
                    <select name="crud8_id" id="crud8_id" class="form-control">
                      <option value="">-- Select Subcategory --</option>
                    </select>
                  </div>

                  {{-- Child Sub-Sub-category (From Crud9) --}}
                  <div class="mb-3">
                    <label>Sub-Sub-Category</label>
                    <select name="crud9_id" id="crud9_id" class="form-control">
                      <option value="">-- Select Sub-Subcategory --</option>
                    </select>
                  </div>

                  {{-- Post Serial --}}
                  <div class="mb-3">
                    <label>Post Serial *</label>
                    <input type="number" name="post_serial" class="form-control" value="{{ $crud10->post_serial }}" required>
                  </div>

                  {{-- Post Name --}}
                  <div class="mb-3">
                    <label>Post Name *</label>
                    <input type="text" name="post_name" class="form-control" value="{{ $crud10->post_name }}" required>
                  </div>

                  {{-- Post Title --}}
                  <div class="mb-3">
                    <label>Post Title *</label>
                    <input type="text" name="post_title" class="form-control" value="{{ $crud10->post_title }}" required>
                  </div>

                  {{-- Short Description --}}
                  <div class="mb-3">
                    <label>Short Description</label>
                    <textarea name="short_description" rows="3" class="form-control">{{ $crud10->short_description }}</textarea>
                  </div>

                  {{-- Post Content --}}
                  <div class="mb-3">
                    <label>Post Content *</label>
                    <textarea name="post" class="form-control" rows="6">{{ $crud10->post }}</textarea>
                  </div>

                  {{-- Status --}}
                  <div class="form-group" style="margin-top: 10px;">
                    <label>Status *</label>
                    <select name="status" class="form-select" required>
                      <option value="active" {{ $crud10->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $crud10->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>

                  {{-- Submit --}}
                  <div class="form-actions text-center mt-3">
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fa fa-save"></i> Save
                    </button>
                    <a href="{{ route('dashboard.crud-10.index') }}" class="btn btn-warning btn-sm">
                      <i class="fa fa-arrow-left"></i> Back
                    </a>
                  </div>

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

{{-- Nested Dropdown AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    const selectedCategory = '{{ $crud10->crud7_id }}';
    const selectedSubcategory = '{{ $crud10->crud8_id }}';
    const selectedSubsubcategory = '{{ $crud10->crud9_id }}';

    // 🟢 Load Subcategories when Category changes
    $('#crud7_id').on('change', function() {
      let categoryId = $(this).val();
      let $subcategory = $('#crud8_id');
      let $subsubcategory = $('#crud9_id');

      $subcategory.html('<option value="">-- Loading... --</option>');
      $subsubcategory.html('<option value="">-- Select Sub-Subcategory --</option>');

      if (categoryId) {
        $.ajax({
          url: `/dashboard/crud-10/get-subcategories/${categoryId}`
          , type: 'GET'
          , dataType: 'json'
          , success: function(data) {
            $subcategory.html('<option value="">-- Select Subcategory --</option>');
            $.each(data, function(key, item) {
              $subcategory.append(`<option value="${item.id}">${item.name}</option>`);
            });

            // যদি edit form এ আগেই কোনো subcategory selected থাকে, সেটি select করো
            if (selectedSubcategory) {
              $subcategory.val(selectedSubcategory).trigger('change');
            }
          }
        });
      } else {
        $subcategory.html('<option value="">-- Select Subcategory --</option>');
      }
    });

    // 🟢 Load Sub-Subcategories when Subcategory changes
    $('#crud8_id').on('change', function() {
      let subcategoryId = $(this).val();
      let $subsubcategory = $('#crud9_id');

      $subsubcategory.html('<option value="">-- Loading... --</option>');

      if (subcategoryId) {
        $.ajax({
          url: `/dashboard/crud-10/get-subsubcategories/${subcategoryId}`
          , type: 'GET'
          , dataType: 'json'
          , success: function(data) {
            $subsubcategory.html('<option value="">-- Select Sub-Subcategory --</option>');
            $.each(data, function(key, item) {
              $subsubcategory.append(`<option value="${item.id}">${item.name}</option>`);
            });

            // edit form এর জন্য আগেই select করা sub-sub-category সেট করো
            if (selectedSubsubcategory) {
              $subsubcategory.val(selectedSubsubcategory);
            }
          }
        });
      } else {
        $subsubcategory.html('<option value="">-- Select Sub-Subcategory --</option>');
      }
    });

    // 🟢 পেজ লোড হবার সময়ই category change ট্রিগার করো
    if (selectedCategory) {
      $('#crud7_id').trigger('change');
    }
  });

</script>

@endpush


