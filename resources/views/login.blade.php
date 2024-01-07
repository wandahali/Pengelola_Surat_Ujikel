@extends('temp.template')

@section('nav')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        
        <!-- Kolom untuk Gambar -->
        <div class="col-md-6 mb-4">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
        </div>
        
        <!-- Kolom untuk Form Login -->
        <div class="col-md-6">
            <h1 class="text-center mb-4">Login</h1>
            
            <form action="{{ route('login.auth') }}" method="post" class="card p-4 shadow">
                @csrf
                
                <!-- Alert pesan -->
                @if (Session::get('failed'))
                    <div class="alert alert-danger mb-3">
                        {{ Session::get('failed') }}
                    </div>
                @endif
                @if (Session::get('logout'))
                    <div class="alert alert-primary mb-3">
                        {{ Session::get('logout') }}
                    </div>
                @endif
                @if (Session::get('cantAccess'))
                    <div class="alert alert-danger mb-3">
                        {{ Session::get('cantAccess') }}
                    </div>
                @endif

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <!-- Tombol Login -->
                <button type="submit" class="btn btn-block" style="background-color: #7BD3EA;">Login</button>
            </form>
        </div>
        
    </div>
</div>
@endsection
