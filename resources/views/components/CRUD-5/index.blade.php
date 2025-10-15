@extends('layouts.app')

@section('content')
@section('title', 'CRUD5 - List')


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
        <li class="active">CRUD5 List</li>
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
            CRUD5 Table List
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
                <h4 class="widget-title" style="color: #fff;">CRUD5 List</h4>
                <span class="widget-toolbar">
                  <a href="{{ route('dashboard.crud-5.create') }}" style="color: #fff;">
                    <i class="ace-icon fa fa-plus"></i> Create CRUD-5
                  </a>
                </span>
              </div>

              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="font-weight: bold;">Sl No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                    $sl = $crud5->firstItem() ?? 0;
                    @endphp

                    @forelse ($crud5 as $item)
                    <tr>
                      <td style="font-weight: bold;">{{ $sl++ }}.</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->phone }}</td>

                      <td>
                        @if($item->image)
                        <img src="{{ asset( $item->image) }}" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                      </td>

                      <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                          <a class="blue" href="#">
                            <i class="ace-icon fa fa-eye bigger-130"></i>
                          </a>

                          <a class="green" href="{{ route('dashboard.crud-5.edit', $item->id) }}">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                          </a>

                          <form action="{{ route('dashboard.crud-5.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                      <td colspan="6" class="text-center text-danger">No data found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>

                <div class="text-center">
                  {{ $crud5->links('pagination::bootstrap-4') }}
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

