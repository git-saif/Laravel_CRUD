@extends('layouts.app')

@section('content')
@section('title', 'CRUD9 - Sub=Sub-Category Edit')
<!-- Edit form -->
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Edit Sub-Sub-Category</li>
      </ul>
    </div>

    <div class="page-content">
      <div class="page-header">
        <h1>
          Edit Entry
          <small><i class="ace-icon fa fa-angle-double-right"></i> Update Existing Sub-Sub-Category</small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12 ">
              <div class="col-md-2"></div>

              <div class="col-md-8">
                <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                  <h4 class="widget-title" style="color: #fff;">Edit Sub-Sub-Category</h4>

                  <span class="widget-toolbar">
                    <a href="{{ route('dashboard.crud-9.index') }}" style="color: #fff;">
                      <i class="ace-icon fa fa-list"></i> Back to List
                    </a>
                  </span>
                </div>

                <!-- Edit Form Start -->
                <form action="{{ route('dashboard.crud-9.update', $crud9->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  {{-- Parent Category --}}
                  <div class="form-group mt-3">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control pt-2" required>
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ $cat->id == $crud9->subcategory->crud7_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  {{-- Parent Subcategory --}}
                  <div class="form-group">
                    <label for="crud8_id">Subcategory</label> 
                    <select id="crud8_id" name="crud8_id" class="form-control" required>
                      <option value="">-- Select Subcategory --</option>
                      @foreach($subcategories as $sub)
                      <option value="{{ $sub->id }}" {{ $sub->id == $crud9->crud8_id ? 'selected' : '' }}>
                        {{ $sub->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  {{-- Sub-Sub Category Name --}}
                  <div class="form-group">
                    <label for="name">Subcategory Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $crud9->name) }}" placeholder="Enter subcategory name" required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  {{-- Slug (auto-generated) --}}
                  <div class="form-group">
                    <label for="slug">Slug (Auto Generated)</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $crud9->slug) }}" readonly>
                  </div>

                  {{-- Serial Number --}}
                  <div class="form-group">
                    <label for="serial_no">Serial No</label>
                    <input type="number" name="serial_no" class="form-control @error('serial_no') is-invalid @enderror" value="{{ old('serial_no', $crud9->serial_no) }}" placeholder="Enter serial number" required>
                    @error('serial_no')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  {{-- Status --}}
                  <div class="form-group">
                    <label for="status">Status</label><br>
                    <label>
                      <input type="radio" name="status" value="active" {{ old('status', $crud9->status) == 'active' ? 'checked' : '' }}>
                      Active
                    </label>
                    &nbsp;&nbsp;
                    <label>
                      <input type="radio" name="status" value="inactive" {{ old('status', $crud9->status) == 'inactive' ? 'checked' : '' }}>
                      Inactive
                    </label>
                    @error('status')
                    <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>




                  <div class="form-actions center">
                    <button type="submit" class="btn btn-sm btn-success">
                      Update
                      <i class="ace-icon fa fa-check icon-on-right bigger-110"></i>
                    </button>

                    <a href="{{ route('dashboard.crud-9.index') }}" class="btn btn-sm btn-warning">
                      <i class="ace-icon fa fa-arrow-left bigger-110"></i> Back
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

{{-- AJAX script for nested dropdown --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function() {
    const $category = $('#category_id');
    const $sub = $('#crud8_id');

    function populateSubcategories(data, selectedId = null) {
      $sub.empty().append('<option value="">-- Select Subcategory --</option>');
      if (data.length) {
        data.forEach(item => {
          $sub.append(`<option value="${item.id}" ${item.id == selectedId ? 'selected':''}>${item.name}</option>`);
        });
        $sub.prop('disabled', false);
      } else {
        $sub.prop('disabled', true);
      }
    }

    $category.on('change', function() {
      const catId = $(this).val();
      if (!catId) {
        populateSubcategories([]);
        return;
      }

      $.getJSON('{{ route("dashboard.crud-9.subcategories", ":id") }}'.replace(':id', catId))
        .done(data => populateSubcategories(data))
        .fail(() => populateSubcategories([]));
    });

    // Trigger fetch for existing selected category on page load
    @if(isset($crud9))
    $category.trigger('change');
    // optionally pass selected subcategory id
    $.getJSON('{{ route("dashboard.crud-9.subcategories", ":id") }}'.replace(':id', '{{ $crud9->subcategory->crud7_id }}'))
      .done(data => populateSubcategories(data, '{{ $crud9->crud8_id }}'));
    @endif
  });

</script>



@endpush


