@extends('layouts.app')

@section('content')
@section('title', 'Company Settings Edit')

<div class="main-content">
  <div class="col-md-12">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title">Edit Company-Settings</h4>
        <span class="widget-toolbar">
          <a href="{{ route('dashboard.company.index') }}">
            <i class="ace-icon fa fa-list"></i> Go to Company-Settings
          </a>
        </span>
      </div>

      <div class="widget-body">
        <div class="widget-main no-padding">
          <div class="row" style="margin: 25px;">
            <div class="col-md-12 ">
              <form action="{{ route('dashboard.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                  {{-- Company Name --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}" required>
                  </div>

                  {{-- Company Tagline --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Tagline</label>
                    <input type="text" name="company_tagline" class="form-control" value="{{ old('company_tagline', $company->company_tagline) }}" required>
                  </div>

                  {{-- Email --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Email</label>
                    <input type="email" name="company_email" class="form-control" value="{{ old('company_email', $company->company_email) }}" required>
                  </div>

                  {{-- Phone --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Phone</label>
                    <input type="text" name="company_phone" class="form-control" value="{{ old('company_phone', $company->company_phone) }}" required>
                  </div>

                  {{-- Address --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Address</label>
                    <textarea name="company_address" class="form-control" required>{{ old('company_address', $company->company_address) }}</textarea>
                  </div>

                  {{-- Links --}}
                  <div class="col-md-4 mb-3">
                    <label>Booking Link</label>
                    <input type="url" name="company_booking_link" class="form-control" value="{{ old('company_booking_link', $company->company_booking_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>WhatsApp Link</label>
                    <input type="url" name="company_whatsapp_link" class="form-control" value="{{ old('company_whatsapp_link', $company->company_whatsapp_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>Facebook Link</label>
                    <input type="url" name="company_facebook_link" class="form-control" value="{{ old('company_facebook_link', $company->company_facebook_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>Instagram Link</label>
                    <input type="url" name="company_instagram_link" class="form-control" value="{{ old('company_instagram_link', $company->company_instagram_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>Twitter Link</label>
                    <input type="url" name="company_twitter_link" class="form-control" value="{{ old('company_twitter_link', $company->company_twitter_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>YouTube Link</label>
                    <input type="url" name="company_youtube_link" class="form-control" value="{{ old('company_youtube_link', $company->company_youtube_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>LinkedIn Link</label>
                    <input type="url" name="company_linkedin_link" class="form-control" value="{{ old('company_linkedin_link', $company->company_linkedin_link) }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>Google Map Link</label>
                    <input type="url" name="company_google_map_link" class="form-control" value="{{ old('company_google_map_link', $company->company_google_map_link) }}">
                  </div>

                  {{-- Status --}}
                  <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                      <option value="active" @selected(old('status', $company->status) == 'active')>Active</option>
                      <option value="inactive" @selected(old('status', $company->status) == 'inactive')>Inactive</option>
                    </select>
                  </div>

                  {{-- Logo --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Logo</label><br>
                    @if ($company->company_logo)
                    <img src="{{ asset($company->company_logo) }}" width="60" class="mb-2">
                    @endif
                    <input type="file" name="company_logo" class="form-control">
                  </div>

                  {{-- Favicon --}}
                  <div class="col-md-4 mb-3">
                    <label>Company Favicon</label><br>
                    @if ($company->company_favicon)
                    <img src="{{ asset($company->company_favicon) }}" width="30" class="mb-2">
                    @endif
                    <input type="file" name="company_favicon" class="form-control">
                  </div>

                </div>

                <div class="mt-2">
                  <button type="submit" class="btn btn-sm btn-primary">
                    Update <i class="ace-icon fa fa-check icon-on-right bigger-110"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection

