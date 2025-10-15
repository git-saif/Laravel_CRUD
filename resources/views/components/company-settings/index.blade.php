@extends('layouts.app')

@section('title', 'Company Settings')

@section('content')
<div class="main-content">
  <div class="col-md-12">
    <div class="widget-box">
      <div class="widget-header d-flex justify-content-between align-items-center">
        <h4 class="widget-title">Company Settings</h4>

        <span class="widget-toolbar">
          <a href="{{ route('dashboard.company.create') }}">
            <i class="ace-icon fa fa-plus"></i> Create Company Settings
          </a>
        </span>
      </div>

      <div class="widget-body">
        <div class="widget-main">

          <div class="row" style="margin: 15px">
            @forelse ($company as $setting)
            <div class="col-md-12 mb-3">
              <div class="widget-box">
                <div class="widget-header">
                  <h5 class="widget-title">Company Info (ID: {{ $setting->id }})</h5>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    <div class="row">

                      {{-- Basic Info --}}
                      @php
                      $fields = [
                      ['Company Name', $setting->company_name],
                      ['Tagline', $setting->company_tagline],
                      ['Email', $setting->company_email],
                      ['Phone', $setting->company_phone],
                      ['Address', $setting->company_address],
                      ];
                      @endphp

                      @foreach ($fields as $field)
                      <div class="col-md-4 mb-2">
                        <div class="well well-sm">
                          <strong>{{ $field[0] }}:</strong>
                          <div>{{ $field[1] ?? 'N/A' }}</div>
                        </div>
                      </div>
                      @endforeach

                      {{-- Logo --}}
                      <div class="col-md-4 mb-2">
                        <div class="well well-sm">
                          <strong>Logo:</strong><br>
                          @if ($setting->company_logo)
                          <img src="{{ asset($setting->company_logo) }}" width="60" alt="Logo">
                          @else
                          N/A
                          @endif
                        </div>
                      </div>

                      {{-- Favicon --}}
                      <div class="col-md-4 mb-2">
                        <div class="well well-sm">
                          <strong>Favicon:</strong><br>
                          @if ($setting->company_favicon)
                          <img src="{{ asset($setting->company_favicon) }}" width="30" alt="Favicon">
                          @else
                          N/A
                          @endif
                        </div>
                      </div>

                      {{-- Social and Booking Links --}}
                      @php
                      $links = [
                      ['Booking Link', $setting->company_booking_link, 'fa-link'],
                      ['WhatsApp', $setting->company_whatsapp_link, 'fa-whatsapp'],
                      ['Facebook', $setting->company_facebook_link, 'fa-facebook'],
                      ['Instagram', $setting->company_instagram_link, 'fa-instagram'],
                      ['Twitter', $setting->company_twitter_link, 'fa-twitter'],
                      ['YouTube', $setting->company_youtube_link, 'fa-youtube'],
                      ['LinkedIn', $setting->company_linkedin_link, 'fa-linkedin'],
                      ['Map Link', $setting->company_google_map_link, 'fa-map-marker'],
                      ];
                      @endphp

                      @foreach ($links as $link)
                      <div class="col-md-4 mb-2">
                        <div class="well well-sm">
                          <strong>{{ $link[0] }}:</strong>
                          <div>
                            @if ($link[1])
                            <a href="{{ $link[1] }}" target="_blank">
                              <i class="fa {{ $link[2] }} fa-lg"></i>
                            </a>
                            @else
                            N/A
                            @endif
                          </div>
                        </div>
                      </div>
                      @endforeach

                      {{-- Status --}}
                      <div class="col-md-4 mb-2">
                        <div class="well well-sm">
                          <strong>Status:</strong>
                          <div>
                            @if ($setting->status === 'active')
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Inactive</span>
                            @endif
                          </div>
                        </div>
                      </div>

                      {{-- Actions --}}
                      <div class="col-md-12 text-center">
                        <div class="well well-sm">
                          <strong>Actions:</strong><br>
                          <a href="{{ route('dashboard.company.edit', $setting->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                          </a>

                          <form action="{{ route('dashboard.company.destroy', $setting->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash"></i> Delete
                            </button>
                          </form>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <div class="col-md-12 text-center">
              <p>No company settings found.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            <div class="col-md-12 text-center">
              {{ $company->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

