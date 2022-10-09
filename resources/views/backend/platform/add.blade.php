@extends('backend/layouts.master')
@section('title', 'platform')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management / Berita /</span> Tambah Berita</h4>
	<!-- Basic Layout -->
	<div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Berita</h5>
            {{-- <small class="text-muted float-end">Default label</small> --}}
        </div>
        <div class="card-body">
            <form action="{{route('platform.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Berita..." required/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="deskripsi">deskripsi Berita</label>
                    <textarea
                        id="deskripsi"
                        class="form-control"
                        name="deskripsi"
                        placeholder="deskripsi Berita..."
                        required
                        ></textarea>
                </div>
                <div class="d-grid gap-2 mx-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
