@extends('layout-master')
@section('title','| Reset Password')
@section('content')
   <!-- ##### Breadcrumb Area Start ##### -->
   <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(/mag/img/bg-img/40.jpg);">
       <div class="container h-100">
           <div class="row h-100 align-items-center">
               <div class="col-12">
                   <div class="breadcrumb-content">
                       <h2>Reset Password</h2>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <!-- ##### Breadcrumb Area End ##### -->

   <!-- ##### Login Area Start ##### -->
   <div class="mag-login-area py-5">
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-12 col-lg-6">
                   <div class="login-content bg-white p-30 box-shadow">
                       <!-- Section Title -->
                       <div class="section-heading">
                           <h5>Reset Password</h5>
                       </div>

                       <form action="{{ route('password.email') }}" method="post">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                           @csrf
                           <div class="form-group">
                               <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{ old('email') }}" placeholder="Email">
                               @error('email')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>

                           <div class="form-group">
                               <button type="submit" class="btn mag-btn mt-30">{{ __('Send Password Reset Link') }}</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- ##### Login Area End ##### -->
@endsection



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
