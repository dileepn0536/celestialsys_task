@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
  <div class="card-header">
    {{ __('Edit Company') }}
  </div>
  <div class="card-body">
      <form method="post" action="{{ route('companies.update',$c_data->id) }}" enctype="multipart/form-data" id="edit_company_form">
        @csrf
        @method('PUT')
          <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }} :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $c_data->name }}"/>
                    <span class="text-danger" id="nameError"></span>
                </div>
          </div>
          <div class="row mb-3">
              <label for="logo" class="col-md-4 col-form-label text-md-end">{{ __('Logo') }} :</label>
                <div class="col-md-6">
                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*"/>
                    <span class="text-danger" id="logoError"></span>
                    <br>
                  <a href="<?php echo asset("storage/company_logos/$c_data->logo")?>" target="_blank"><img src="<?php echo asset("storage/company_logos/$c_data->logo")?>" alt=""></a>
                </div>
          </div>
          <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }} :</label>
              <div class="col-md-6">
              <input type="text" class="form-control" name="email" id="email" value="{{ $c_data->email }}"/>
              <span class="text-danger" id="emailError"></span>
              </div>
          </div>
          <div class="row mb-3">
              <label for="address" class="col-md-4 col-form-label text-md-end">{{ _('Address') }} :</label>
              <div class="col-md-6">
              <input type="text" class="form-control" name="address" id="address" value="{{ $c_data->address }}"/>
              <span class="text-danger" id="addressError"></span>
              </div>
          </div>
          <div class="row mb-3">
              <label for="website" class="col-md-4 col-form-label text-md-end">{{ __('Website') }} :</label>
              <div class="col-md-6">
              <input type="url" class="form-control" name="website" id="website" value="{{ $c_data->website }}"/>
              <span class="text-danger" id="websiteError"></span>
                </div>
          </div>
            <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">{{ __('Edit Company') }}</button>
            </div>
            </div>
      </form>
  </div>
</div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
        $("#edit_company_form").on('submit', function(e){
            e.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                url:$(this).attr('action'),
                processData: false,
                contentType: false,
                cache:false,
                type:"POST",
                data:form_data,
                dataType:"JSON",
                success: function(data){
                    console.log(data);
                    if(data.status == "success") {
                        alert(data.message);
                        var link = "{{ url('companies') }}";
                        window.location.href = link;
                        return false;
                    } else {
                        alert(data.message);
                    }
                },
                error:function (response){
                    if(response.responseJSON.errors.name) {
                        $('#nameError').text(response.responseJSON.errors.name);
                    } else {
                        $('#nameError').text('');
                    }
                    if(response.responseJSON.errors.logo) {
                        $('#logoError').text(response.responseJSON.errors.logo);
                    } else {
                        $('#logoError').text('');
                    }
                    if(response.responseJSON.errors.email) {
                        $('#emailError').text(response.responseJSON.errors.email);
                    } else {
                        $('#emailError').text('');
                    }
                    if(response.responseJSON.errors.address) {
                        $('#addressError').text(response.responseJSON.errors.address);
                    } else {
                        $('#addressError').text('');
                    }
                    if(response.responseJSON.errors.website) {
                        $('#websiteError').text(response.responseJSON.errors.website);
                    } else {
                        $('#websiteError').text('');
                    }
                }
            });
        });
    });
</script>
@endpush