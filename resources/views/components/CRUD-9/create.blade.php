@extends('layouts.app')

@section('content')
@section('title', 'CRUD9 - Sub-Sub-Category Create')

<!-- Table is here -->
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i>
          <a href="#">Home</a>
        </li>

        <li>
          <a href="#">Tables</a>
        </li>
        <li class="active">Create New Sub-Sub-Category</li>
      </ul><!-- /.breadcrumb -->

      <div class="nav-search" id="nav-search">
        <form class="form-search">
          <span class="input-icon">
            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
            <i class="ace-icon fa fa-search nav-search-icon"></i>
          </span>
        </form>
      </div><!-- /.nav-search -->
    </div>

    <div class="page-content">

      <div class="page-header">
        <h1>
          Tables
          <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Create New Sub-Sub-Category
          </small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->



          <div class="row">
            <div class="col-xs-12 ">
              <div class="col-md-2"></div>

              <div class="col-md-8">
                <div class="clearfix">
                  <div class="pull-right tableTools-container"></div>
                </div>
                <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                  <h4 class="widget-title" style="color: #fff;">Create Sub-Sub-Category</h4>

                  <span class="widget-toolbar">
                    <a href="{{ route('dashboard.crud-9.index') }}" style="color: #fff;">
                      <i class="ace-icon fa fa-plus"></i> Go To Index
                    </a>
                  </span>
                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <form action="{{ route('dashboard.crud-9.store') }}" method="POST">
                  @csrf

                  {{-- Parent Category (From Crud7) --}}
                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ isset($selectedCategory) && $selectedCategory == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>


                  {{-- Parent Subcategory (From Crud8) --}}
                  <div class="form-group">
                    <label for="crud8_id">Subcategory</label>
                    <select id="crud8_id" name="crud8_id" class="form-control" disabled>
                      <option value="">-- Select Subcategory --</option>

                      {{-- ✅ Only loop if $subcategories is defined and not empty --}}
                      @isset($subcategories)
                      @foreach($subcategories as $sub)
                      <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                      @endforeach
                      @endisset

                    </select>
                  </div>




                  {{-- Sub-Sub Category Name --}}
                  <div class="form-group">
                    <label for="name">Sub-Sub Category Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Slug (auto-generated) --}}
                  <div class="form-group">
                    <label for="slug">Slug (Auto)</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" readonly>
                  </div>

                  {{-- Serial --}}
                  <div class="form-group">
                    <label for="serial_no">Serial No</label>
                    <input type="number" name="serial_no" class="form-control @error('serial_no') is-invalid @enderror" value="{{ old('serial_no') }}" required>
                    @error('serial_no') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>


                  {{-- Status --}}
                  <div class="form-group">
                    <label for="status">Status</label><br>
                    <label>
                      <input type="radio" name="status" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                      Active
                    </label>
                    &nbsp;&nbsp;
                    <label>
                      <input type="radio" name="status" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                      Inactive
                    </label>
                    @error('status')
                    <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  {{-- Action Buttons --}}
                  <div class="form-actions center mt-3">
                    <button type="submit" class="btn btn-sm btn-success">
                      Save
                      <i class="ace-icon fa fa-save bigger-110"></i>
                    </button>

                    <a href="{{ route('dashboard.crud-9.index') }}" class="btn btn-sm btn-warning">
                      <i class="ace-icon fa fa-arrow-left bigger-110"></i> Back
                    </a>
                  </div>


                </form>

                {{-- ফর্ম শেষ --}}
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>

          <!-- PAGE CONTENT ENDS -->
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
    $(function() {

      const $category = $('#category_id');
      const $sub = $('#crud8_id');

      // Helper: populate subcategory dropdown
      function populateSubcategories(data) {
        $sub.empty().append('<option value="">-- Select Subcategory --</option>');
        if (data.length) {
          data.forEach(item => $sub.append(`<option value="${item.id}">${item.name}</option>`));
          $sub.prop('disabled', false);
        } else {
          $sub.prop('disabled', true);
        }
      }

      // Function to fetch subcategories
      function fetchSubcategories(categoryId) {
        if (!categoryId) {
          populateSubcategories([]);
          return;
        }

        $.getJSON('{{ route("dashboard.crud-9.subcategories", ":id") }}'.replace(':id', categoryId))
          .done(data => populateSubcategories(data))
          .fail(() => populateSubcategories([]));
      }

      // On category change
      $category.on('change', function() {
        fetchSubcategories($(this).val());
      });

      // Trigger on page load if old selected category exists
      @if(isset($selectedCategory))
      fetchSubcategories('{{ $selectedCategory }}');
      @endif

    });

  </script>








@endpush

