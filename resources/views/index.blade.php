@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col d-flex align-items-stretch">
      <div class="card w-100">
          <div class="card-body p-4">
                @if(session()->has('messageSuccess'))
                    <div class="alert alert-success" role="alert">
                        {{ session('messageSuccess') }}
                    </div>
                @endif
              <h5 class="card-title fw-semibold mb-4">To do list</h5>
              <a href="/dashboard/create" class="btn btn-primary">Create</a>
              <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                      <thead class="text-dark fs-4">
                          <tr>
                              <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Kegiatan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($TodoItem as $item)   
                            <tr>
                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $item->kegiatan }}</h6>                         
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="/dashboard/{{ $item->id }}/edit" class="badge bg-primary rounded-3 fw-semibold">Edit</a>
                                        <button type="button" class="btn badge bg-danger rounded-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#{{ $item->id }}">Delete</button>
                                    </div>
                                </td>                     
                            </tr>
                            <div class="modal fade" id="{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Apakah anda yakin?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/dashboard/{{ $item->id }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection