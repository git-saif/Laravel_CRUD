@extends('layouts.app')

@section('title', 'Company Settings Create')

@section('content')
<div class="main-content">
    <div class="col-md-12">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Create Company Setting</h4>
                <span class="widget-toolbar">
                    <a href="{{ route('dashboard.company.index') }}">
                        <i class="ace-icon fa fa-list"></i> Company Settings
                    </a>
                </span>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <div class="row" style="margin: 25px;">
                        <div class="col-md-12">
                            {{-- Success / Error Message --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('dashboard.company.store') }}" 
                                  method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- Company Info --}}
                                    <div class="col-md-4 mb-3">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ old('company_name') }}" required>
                                        @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Company Tagline</label>
                                        <input type="text" name="company_tagline" class="form-control"
                                            value="{{ old('company_tagline') }}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Company Email</label>
                                        <input type="email" name="company_email" class="form-control"
                                            value="{{ old('company_email') }}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Company Phone</label>
                                        <input type="number" name="company_phone" class="form-control"
                                            value="{{ old('company_phone') }}" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Company Address</label>
                                        <textarea name="company_address" class="form-control" required>{{ old('company_address') }}</textarea>
                                    </div>

                                    {{-- Links --}}
                                    @php
                                        $links = [
                                            'company_booking_link' => 'Booking Link',
                                            'company_whatsapp_link' => 'WhatsApp Link',
                                            'company_facebook_link' => 'Facebook Link',
                                            'company_instagram_link' => 'Instagram Link',
                                            'company_twitter_link' => 'Twitter Link',
                                            'company_youtube_link' => 'YouTube Link',
                                            'company_linkedin_link' => 'LinkedIn Link',
                                            'company_google_map_link' => 'Google Map Link',
                                        ];
                                    @endphp

                                    @foreach ($links as $name => $label)
                                        <div class="col-md-4 mb-3">
                                            <label>{{ $label }}</label>
                                            <input type="url" name="{{ $name }}" class="form-control"
                                                value="{{ old($name) }}">
                                        </div>
                                    @endforeach

                                    {{-- Status --}}
                                    <div class="col-md-4 mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    {{-- Images --}}
                                    <div class="col-md-4 mb-3">
                                        <label>Company Logo</label>
                                        <input type="file" name="company_logo" class="form-control" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Company Favicon</label>
                                        <input type="file" name="company_favicon" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="ace-icon fa fa-check"></i> Submit
                                    </button>
                                    <a href="{{ route('dashboard.company.index') }}" class="btn btn-sm btn-secondary">
                                        <i class="ace-icon fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
