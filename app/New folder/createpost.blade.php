@extends('layouts')
@section('container')
    

  <title>Upload File</title>

    

 <div class="row justify-content-center">
  
      <div class="col-lg-8">
        <main class="form-signin">

        <form action="/store" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Upload File</h1>
                  </div>
                  
                   
                    <div class="form-group">
                        <input type="text" class="form-control rounded-top @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama File" value="{{ old('nama') }}" required>
                                
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}.
                        </div>
                        @enderror
                   
                        <img class="image_preview col-md-7 mb-3" >
                        <input class="form-control" type="file" id="file" name="file" required>
                        @error('file')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <button  class="btn btn-primary btn-user btn-block "type="submit">
                      Simpan
                    </button>
                    <hr>
                   
                  </form>
                  <hr>
                  
                  <div class="text-center">
                    <a class="small" href="/upload">Kembali</a>
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