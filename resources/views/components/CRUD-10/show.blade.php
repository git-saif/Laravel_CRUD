@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Post Details</li>
      </ul>
    </div>

    <div class="page-content">
      <div class="page-header">
        <h1>
          Post Details
          <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {{ $crud10->post_name }}
          </small>
        </h1>
      </div>

      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="widget-box">
            <div class="widget-header widget-header-flat" style="background-color: #618f8f;">
              <h4 class="widget-title" style="color: #fff;">Post Information</h4>
              <span class="widget-toolbar">
              <!-- Edit Button -->
              <a href="{{ route('dashboard.crud-10.edit', $crud10->id ) }}?from=show" style="color: #fff; margin-right: 10px; padding-left: 10px;">
                <i class="ace-icon fa fa-pencil"></i> Edit Post
              </a>
              <!-- Back Button -->
              <a href="{{ route('dashboard.crud-10.index') }}?from=show" style=" color: #fff; margin-right: 10px; border-left: 1px solid #fff;">
                <i class="ace-icon fa fa-arrow-left" style="margin-left: 5px;"></i> Back to List
              </a>
              </span>
            </div>

            <div class="widget-body">
              <div class="widget-main">

                <table class="table table-bordered table-striped">
                  <tr>
                    <th width="25%">Category</th>
                    <td>{{ $crud10->category->name ?? '-' }}</td>
                  </tr>
                  <tr>
                    <th>Subcategory</th>
                    <td>{{ $crud10->subcategory->name ?? '-' }}</td>
                  </tr>
                  <tr>
                    <th>Sub-Subcategory</th>
                    <td>{{ $crud10->subsubcategory->name ?? '-' }}</td>
                  </tr>
                  <tr>
                    <th>Post Serial</th>
                    <td>{{ $crud10->post_serial }}</td>
                  </tr>
                  <tr>
                    <th>Post Name</th>
                    <td>{{ $crud10->post_name }}</td>
                  </tr>
                  <tr>
                    <th>Post Title</th>
                    <td>{{ $crud10->post_title }}</td>
                  </tr>
                  <tr>
                    <th>Short Description</th>
                    <td>{{ $crud10->short_description ?? '-' }}</td>
                  </tr>
                  <tr>
                    <th>Post Content</th>
                    {{-- ✅ Render HTML content safely --}}
                    <td>{!! $crud10->post !!}</td>

                    {{-- <td>{!! nl2br(e($crud10->post)) !!}</td> --}}
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>
                      @if ($crud10->status === 'active')
                      <span class="badge badge-success">Active</span>
                      @else
                      <span class="badge badge-danger">Inactive</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Created At</th>
                    <td>{{ $crud10->created_at->format('d M, Y h:i A') }}</td>
                  </tr>
                  <tr>
                    <th>Updated At</th>
                    <td>{{ $crud10->updated_at->format('d M, Y h:i A') }}</td>
                  </tr>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

