@extends('layouts')
@section('container') 

    <title>Pemulihan Gambar</title>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <main class="form-registration">
        <!-- Nested Row within Card Body -->
        <div class="row">
          
          <div class="col-lg">
            <div class="p-5">

              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Pemulihan Gambar</h1>
              </div>

              <form action="/link" method="POST">
              @csrf

                <div class="form-group">
                  <input type="email" class="form-control rounded-top @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                                
                        @error('email')
                        
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                  
                </div> 
                
                <div class="form-group">
                  <input type="password" class="form-control rounded-top @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                                               
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                </div>
                
                
                
                        <button class="btn btn-primary btn-user btn-block mt-4" type="submit">Pulihkan</button>
                </form>
                    
                       
                      
                      <div class="text-center">
                        <a class="small" href="/">Kembali</a>
                      </div>
            
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

 @endsection