@extends('layouts.app')

@section('content')
@section('title', 'Smart ERP - Edit Entry')
<!-- Edit form -->
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
                        <div class="col-xs-12 ">
                            <div class="col-md-2"></div>

                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="table-header d-flex justify-content-between align-items-stretch">
                                        <span>Edit Entry</span>
                                        <a href="{{ route('dashboard.crud.index') }}" class="pull-right btn btn-sm btn-white h-100 d-flex align-items-center" style="margin-left: auto;">
                                            <i class="fa fa-list me-1"></i> Back to List
                                        </a>
                                    </div>
                                </div>

                                <!-- Edit Form Start -->
                                <form action="{{ route('dashboard.crud.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone No</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $item->phone }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $item->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Current Image</label><br>
                                        @if ($item->image)
                                        <img src="{{ asset('uploads/'.$item->image) }}" alt="Current Image" width="100">
                                        @else
                                        <p>No image uploaded.</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Change Image (optional)</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-actions center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ace-icon fa fa-save bigger-110"></i>
                                            Update
                                        </button>

                                        <a href="{{ route('dashboard.crud.index') }}" class="btn btn-warning">
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
                </div><!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<!-- /.main-content -->

@endsection