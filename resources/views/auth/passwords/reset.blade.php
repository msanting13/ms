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

                       <form action="{{ route('password.update') }}" method="post">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                           @csrf
                           <input type="hidden" name="token" value="{{ $token }}">
                           <div class="form-group">
                               <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{ $email ?? old('email') }}" placeholder="Email">
                               @error('email')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                           </div>
                           <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>

                           <div class="form-group">
                               <button type="submit" class="btn mag-btn mt-30">{{ __('Reset Password') }}</button>
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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
