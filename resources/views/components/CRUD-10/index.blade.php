@extends('layouts.app')

@section('content')
@section('title', 'CRUD10 - Post List')


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
        <li class="active">CRUD-10 Post List</li>
      </ul>

      <div class="nav-search" id="nav-search">
        <form class="form-search">
          <span class="input-icon">
            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
            <i class="ace-icon fa fa-search nav-search-icon"></i>
          </span>
        </form>
      </div>
    </div>

    <div class="page-content">

      <div class="page-header">
        <h1>
          Tables
          <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            CRUD-10 Post List
          </small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">

          <div class="row">
            <div class="col-xs-12">
              <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
              </div>

              <div class="widget-header widget-header-flat" style="background-color: #618f8f;">
                <h4 class="widget-title" style="color: #fff;">Post List</h4>
                <span class="widget-toolbar">
                  <a href="{{ route('dashboard.crud-10.create') }}" style="color: #fff;">
                    <i class="ace-icon fa fa-plus"></i> Create New Post
                  </a>
                </span>
              </div>

              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead class="table-dark text-center">
                    <tr>
                      <th>SL</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Sub-Subcategory</th>
                      <th>Post Serial</th>
                      <th>Post Name</th>
                      <th>Post Title</th>
                      <th>Short Description</th>
                      <th>Post</th>
                      <th>Status</th>
                      <th width="140">Action</th>
                    </tr>

                  </thead>

                  <tbody>
                    @php $sl = $crud10->firstItem() ?? 1; @endphp
                    @forelse ($crud10 as $item)
                    <tr>
                      <td style="font-weight: bold;">{{ $sl++ }}.</td>

                      <td>{{ $item->category->name ?? '-' }}</td>
                      <td>{{ $item->subcategory->name ?? '-' }}</td>
                      <td>{{ $item->subsubcategory->name ?? '-' }}</td>
                      <td>{{ $item->post_serial }}</td>

                      <td>{{ $item->post_name }}</td>
                      <td>{{ $item->post_title }}</td>
                      <td> {{ $item->short_description }}</td>

                      <td>{{ $item->post }}</td>
                      
                      <td>
                        @if ($item->status === 'active')
                        <span class="badge badge-success">Active</span>
                        @else
                        <span class="badge badge-danger">Inactive</span>
                        @endif
                      </td>

                      <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                          <a class="blue" href="#">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                          </a>

                          <a class="green" href="{{ route('dashboard.crud-10.edit', $item->id) }}">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                          </a>

                          <form action="{{ route('dashboard.crud-10.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="red" style="border: none; background: none;">
                              <i class="ace-icon fa fa-trash-o bigger-130"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-danger">No data found.</td>
                    </tr>
                    @endforelse
                  </tbody>





                </table>

                <div class="text-center">
                  {{ $crud10->links('pagination::bootstrap-4') }}
                </div>
              </div>

            </div>
          </div>
        </div><!-- /.col -->
      </div>
    </div><!-- /.page-content -->
  </div>
</div>
@endsection

