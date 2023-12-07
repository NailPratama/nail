@extends('layouts')
@section('container') 

    <title>Register</title>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <main class="form-registration">
        <!-- Nested Row within Card Body -->
        <div class="row">
          
          <div class="col-lg">
            <div class="p-5">

              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>

              <form action="/register" method="POST">
              @csrf

                <div class="form-group">
                  <input type="text" class="form-control rounded-top @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="" required>
                                
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                    </div>

                <div class="form-group">
                  <input type="email" class="form-control rounded-top @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="" required>
                                                
                        @error('email')
                        
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                  
                </div> 
                
                <div class="form-group">
                  <input type="password" class="form-control rounded-top @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="" required>
                                               
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                </div>
                
                    <div class="form-floating" required>
                        <!-- Button trigger modal -->
                        <a  class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Pilih Cover Image
                        </a>
                        @error('coverimage')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
             
                                
                               
                                
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach ($coverimage as $cover)
                                        <div class="col-sm-4">
                                            <div class="card mb-3" style="width: 14rem;">
                                                <div class="custom-control custom-radio image-checkbox">
                                                    <input type="radio" class="custom-control-input" id="coverimage{{ $cover->id }}" name="coverimage" value="{{ $cover->id }}">
                                                    <label class="custom-control-label" for="coverimage{{ $cover->id }}">
                                                        <img src="{{ asset('storage/'.$cover->path) }}" alt="#" class="img-fluid">
                                                    </label>
                                                    
                                                    {{-- <input type="hidden" name="slug_coverimage" id="slug_coverimage" value="{{ uniqid($cover->slug, true) }}"> --}}
                                                </div>
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">{{ $cover->namagambar }}</h5>
                                                    <p class="text-muted mt-0 fs-6">oleh {{ $cover->pengunggah }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            
                
                        <button class="btn btn-primary btn-user btn-block mt-4" type="submit">Register Account</button>
                </form>
                    
                       
                      <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                      </div>
                      
                      <div class="text-center">
                        <a class="small" href="/">Already have an account? Login!</a>
                      </div>
            
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

 @endsection