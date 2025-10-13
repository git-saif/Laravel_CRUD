@extends('layouts.app')

@section('content')
@section('title', 'CRUD10 - Post Create')

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
        <li class="active">Create New Post</li>
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
            Create New Post
          </small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->

          @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <div class="row">
            <div class="col-xs-12 ">
              <div class="col-md-2"></div>

              <div class="col-md-8">
                <div class="clearfix">
                  <div class="pull-right tableTools-container"></div>
                </div>
                <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                  <h4 class="widget-title" style="color: #fff;">Create Post</h4>

                  <span class="widget-toolbar">
                    <a href="{{ route('dashboard.crud-10.index') }}" style="color: #fff;">
                      <i class="ace-icon fa fa-plus"></i> Go To Index
                    </a>
                  </span>
                </div>

                <!-- div.table-responsive -->


                <!-- div.dataTables_borderWrap -->
                <form action="{{ route('dashboard.crud-10.store') }}" method="POST">
                  @csrf

                  {{-- Category --}}
                  <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select id="crud7_id" name="crud7_id" class="form-control" onchange="window.location='{{ route('dashboard.crud-10.create') }}?category=' + this.value">
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" {{ old('crud7_id', $selectedCategory) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('crud7_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Subcategory --}}
                  <div class="form-group">
                    <label>Subcategory</label>
                    <select name="crud8_id" id="crud8_id" class="form-control" onchange="window.location='{{ route('dashboard.crud-10.create') }}?category={{ $selectedCategory }}&subcategory=' + this.value">
                      <option value="">-- Select Subcategory --</option>
                      @foreach($subcategories as $sub)
                      <option value="{{ $sub->id }}" {{ old('crud8_id', $selectedSubcategory) == $sub->id ? 'selected' : '' }}>
                        {{ $sub->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('crud8_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Sub-Subcategory --}}
                  <div class="form-group">
                    <label>Sub-Subcategory (optional)</label>
                    <select name="crud9_id" id="crud9_id" class="form-control">
                      <option value="">-- Select Sub-Subcategory --</option>
                      @foreach($subsubcategories as $subsub)
                      <option value="{{ $subsub->id }}" {{ old('crud9_id') == $subsub->id ? 'selected' : '' }}>
                        {{ $subsub->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('crud9_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Post Serial --}}
                  <div class="form-group mb-3">
                    <label>Post Serial *</label>
                    <input type="number" name="post_serial" class="form-control" value="{{ old('post_serial') }}" required>
                    @error('post_serial') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  {{-- Post Name --}}
                  <div class="form-group mb-3">
                    <label>Post Name *</label>
                    <input type="text" name="post_name" class="form-control" value="{{ old('post_name') }}" required>
                    @error('post_name') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  {{-- Post Title --}}
                  <div class="form-group mb-3">
                    <label>Post Title *</label>
                    <input type="text" name="post_title" class="form-control" value="{{ old('post_title') }}" required>
                    @error('post_title') <span class="text-danger">{{ $message }}</span> @enderror
                  </div>

                  {{-- Short Description --}}
                  <div class="form-group mb-3">
                    <label>Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Full Post --}}
                  <div class="form-group mb-3">
                    <label>Full Post *</label>
                    <textarea name="post" class="form-control" rows="5">{{ old('post') }}</textarea>
                    @error('post') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  {{-- Status --}}
                  <div class="form-group mb-3">
                    <label>Status *</label>
                    <select name="status" class="form-select" required>
                      <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
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








@endpush

