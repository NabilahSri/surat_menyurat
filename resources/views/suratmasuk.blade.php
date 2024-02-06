@extends('template_main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Surat Masuk</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="">
                            <button type="button" class="btn btn-success me-2">
                                <a href="/surat-masuk/cetak_pdf" target="_baln" class="text-white ">Export</a>
                            </button>
                        </div>
                        <div>
                            @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Tambah
                                </button>
                                <!-- Modal Tambah-->
                                <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Surat Masuk
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3 needs-validation" method="POST"
                                                    action="/surat-masuk/create" enctype="multipart/form-data" novalidate>
                                                    @csrf
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Perihal</label>
                                                        <select class="form-select" id="perihal_select" name="id_perihal"
                                                            required>
                                                            <option selected disabled value="">...</option>
                                                            @foreach ($perihal as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->perihal }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Nomor
                                                            Surat</label>
                                                        <input type="text" class="form-control" id="nomor_surat"
                                                            name="nomor_surat" value="">
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Tanggal
                                                            Surat</label>
                                                        <input type="date" class="form-control" name="tanggal_surat"
                                                            id="validationTooltip01" required>
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip04" class="form-label">Sifat
                                                            Surat</label>
                                                        <select class="form-select" id="validationTooltip04"
                                                            name="sifat_surat" required>
                                                            <option selected disabled value="">...</option>
                                                            <option value="segera">Segera</option>
                                                            <option value="penting">Penting</option>
                                                            <option value="rahasia">Rahasia</option>
                                                            <option value="biasa">Biasa</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Pengirim</label>
                                                        <input type="text" class="form-control" name="pengirim"
                                                            id="validationTooltip01" required>
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">File</label>
                                                        <input type="file" class="form-control" name="file"
                                                            id="validationTooltip01" />
                                                    </div>
                                                    <div class="col-md-12 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Isi Surat
                                                            Ringkas</label>
                                                        <textarea class="form-control" name="isi_surat_ringkas" id="validationTooltip01" cols="30" rows="2" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">No</th>
                                        <th>Tanggal dan Jam</th>
                                        <th>Nomor Surat</th>
                                        <th>Sifat Surat</th>
                                        <th>Perihal</th>
                                        <th>Pengirim</th>
                                        <th>Disposisi Saat Ini</th>
                                        <th style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratmasuk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->nomor_surat }}</td>
                                            <td>{{ $item->sifat_surat }}</td>
                                            <td>{{ $item->perihal->perihal }}</td>
                                            <td>{{ $item->pengirim }}</td>

                                            <td>

                                                @php
                                                    $isDisposisiPending = true;

                                                    foreach ($disposisi as $disposisis) {
                                                        if ($disposisis->id_surat_masuk == $item->id) {
                                                            $isDisposisiPending = false;
                                                            break;
                                                        }
                                                    }

                                                @endphp

                                                @if ($isDisposisiPending)
                                                    <div class="flex align-items-center list-user-action">
                                                        <a class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#disposisi{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Disposisi" data-original-title="Disposisi"
                                                            href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        Menunggu disposisi
                                                    </div>
                                                @else
                                                    <div class="flex align-items-center list-user-action">
                                                        <a class="btn btn-sm btn-icon text-white"
                                                            style="background-color: grey">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        @php
                                                            $latestDisposisi = null;
                                                            foreach ($disposisi2 as $disposisis) {
                                                                $latestDisposisi = $disposisis
                                                                    ->with('unitkerja')
                                                                    ->where('id_surat_masuk', $item->id)
                                                                    ->latest()
                                                                    ->first();
                                                                // Disposisi::where('id_surat_masuk', $req->id)->latest()->first();
                                                                if ($latestDisposisi) {
                                                                    break; // Berhenti jika disposisi pertama ditemukan
                                                                }
                                                            }
                                                        @endphp
                                                        {{ $latestDisposisi == null ? '-' : $latestDisposisi->unitkerja->nama_unit_kerja }}
                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="flex align-items-center list-user-action">

                                                    @if ($item->status == 'Open')
                                                        <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#detailSuratMasuk{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Detail" data-original-title="Detail" href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M21.419 15.732C21.419 19.31 19.31 21.419 15.732 21.419H7.95C4.363 21.419 2.25 19.31 2.25 15.732V7.932C2.25 4.359 3.564 2.25 7.143 2.25H9.143C9.861 2.251 10.537 2.588 10.967 3.163L11.88 4.377C12.312 4.951 12.988 5.289 13.706 5.29H16.536C20.123 5.29 21.447 7.116 21.447 10.767L21.419 15.732Z"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path>
                                                                            <path d="M7.48145 14.4629H16.2164"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path>
                                                                </svg>
                                                            </span>
                                                        </a>

                                                        <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#editSuratMasuk{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Edit" data-original-title="Edit" href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>

                                                        <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteConfirmationModal{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Delete">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                    stroke="currentColor">
                                                                    <path
                                                                        d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#detailSuratMasuk{{ $item->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Detail" data-original-title="Detail" href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M21.419 15.732C21.419 19.31 19.31 21.419 15.732 21.419H7.95C4.363 21.419 2.25 19.31 2.25 15.732V7.932C2.25 4.359 3.564 2.25 7.143 2.25H9.143C9.861 2.251 10.537 2.588 10.967 3.163L11.88 4.377C12.312 4.951 12.988 5.289 13.706 5.29H16.536C20.123 5.29 21.447 7.116 21.447 10.767L21.419 15.732Z"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path>
                                                                            <path d="M7.48145 14.4629H16.2164"
                                                                                stroke="currentColor" stroke-width="1.5"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path>
                                                                </svg>
                                                            </span>
                                                        </a>

                                                        <a class="btn btn-sm btn-icon btn-light" href="#">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>

                                                        <a class="btn btn-sm btn-icon btn-light" hre>
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                    stroke="currentColor">
                                                                    <path
                                                                        d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    @endif

                                                    <!-- Modal untuk Edit Surat Masuk -->
                                                    <div class="modal fade" id="editSuratMasuk{{ $item->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="editSuratMasukLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="editSuratMasukLabel{{ $item->id }}">Edit
                                                                        Surat Masuk</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="row g-3 needs-validation" method="POST"
                                                                        action="/surat-masuk/update/{{ $item->id }}"
                                                                        enctype="multipart/form-data" novalidate>
                                                                        @csrf
                                                                        <div class="col-md-6 position-relative">
                                                                            <label for="validationTooltip01"
                                                                                class="form-label">Perihal</label>
                                                                            <select class="form-select"
                                                                                id="validationTooltip04"
                                                                                value="{{ $item->perihal->perihal }}"
                                                                                name="id_perihal" required>
                                                                                <option selected
                                                                                    value="{{ $item->id_perihal }}">
                                                                                    {{ $item->perihal->perihal }}
                                                                                </option>
                                                                                @foreach ($perihal as $perihals)
                                                                                    <option value={{ $perihals->id }}>
                                                                                        {{ $perihals->perihal }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 position-relative">
                                                                            <label for="validationTooltip01"
                                                                                class="form-label">Nomor Surat</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nomor_surat"
                                                                                value="{{ $item->nomor_surat }}"
                                                                                id="validationTooltip01" required>
                                                                        </div>
                                                                        <div class="col-md-6 position-relative">
                                                                            <label for="validationTooltip01"
                                                                                class="form-label">Tanggal Surat</label>
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal_surat"
                                                                                value="{{ $item->tanggal_surat }}"
                                                                                id="validationTooltip01" required>
                                                                        </div>
                                                                        <div class="col-md-6 position-relative">
                                                                            <label for="validationTooltip04"
                                                                                class="form-label">Sifat Surat</label>
                                                                            <select class="form-select"
                                                                                id="validationTooltip04"
                                                                                value="{{ $item->sifat_surat }}"
                                                                                name="sifat_surat" required>
                                                                                <option selected
                                                                                    value="{{ $item->sifat_surat }}">
                                                                                    {{ $item->sifat_surat }}</option>
                                                                                <option value="segera">Segera</option>
                                                                                <option value="penting">Penting</option>
                                                                                <option value="rahasia">Rahasia</option>
                                                                                <option value="biasa">Biasa</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 position-relative">
                                                                            <label for="validationTooltip01"
                                                                                class="form-label">Pengirim</label>
                                                                            <input type="text" class="form-control"
                                                                                name="pengirim"
                                                                                value="{{ $item->pengirim }}"
                                                                                id="validationTooltip01" required>
                                                                        </div>
                                                                        <div class="col-md-12 position-relative">
                                                                            <label for="validationTooltip01"
                                                                                class="form-label">Isi Surat
                                                                                Ringkas</label>
                                                                            <textarea class="form-control" name="isi_surat_ringkas" id="validationTooltip01" cols="30" rows="2"
                                                                                required>{{ $item->isi_surat_ringkas }}</textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Simpan
                                                                                Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal untuk konfirmasi hapus Unit Kerja -->
                                                    <div class="modal fade"
                                                        id="deleteConfirmationModal{{ $item->id }}"
                                                        data-bs-backdrop="static" tabindex="-1"
                                                        aria-labelledby="deleteConfirmationModalLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteConfirmationModalLabel{{ $item->id }}">
                                                                        Konfirmasi Penghapusan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn text-white"
                                                                        data-bs-dismiss="modal"
                                                                        style="background-color: grey;">Batal</button>
                                                                    <a class="btn text-white"
                                                                        href="/surat-masuk/delete/{{ $item->id }}"
                                                                        style="background-color: red;">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">No</th>
                                        <th>Tanggal dan Jam</th>
                                        <th>Nomor Surat</th>
                                        <th>Sifat Surat</th>
                                        <th>Perihal</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
                                        <th style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratmasuk as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->nomor_surat }}</td>
                                            <td>{{ $data->sifat_surat }}</td>
                                            <td>{{ $data->perihal }}</td>
                                            <td>{{ $data->pengirim }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#detailSuratMasukOperator{{ $data->IdSuratMasuk }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"
                                                        data-original-title="Detail" href="#">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M21.419 15.732C21.419 19.31 19.31 21.419 15.732 21.419H7.95C4.363 21.419 2.25 19.31 2.25 15.732V7.932C2.25 4.359 3.564 2.25 7.143 2.25H9.143C9.861 2.251 10.537 2.588 10.967 3.163L11.88 4.377C12.312 4.951 12.988 5.289 13.706 5.29H16.536C20.123 5.29 21.447 7.116 21.447 10.767L21.419 15.732Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path>
                                                                        <path d="M7.48145 14.4629H16.2164"
                                                                            stroke="currentColor" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @foreach ($suratmasuk as $item)
        {{-- modal disposisi --}}
        <div class="modal fade " id="disposisi{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Disposisi Awal Surat Masuk No:
                            {{ $item->nomor_surat }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="/surat-masuk/disposisi/update/{{ $item->id }}" novalidate>
                            @csrf
                            <input type="hidden" name="file" value="{{ $item->file }}">
                            <div class="mb-3 row">
                                <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="perihal"
                                        value="{{ $item->perihal }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="dari_bagian" class="col-sm-2 col-form-label">Dari Bagian</label>
                                <div class="col-sm-10">
                                    @if (auth()->user()->role == 'superadmin')
                                        <input type="text" readonly class="form-control-plaintext" id="dari_bagian"
                                            value="Super User">
                                    @endif
                                    @if (auth()->user()->role == 'admin')
                                        <input type="text" readonly class="form-control-plaintext" id="dari_bagian"
                                            value="Admin">
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="validationTooltip04" class="col-sm-2 col-form-label">Disposisi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="validationTooltip04" name="id_unit_kerja">
                                        <option selected disabled value="">....</option>
                                        @foreach ($unitkerja as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_unit_kerja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="isi_disposisi" class="col-sm-2 col-form-label">Isi Disposisi</label>
                                <div class="col-sm-10">
                                    <textarea name="isi_disposisi" class="form-control" id="isi_disposisi" cols="30" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
        @foreach ($suratmasuk as $item)
            {{-- modal detail --}}
            <div class="modal fade " id="detailSuratMasuk{{ $item->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailSuratMasukLabel{{ $item->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="detailSuratMasukLabel{{ $item->id }}">Detail Surat Masuk
                                No: {{ $item->nomor_surat }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="detailTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                                        href="#detail{{ $item->id }}" role="tab" aria-controls="detail"
                                        aria-selected="true">Surat Masuk</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="attachment-tab" data-bs-toggle="tab"
                                        href="#attachment{{ $item->id }}" role="tab" aria-controls="attachment"
                                        aria-selected="false">Disposisi</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="detail{{ $item->id }}" role="tabpanel"
                                    aria-labelledby="detail-tab">
                                    <div class="row">
                                        <div class="col col-md-3">
                                            <h6 class="mt-4 mb-3">File</h6>
                                            <div class="text-center mb-3">
                                                @if ($item->file)
                                                    <a href="/storage/{{ $item->file }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Lihat File"
                                                        data-original-title="Lihat File" target="_blank">
                                                        <i>
                                                            <img src="https://th.bing.com/th/id/OIP.hSvI_pX7RzEjGcBQVUweqAAAAA?pid=ImgDet&rs=1"
                                                                alt="" style="width: 50%">
                                                        </i>
                                                    </a>
                                                @else
                                                    <p>Tidak ada file.</p>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <button class="btn border">{{ $item->nomor_surat }}</button>
                                            </div>
                                        </div>
                                        <div class="col col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Tanggal dan Jam</h6>
                                                        <p class="text-body">{{ $item->tanggal }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Tanggal Surat</h6>
                                                        <p class="text-body">{{ $item->tanggal_surat }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Pengirim</h6>
                                                        <p><a href="#" class="text-body">{{ $item->pengirim }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Perihal</h6>
                                                        <p><a href="#" class="text-body"
                                                                target="_blank">{{ $item->perihal->perihal }}</a></p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Isi Surat Ringkas</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#"
                                                                class="text-body">{{ $item->isi_surat_ringkas }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Disposisi Awal</h6>
                                                        @php
                                                            $firstDisposisi = null;
                                                            foreach ($disposisi as $disposisis) {
                                                                $firstDisposisi = $disposisis
                                                                    ->with('unitkerja')
                                                                    ->where('id_surat_masuk', $item->id)
                                                                    ->first();
                                                                if ($firstDisposisi) {
                                                                    break; // Berhenti jika disposisi pertama ditemukan
                                                                }
                                                            }
                                                        @endphp
                                                        <p><a href="#"
                                                                class="text-body">{{ $firstDisposisi == null ? '-' : $firstDisposisi->unitkerja->nama_unit_kerja }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Status</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#" class="text-body">{{ $item->status }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Lokasi Penyimpanan Arsip</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#"
                                                                class="text-body">{{ $item->lokasi_penyimpanan ? $item->lokasi_penyimpanan : '-' }}</a>
                                                        </p>
                                                    </div>

                                                    <div class="row d-flex">
                                                        <div class="col col-md-2">
                                                            <h6 class="mt-2">Aksi File</h6>
                                                        </div>
                                                        <div class="col col-md-10">
                                                            <form action="/surat-masuk/file/update/{{ $item->id }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row d-flex">
                                                                    <div class="col col-md-6">
                                                                        <input class="form-control" type="file"
                                                                            name="file">
                                                                    </div>
                                                                    <div class="mt-2 col col-md-6">
                                                                        <button class="btn btn-success btn-sm">
                                                                            {{ $item->file == null ? 'Tambah File' : 'Update File' }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="attachment{{ $item->id }}" role="tabpanel"
                                    aria-labelledby="attachment-tab">
                                    <div class="row">
                                        <div class="col col-md">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row p-4" style="background-color: rgb(235, 235, 235)">
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Tanggal Surat</h6>
                                                                <p class="text-black">{{ $item->tanggal_surat }}</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Sifat Surat</h6>
                                                                <p><a href="#"
                                                                        class="text-black">{{ $item->sifat_surat }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Asal Surat</h6>
                                                                <p><a href="#" class="text-black"
                                                                        target="_blank">{{ $item->pengirim }}</a></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Perihal</h6>
                                                                <p>
                                                                    <a href="#"
                                                                        class="text-black">{{ $item->perihal->perihal }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Disposisi Saat Ini</h6>

                                                                @php
                                                                    $latestDisposisi = null;
                                                                    if (!$disposisi->isEmpty()) {
                                                                        foreach ($disposisi as $disposisis) {
                                                                            $latestDisposisi = $disposisis
                                                                                ->with('unitkerja')
                                                                                ->where('id_surat_masuk', $item->id)
                                                                                ->latest()
                                                                                ->first();
                                                                        }
                                                                    }
                                                                @endphp

                                                                <p><a href="#" class="text-black"
                                                                        target="_blank">{{ $latestDisposisi == null ? '-' : $latestDisposisi->unitkerja->nama_unit_kerja }}</a>
                                                                </p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Isi Ringkas</h6>
                                                                <p>
                                                                    <a href="#"
                                                                        class="text-black">{{ $item->isi_surat_ringkas }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row p-4">
                                                        <div class="mb-2">
                                                            <h6>Riwayat Disposisi</h6>
                                                        </div>
                                                        <div class="col col-md">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <th>No</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Dari</th>
                                                                        <th>Instruksi/Informasi</th>
                                                                        <th>Diteruskan ke</th>
                                                                    </thead>
                                                                    @php
                                                                        $value = [];
                                                                        if (!$disposisi->isEmpty()) {
                                                                            foreach ($disposisi as $disposisis) {
                                                                                $value = $disposisis
                                                                                    ->with('unitkerja')
                                                                                    ->where('id_surat_masuk', $item->id)
                                                                                    ->get();
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if (!empty($value))
                                                                        @foreach ($value as $data)
                                                                            <tbody>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $data->tanggal }}</td>
                                                                                <td>{{ $data->unitkerja2 == null ? '-' : $data->unitkerja2->nama_unit_kerja }}
                                                                                </td>
                                                                                <td>{{ $data->isi_disposisi }}</td>
                                                                                <td>{{ $data->unitkerja == null ? '-' : $data->unitkerja->nama_unit_kerja }}
                                                                                </td>
                                                                            </tbody>
                                                                        @endforeach
                                                                    @endif
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        @foreach ($suratmasuk as $data)
            {{-- modal detail --}}
            <div class="modal fade " id="detailSuratMasukOperator{{ $data->IdSuratMasuk }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailSuratMasukLabel{{ $data->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="detailSuratMasukLabel{{ $data->IdSuratMasuk }}">Detail Surat
                                Masuk No: {{ $data->nomor_surat }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="detailTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                                        href="#detail{{ $data->IdSuratMasuk }}" role="tab" aria-controls="detail"
                                        aria-selected="true">Surat Masuk</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="attachment-tab" data-bs-toggle="tab"
                                        href="#attachment{{ $data->IdSuratMasuk }}" role="tab"
                                        aria-controls="attachment" aria-selected="false">Disposisi</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="detail{{ $data->IdSuratMasuk }}"
                                    role="tabpanel" aria-labelledby="detail-tab">
                                    <div class="row">
                                        <div class="col col-md-3">
                                            <h6 class="mt-4 mb-3">File</h6>
                                            <div class="text-center mb-3">
                                                @if ($data->file)
                                                    <a href="/storage/{{ $data->file }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Lihat File"
                                                        data-original-title="Lihat File" target="_blank">
                                                        <i>
                                                            <img src="https://th.bing.com/th/id/OIP.hSvI_pX7RzEjGcBQVUweqAAAAA?pid=ImgDet&rs=1"
                                                                alt="" style="width: 50%">
                                                        </i>
                                                    </a>
                                                @else
                                                    <p>Tidak ada file.</p>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <button class="btn border">{{ $data->nomor_surat }}</button>
                                            </div>
                                        </div>
                                        <div class="col col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Tanggal dan Jam</h6>
                                                        <p class="text-body">{{ $data->tanggal }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Tanggal Surat</h6>
                                                        <p class="text-body">{{ $data->tanggal_surat }}</p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Pengirim</h6>
                                                        <p><a href="#" class="text-body">{{ $data->pengirim }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Perihal</h6>
                                                        <p><a href="#" class="text-body"
                                                                target="_blank">{{ $data->perihal }}</a></p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Isi Surat Ringkas</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#"
                                                                class="text-body">{{ $data->isi_surat_ringkas }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h6 class="mb-1">Disposisi Awal</h6>
                                                        @php
                                                            $firstDisposisi = null;
                                                            foreach ($disposisi as $disposisis) {
                                                                $firstDisposisi = $disposisis
                                                                    ->with('unitkerja2')
                                                                    ->where('id_surat_masuk', $data->IdSuratMasuk)
                                                                    ->first();
                                                                if ($firstDisposisi) {
                                                                    break; // Berhenti jika disposisi pertama ditemukan
                                                                }
                                                            }
                                                        @endphp
                                                        <p><a href="#"
                                                                class="text-body">{{ $firstDisposisi == null ? '-' : $firstDisposisi->unitkerja->nama_unit_kerja }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Status</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#" class="text-body">{{ $data->status }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2"
                                                        style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                        <h6 class="mb-1">Lokasi Penyimpanan Arsip</h6>
                                                        <p style="white-space: normal;">
                                                            <a href="#"
                                                                class="text-body">{{ $data->lokasi_penyimpanan ? $data->lokasi_penyimpanan : '-' }}</a>
                                                        </p>
                                                    </div>

                                                    <div class="row d-flex">
                                                        <div class="col col-md-2">
                                                            <h6 class="mt-2">Aksi File</h6>
                                                        </div>
                                                        <div class="col col-md-10">
                                                            <form
                                                                action="/surat-masuk/file/update/{{ $data->IdSuratMasuk }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row d-flex">
                                                                    <div class="col col-md-6">
                                                                        <input class="form-control" type="file"
                                                                            name="file">
                                                                    </div>
                                                                    <div class="mt-2 col col-md-6">
                                                                        <button class="btn btn-success btn-sm">
                                                                            {{ $data->file == null ? 'Tambah File' : 'Update File' }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="attachment{{ $data->IdSuratMasuk }}" role="tabpanel"
                                    aria-labelledby="attachment-tab">
                                    <div class="row">
                                        <div class="col col-md">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if ($data->lokasi_penyimpanan == null)
                                                        <div class="row pb-3">
                                                            <div class="d-flex justify-content-end">
                                                                <div class="me-1">
                                                                    <button class="btn btn-sm btn-danger hentikanButton">
                                                                        <svg class="icon-20" width="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        Selesaikan Edaran
                                                                    </button>
                                                                </div>
                                                                <div class="">
                                                                    <button
                                                                        class="btn btn-sm btn-warning disposisikanButton">
                                                                        <svg class="icon-20" width="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M21.4354 2.58198C20.9352 2.0686 20.1949 1.87734 19.5046 2.07866L3.408 6.75952C2.6797 6.96186 2.16349 7.54269 2.02443 8.28055C1.88237 9.0315 2.37858 9.98479 3.02684 10.3834L8.0599 13.4768C8.57611 13.7939 9.24238 13.7144 9.66956 13.2835L15.4329 7.4843C15.723 7.18231 16.2032 7.18231 16.4934 7.4843C16.7835 7.77623 16.7835 8.24935 16.4934 8.55134L10.72 14.3516C10.2918 14.7814 10.2118 15.4508 10.5269 15.9702L13.6022 21.0538C13.9623 21.6577 14.5826 22 15.2628 22C15.3429 22 15.4329 22 15.513 21.9899C16.2933 21.8893 16.9135 21.3558 17.1436 20.6008L21.9156 4.52479C22.1257 3.84028 21.9356 3.09537 21.4354 2.58198Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        Disposisikan
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row pb-3">
                                                            <div class="d-flex justify-content-end">
                                                                <svg class="icon-32" width="32" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M16.3405 1.99976H7.67049C4.28049 1.99976 2.00049 4.37976 2.00049 7.91976V16.0898C2.00049 19.6198 4.28049 21.9998 7.67049 21.9998H16.3405C19.7305 21.9998 22.0005 19.6198 22.0005 16.0898V7.91976C22.0005 4.37976 19.7305 1.99976 16.3405 1.99976Z"
                                                                        fill="currentColor"></path>
                                                                    <path
                                                                        d="M10.8134 15.248C10.5894 15.248 10.3654 15.163 10.1944 14.992L7.82144 12.619C7.47944 12.277 7.47944 11.723 7.82144 11.382C8.16344 11.04 8.71644 11.039 9.05844 11.381L10.8134 13.136L14.9414 9.00796C15.2834 8.66596 15.8364 8.66596 16.1784 9.00796C16.5204 9.34996 16.5204 9.90396 16.1784 10.246L11.4324 14.992C11.2614 15.163 11.0374 15.248 10.8134 15.248Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                                <h4 class="ms-2">Close</h4>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row p-4" style="background-color: rgb(235, 235, 235)">
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Tanggal Surat</h6>
                                                                <p class="text-black">{{ $data->tanggal_surat }}</p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Sifat Surat</h6>
                                                                <p><a href="#"
                                                                        class="text-black">{{ $data->sifat_surat }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Asal Surat</h6>
                                                                <p><a href="#" class="text-black"
                                                                        target="_blank">{{ $data->pengirim }}</a></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Perihal</h6>
                                                                <p>
                                                                    <a href="#"
                                                                        class="text-black">{{ $data->perihal }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Disposisi Saat Ini</h6>

                                                                @php
                                                                    $latestDisposisi = null;
                                                                    foreach ($disposisi as $disposisis) {
                                                                        $latestDisposisi = $disposisis
                                                                            ->with('unitkerja2')
                                                                            ->where('id_surat_masuk', $data->IdSuratMasuk)
                                                                            ->latest()
                                                                            ->first();
                                                                        // Disposisi::where('id_surat_masuk', $req->id)->latest()->first();
                                                                        if ($latestDisposisi) {
                                                                            break; // Berhenti jika disposisi pertama ditemukan
                                                                        }
                                                                    }
                                                                @endphp

                                                                <p><a href="#" class="text-black"
                                                                        target="_blank">{{ $latestDisposisi == null ? '-' : $latestDisposisi->unitkerja->nama_unit_kerja }}</a>
                                                                </p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">Isi Ringkas</h6>
                                                                <p>
                                                                    <a href="#"
                                                                        class="text-black">{{ $data->isi_surat_ringkas }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row p-4">
                                                        <div class="mb-2">
                                                            <h6>Riwayat Disposisi</h6>
                                                        </div>
                                                        <div class="col col-md">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <th>No</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Dari</th>
                                                                        <th>Instruksi/Informasi</th>
                                                                        <th>Diteruskan ke</th>
                                                                    </thead>
                                                                    @php
                                                                        $value = [];
                                                                        if (!$disposisi->isEmpty()) {
                                                                            foreach ($disposisi as $disposisis) {
                                                                                $value = $disposisis
                                                                                    ->with('unitkerja')
                                                                                    ->where('id_surat_masuk', $data->IdSuratMasuk)
                                                                                    ->get();
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if (!empty($value))
                                                                        @foreach ($value as $values)
                                                                            <tbody>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $values->tanggal }}</td>
                                                                                <td>{{ $values->unitkerja2 == null ? '-' : $values->unitkerja2->nama_unit_kerja }}
                                                                                </td>
                                                                                <td>{{ $values->isi_disposisi }}</td>
                                                                                <td>{{ $values->unitkerja == null ? '-' : $values->unitkerja->nama_unit_kerja }}
                                                                                </td>
                                                                            </tbody>
                                                                        @endforeach
                                                                    @endif
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($data->status == 'Open')
                                                        <div class="row p-4">
                                                            <div id="formInput" class="formInput" style="display: none">
                                                                <h6>Selesaikan dan Simpan Arsip Surat No:
                                                                    {{ $data->nomor_surat }}</h6>
                                                                <form
                                                                    action="/surat-masuk/penyimpanan/update/{{ $data->IdSuratMasuk }}"
                                                                    method="post" novalidate>
                                                                    @csrf
                                                                    <div class="form-group mt-3 d-flex">
                                                                        <label for="lokasi_penyimpanan"
                                                                            class="me-5 mt-2">Lokasi Penyimpanan
                                                                            Arsip</label>
                                                                        <input type="text" name="lokasi_penyimpanan"
                                                                            id="lokasi_penyimpanan" class="form-control"
                                                                            style="width: 40%">
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-success me-2">Simpan</button>
                                                                        <button type="button" id="cancelFormButton"
                                                                            class="btn btn-sm btn-outline-dark cancelFormButton">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <div class="row p-4">
                                                            <div id="formInputDisposisikan" class="formInputDisposisikan"
                                                                style="display: none">
                                                                <h6>Disposisikan Surat Masuk No: {{ $data->nomor_surat }}
                                                                </h6>
                                                                <form
                                                                    action="/surat-masuk/disposisi/update/{{ $data->IdSuratMasuk }}"
                                                                    method="post" novalidate>
                                                                    @csrf
                                                                    <input type="hidden" name="file"
                                                                        value="{{ $data->file }}">
                                                                    <div class="form-group mt-3 d-flex">
                                                                        <label for="validationTooltip04"
                                                                            class="me-5 mt-3">Disposisi</label>
                                                                        <select class="form-select"
                                                                            id="validationTooltip04" name="id_unit_kerja"
                                                                            style="width: 40%">
                                                                            <option selected disabled value="">....
                                                                            </option>
                                                                            @foreach ($unitkerja as $unitkerjas)
                                                                                <option value="{{ $unitkerjas->id }}">
                                                                                    {{ $unitkerjas->nama_unit_kerja }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mt-1 d-flex">
                                                                        <label for="isi_disposisi" class="me-4 mt-3">Isi
                                                                            Disposisi</label>
                                                                        <textarea name="isi_disposisi" id="isi_disposisi" class="form-control" style="width: 40%" rows="2"
                                                                            cols="30"></textarea>
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-success me-2">Kirim</button>
                                                                        <button type="button"
                                                                            id="cancelFormButtonDisposisikan"
                                                                            class="btn btn-sm btn-outline-dark cancelFormButtonDisposisikan">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endsection
@section('script')
    <script>
        // Temukan semua tombol "Hentikan Edaran" berdasarkan kelas
        const hentikanButtons = document.querySelectorAll('.hentikanButton');
        const disposisikanButtons = document.querySelectorAll('.disposisikanButton');
        const cancelFormButtons = document.querySelectorAll('.cancelFormButton');
        const cancelFormButtonsDisposisikan = document.querySelectorAll('.cancelFormButtonDisposisikan');
        // Temukan semua elemen form input berdasarkan kelas
        const formInputs = document.querySelectorAll('.formInput');
        const formInputsDisposisikan = document.querySelectorAll('.formInputDisposisikan');

        // Tambahkan event listener untuk setiap tombol
        hentikanButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                // Tampilkan form input saat tombol diklik
                formInputs[index].style.display = 'block';
            });
        });

        disposisikanButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                // Tampilkan form input saat tombol diklik
                formInputsDisposisikan[index].style.display = 'block';
            });
        });

        cancelFormButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                // Sembunyikan form input saat tombol diklik
                formInputs[index].style.display = 'none';
            });
        });

        cancelFormButtonsDisposisikan.forEach(function(button, index) {
            button.addEventListener('click', function() {
                // Sembunyikan form input saat tombol diklik
                formInputsDisposisikan[index].style.display = 'none';
            });
        });
    </script>
@endsection
