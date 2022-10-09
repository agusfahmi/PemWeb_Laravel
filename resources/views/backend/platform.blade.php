@extends('backend/layouts.master')
@section('title', 'platform')
@section('content')
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> platform</h4>

      <!-- Basic Bootstrap Table -->
      <div class="card mb-4">
        <h5 class="card-header">List platform</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th style="width: 10%;">User</th>
                <th style="width: 15%;">Judul</th>
                <th style="width: 20%;">Deskripsi</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 15%;">Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($data as $dataku)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$dataku->nama}}</strong></td>
                <td>{{$dataku->judul}}...</td>
                <td>{{$dataku->deskripsi}}...</td>
                <td>{{$dataku->tanggal}}</td>
                <td>
                  <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus platform ?');" action="{{ route('platform.destroy', $dataku->id) }}" method="POST">
                    <a href="{{ route('platform.edit', $dataku->id) }}" class="btn btn-sm btn-primary shadow">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger shadow">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{-- Modal Hapus --}}
      <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Peringatan!!</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <p>Apakah anda yakin ingin menghapus platform ini ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger" onclick="{{url('news-destroy')}}">Hapus</button>
            </div>
          </div>
        </div>
      </div>
      {{-- Modal Hapus --}}
      <div class="row mt-3">
        <div class="d-grid gap-2 col-lg-10 mx-auto">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li class="page-item prev">
                <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon bx bx-chevrons-left"></i
                ></a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="javascript:void(0);">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">5</a>
              </li>
              <li class="page-item next">
                <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon bx bx-chevrons-right"></i
                ></a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="d-grid gap-2 col-lg-2 mx-auto">
          <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{route('platform.create')}}'">Tambah</button>
        </div>
      </div>
      <!--/ Basic Bootstrap Table -->
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
@endsection
