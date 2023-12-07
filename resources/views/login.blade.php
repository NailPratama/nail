@extends('layouts')
@section('container')
    

  <title>Log in</title>

    @if (session()->has('login_error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px">
          {{ session('login_error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>    
      @endif

 <div class="row justify-content-center">
  
      <div class="col-lg-8">
        <main class="form-signin">

        <form action="/" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                  </div>
                  
                    <div class="mb-3">
                        
                        <img class="image_preview col-md-7 mb-3" >
                        <input class="form-control" type="file" id="coverimage" name="coverimage">
                        @error('coverimage')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <button  class="btn btn-primary btn-user btn-block "type="submit">
                      Login
                    </button>
                    
                   
                  </form>
                  <hr>
                  <div class="text-center"> 
                    <a class="small" href="/forgot">Pulihkan Gambar?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="/register">Daftar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </main>
    </div>

    </div>


<!-- <div class="row justify-content-center align-middle">
    <div class="col-lg-6">
        <div class="cont-custom" style="height: 70%; margin-top: 25%"
          >  <main class="form-signin">
                <form action="/login" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Masuk</h1>
                    <div class="mb-3">
                        <label for="coverimage" class="form-label">Gambar cover</label>
                        <img class="image_preview col-md-7 mb-3" >
                        <input class="form-control" type="file" id="coverimage" name="coverimage">
                        @error('coverimage')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
                </form>
                <small class="d-block text-center mt-4">Belum daftar?
                    <a href="/register">
                        <span class="badge bg-info text-dark">Daftar sekarang!</span>
                        </a>
                    </small>
                    <br>
                <small class="d-block text-center mt-0">Cover image hilang atau rusak?
                    <a href="/updatecoverimage">
                        <span class="badge bg-warning text-dark">Perbaharui cover image</span>
                    </a>
                </small>
            </main>
        </div>
    </div>
</div>
 -->
<script>
    function func_preview(){
        const image = document.querySelector('#coverimage');
        const preview_img = document.querySelector('.image_preview');

        preview_img.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
            preview_img.src = oFREvent.target.result;
        }
    }
</script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

@endsection