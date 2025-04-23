@extends('layouts.app')

@section('content')
@section('title', 'Smart ERP - CRUD')
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
                <li class="active">Simple &amp; Dynamic</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input"
                            autocomplete="off" />
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
                        Create New Table
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
                                <div class="d-flex justify-content-between align-items-center ">
                                    <div class="widget-header widget-header-flat " style="background-color: #618f8f;">
                                        <h4 class="widget-title" style="color: #fff;">Create Data</h4>

                                        <span class="widget-toolbar">
                                            <a href="{{ route('dashboard.crud-2.index') }}" style="color: #fff;">
                                                <i class="ace-icon fa fa-plus"></i> Go To Index
                                            </a>
                                        </span>
                                    </div>

                                </div>

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <form action="{{ route('dashboard.crud-2.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone No</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="+8801XXXXXXXXX" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="example@email.com" required>
                                    </div>

                                    {{-- Multiple Image Start --}}
                                    <div id="image-upload-wrapper">
                                        <div class="form-group">
                                            <label for="image">Image (required)</label>
                                            <input type="file" name="image[]" class="form-control" required>
                                        </div>
                                    </div>

                                    <button type="button" id="add-image" class="btn btn-info">+ Add Another
                                        Image</button>

                                    {{-- Multiple Image End --}}

                                    <div class="form-group">
                                        <label for="status">Status</label><br>

                                        <label>
                                            <input type="radio" name="status" value="active" checked> Active
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="status" value="inactive"> Inactive
                                        </label>
                                    </div>

                                    <div class="form-actions center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Submit
                                        </button>

                                        <a href="{{ route('dashboard.crud.index') }}" class="btn btn-warning">
                                            <i class="ace-icon fa fa-arrow-left bigger-110"></i>
                                            Back
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

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif




@endsection

@push('scripts')
<script>
    document.getElementById('add-image').addEventListener('click', function() {
        let newInput = document.createElement('div');
        newInput.classList.add('form-group', 'mt-2');
        newInput.innerHTML = `<input type="file" name="image[]" class="form-control">`;
        document.getElementById('image-upload-wrapper').appendChild(newInput);
    });
</script>
@endpush
