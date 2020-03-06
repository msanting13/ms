@extends('layouts.layout-master')
@section('title','Create')
@section('statusResearch','active')
@section('content')
  <div class="card shadow mb-4">

    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Create Report</h6>
    </div>

    <div class="card-body">
      <form action="{{ route('card.store') }}" method="POST" role="form">
        @csrf
        <div class="form-group row">
          <label for="boardType" class="col-md-4 col-form-label text-md-right">{{ __('Report for *') }}</label>

          <div class="col-md-6">
            <select id="boardType" class="form-control @error('type') is-invalid @enderror" name="type">
              <option>{{ old('type') }}</option>
              <option>research</option>
              <option>extension</option>
            </select>

            @error('type')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="fiscalYear" class="col-md-4 col-form-label text-md-right">{{ __('Fiscal-Year *') }}</label>

          <div class="col-md-6">
            <select id="fiscalYear" class="form-control @error('fiscal_year') is-invalid @enderror" name="fiscal_year">
              <option>{{ old('fiscal_year') }}</option>
              @for($i=date('Y'); $i >= 2000; $i--)
              <option>{{ $i }}</option>
              @endfor
            </select>
            @error('fiscal_year')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="cardName" class="col-md-4 col-form-label text-md-right">{{ __('Report type ') }}</label>

          <div class="col-md-6">
            <select id="cardName" class="form-control @error('card_name') is-invalid @enderror" name="card_name">
              <option>{{ old('card_name') }}</option>
              <option>Program</option>
              <option>Project</option>
              <option>Activities</option>
            </select>
            @error('card_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description *') }}</label>

          <div class="col-md-6">
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>

          <div class="col-md-6">
            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>        
        <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right">Deadline <u class='font-weight-bold'>{{ \Carbon\Carbon::now()->format('F d, Y') }}</u> to : </label>

        <div class="col-md-6">
        <input type="date" name='deadline' class='form-control font-weight-bold' min="{{ Carbon\Carbon::now()->addDay(1)->format('Y-m-d') }}">  
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
              </span>
              <span class="text">{{ __('Create') }}</span>
            </button>
          </div>
        </div>
        
      </form>
    </div>
  </div>
  @section('ajax-request')
 {{--  @include('sweetalert::alert') --}}
  @endsection
  @endsection