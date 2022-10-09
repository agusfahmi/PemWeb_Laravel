@extends('backend/layouts.master')
@section('title', 'platform')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management / Berita /</span> Edit Berita</h4>
	<!-- Basic Layout -->
	<div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Berita</h5>
            {{-- <small class="text-muted float-end">Default label</small> --}}
        </div>
        <div class="card-body">
            <form action="{{route('platform.update', $platform->id)}}" method="POST">
              @csrf
              @method('PUT')
                <div class="mb-3">
                  <label class="form-label" for="judul">Judul</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Berita..." value="{{$platform->judul}}" required/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="deskripsi">deskripsi Berita</label>
                  <textarea
                      id="deskripsi"
                      class="form-control"
                      name="deskripsi"
                      placeholder="deskripsi Berita..."
                      required
                      >{{$platform->deskripsi}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Status Berita</label>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="status"
                        id="inlineRadio1"
                        value="1"
                        @if ($platform->status == 1)
                          checked
                        @endif
                      />
                      <label class="form-check-label" for="inlineRadio1">Posting</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="status"
                        id="inlineRadio2"
                        value="2"
                        @if ($platform->status == 2)
                            checked
                        @endif
                      />
                      <label class="form-check-label" for="inlineRadio2">Pending</label>
                    </div>
                </div>
                <div class="d-grid gap-2 mx-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection