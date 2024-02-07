@extends('layouts.main')

@section('container')
              <h5 class="card-title fw-semibold mb-4">Create</h5>
              <div class="card">
                <div class="card-body">
                @if(session()->has('messageSuccess'))
                  <div class="alert alert-success" role="alert">
                    {{ session('messageSuccess') }}
                  </div>
                @endif
                  <form method="POST" action="/dashboard">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                      <label for="kegiatan" class="form-label">Kegiatan</label>
                      <br>
                      <textarea name="kegiatan" id="kegiatan" class="w-100 p-2" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-dark">Back</a>
                  </form>
                </div>
              </div>
@endsection