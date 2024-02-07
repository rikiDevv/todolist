@extends('layouts.main')

@section('container')

  <div class="card">
    <div class="card-body">
        @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
                {{ session('message') }}
        </div>
        @else
        <div class="alert alert-danger" role="alert">
            Tolong periksa email anda terlebih dahulu untuk link verifikasi, jika tidak mendapatkan email silahkan <a href="/email/verification-notification">klik link disini untuk meminta link.</a> 
        </div>
        @endif
    </div>
  </div>
@endsection