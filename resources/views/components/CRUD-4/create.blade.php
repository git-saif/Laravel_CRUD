@extends('layouts.app')

@section('content')
@section('title', 'Smart ERP - CRUD4 Create')

<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i>
          <a href="#">Home</a>
        </li>

        <li>
          <a href="#">CRUD4</a>
        </li>
        <li class="active">Create New</li>
      </ul>
    </div>

    <div class="page-content">

      <div class="page-header">
        <h1>
          CRUD4
          <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Create New Record
          </small>
        </h1>
      </div>

      <div class="row">
        <div class="col-xs-12">

          <div class="widget-header widget-header-flat" style="background-color: #618f8f;">
            <h4 class="widget-title" style="color: #fff;">Create New CRUD4</h4>
            <span class="widget-toolbar">
              <a href="{{ route('dashboard.crud-4.index') }}" style="color: #fff;">
                <i class="ace-icon fa fa-list"></i> Back to List
              </a>
            </span>
          </div>

          <div class="widget-body">
            <div class="widget-main">

              {{-- Show validation errors --}}
              @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              {{-- Create Form --}}
              <form action="{{ route('dashboard.crud-4.store') }}" method="POST" class="form-horizontal" role="form">
                @csrf

                <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="name">Name</label>
                  <div class="col-sm-9">

                    <input type="text" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}" class="col-xs-10 col-sm-5 {{ $errors->has('name') ? 'is-invalid' : '' }}" />
                    @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    
                  </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="email">Email</label>
                  <div class="col-sm-9">
                    <input type="text" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" class="col-xs-10 col-sm-5 {{ $errors->has('email') ? 'is-invalid' : '' }}" />
                    @error('email')
                    <span class="text-danger small pt-2">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="phone">Phone</label>
                  <div class="col-sm-9">
                    <input type="text" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}" class="col-xs-10 col-sm-5 {{ $errors->has('phone') ? 'is-invalid' : '' }}" />
                    @error('phone')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="space-4"></div>

                <div class="clearfix form-actions">
                  <div class="col-md-offset-2 col-md-9">
                    <button class="btn btn-info" type="submit">
                      <i class="ace-icon fa fa-check bigger-110"></i>
                      Submit
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <button class="btn" type="reset">
                      <i class="ace-icon fa fa-undo bigger-110"></i>
                      Reset
                    </button>
                  </div>
                </div>
              </form>





            </div>
          </div>

        </div><!-- /.col -->
      </div><!-- /.row -->

    </div><!-- /.page-content -->
  </div>
</div>
@endsection

