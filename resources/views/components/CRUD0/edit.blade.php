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
                                <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                                    <h4 class="widget-title" style="color: #fff;">Edit Data</h4>

                                    <span class="widget-toolbar">
                                        <a href="{{ route('dashboard.crud.index') }}" style="color: #fff;">
                                            <i class="ace-icon fa fa-list"></i> Back to List
                                        </a>
                                    </span>
                                </div>

                                <!-- Edit Form Start -->
                                <form action="{{ route('dashboard.crud-0.update', $crud0->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Topic Name:</label>
                                        <input type="text" name="topic_name" class="form-control"
                                            value="{{ old('topic_name', $crud0->topic_name) }}" required>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $crud0->title) }}" required>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ old('description', $crud0->description) }}" required>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="status">Status</label><br>

                                        <label>
                                            <input type="radio" name="status" value="active"
                                                {{ $crud0->status == 'active' ? 'checked' : '' }}> Active
                                        </label>
                                        {{-- &nbsp;&nbsp; --}}
                                        <label>
                                            <input type="radio" name="status" value="inactive"
                                                {{ $crud0->status == 'inactive' ? 'checked' : '' }}> Inactive
                                        </label>
                                    </div>


                                    <div class="form-actions center">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Update
                                            <i class="ace-icon fa fa-check icon-on-right bigger-110"></i>
                                        </button>

                                        <a href="{{ route('dashboard.crud-0.index') }}" class="btn btn-sm btn-warning">
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
