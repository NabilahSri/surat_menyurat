@extends('template_main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Surat Keluar</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="">
                            <button type="button" class="btn btn-success me-2">
                                <a href="/surat-keluar/cetak_pdf" target="_blank" class="text-white ">Export</a>
                            </button>
                        </div>
                        <div>
                            @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                <!-- Button modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Tambah
                                </button>
                            @endif

                            <!-- Modal Tambah-->
                            <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Surat Keluar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation" method="POST"
                                                action="/surat-keluar/create" enctype="multipart/form-data" novalidate>
                                                @csrf
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Perihal</label>
                                                    <select class="form-select" id="perihal_select" name="perihal_select"
                                                        required>
                                                        <option selected disabled value="">...</option>
                                                        @foreach ($perihal as $item)
                                                            <option value="{{ $item->id }}">{{ $item->perihal }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Nomor Surat</label>
                                                    <input type="text" class="form-control" name="nomor_surat"
                                                        id="nomor_surat" value="{{ $no_surat }}" readonly required>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Tanggal
                                                        Surat</label>
                                                    <input type="date" class="form-control" name="tanggal_surat"
                                                        id="validationTooltip01" required>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip04" class="form-label">Sifat Surat</label>
                                                    <select class="form-select" id="validationTooltip04" name="sifat_surat"
                                                        required>
                                                        <option selected disabled value="">...</option>
                                                        <option value="segera">Segera</option>
                                                        <option value="penting">Penting</option>
                                                        <option value="rahasia">Rahasia</option>
                                                        <option value="biasa">Biasa</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip04" class="form-label">Pengirim</label>
                                                    <select class="form-select" id="validationTooltip04" name="pengirim"
                                                        required>
                                                        <option selected disabled value="">...</option>
                                                        @foreach ($unitkerja as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_unit_kerja }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Tertuju
                                                        Kepada</label>
                                                    <input type="text" class="form-control" name="tujuan"
                                                        id="validationTooltip01" required>
                                                </div>
                                                <div class="col-md-12 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Alamat</label>
                                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2" required></textarea>
                                                </div>
                                                <div class="col-md-12 position-relative">
                                                    <label for="validationTooltip01" class="form-label">Isi Surat
                                                        Ringkas</label>
                                                    <textarea class="form-control" name="isi_surat_ringkas" id="validationTooltip01" cols="30" rows="2"
                                                        required></textarea>
                                                </div>
                                                <div class="col-md-12 position-relative">
                                                    <label for="validationTooltip01" class="form-label">File</label>
                                                    <input type="file" class="form-control" name="file"
                                                        id="validationTooltip01" />
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
                        </div>
                    </div>
                </div>
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
                                    <th>Kepada</th>
                                    <th style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratkeluar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->nomor_surat }}</td>
                                        <td>{{ $item->sifat_surat }}</td>
                                        <td>{{ $item->perihal->perihal }}</td>
                                        <td>{{ $item->unitkerja->nama_unit_kerja }}</td>
                                        <td>{{ $item->tujuan }}</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                                    <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#detailSuratMasuk{{ $item->id }}"
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
                                                    <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editSuratMasuk{{ $item->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                        data-original-title="Edit" href="#">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteConfirmationModal{{ $item->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                stroke="currentColor">
                                                                <path
                                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                @else
                                                    <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#detailSuratMasuk{{ $item->id }}"
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
                                                                    id="editSuratMasukLabel{{ $item->id }}">Edit Surat
                                                                    keluar</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="row g-3 needs-validation" method="POST"
                                                                    action="/surat-keluar/update/{{ $item->id }}"
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
                                                                    <div class="col-md-6 position-relative">
                                                                        <label for="validationTooltip04"
                                                                            class="form-label">Pengirim</label>
                                                                        <select class="form-select"
                                                                            id="validationTooltip04"
                                                                            value="{{ $item->unitkerja->nama_unit_kerja }}"
                                                                            name="pengirim" required>
                                                                            <option selected
                                                                                value="{{ $item->pengirim }}">
                                                                                {{ $item->unitkerja->nama_unit_kerja }}
                                                                            </option>
                                                                            @foreach ($unitkerja as $unitkerjas)
                                                                                <option value={{ $unitkerjas->id }}>
                                                                                    {{ $unitkerjas->nama_unit_kerja }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6 position-relative">
                                                                        <label for="validationTooltip01"
                                                                            class="form-label">Tertuju Kepada</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tujuan" value="{{ $item->tujuan }}"
                                                                            id="validationTooltip01" required>
                                                                    </div>
                                                                    <div class="col-md-12 position-relative">
                                                                        <label for="validationTooltip01"
                                                                            class="form-label">Alamat</label>
                                                                        <textarea class="form-control" name="alamat" id="validationTooltip01" cols="30" rows="2" required>{{ $item->alamat }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-12 position-relative">
                                                                        <label for="validationTooltip01"
                                                                            class="form-label">Isi Surat Ringkas</label>
                                                                        <textarea class="form-control" name="isi_surat_ringkas" id="validationTooltip01" cols="30" rows="2"
                                                                            required>{{ $item->isi_surat_ringkas }}</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
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
                                                <div class="modal fade" id="deleteConfirmationModal{{ $item->id }}"
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
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn text-white"
                                                                    data-bs-dismiss="modal"
                                                                    style="background-color: grey;">Batal</button>
                                                                <a class="btn text-white"
                                                                    href="/surat-keluar/delete/{{ $item->id }}"
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
            </div>
        </div>
    </div>

    @foreach ($suratkeluar as $item)
        {{-- modal detail --}}
        <div class="modal fade " id="detailSuratMasuk{{ $item->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailSuratMasukLabel{{ $item->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailSuratMasukLabel{{ $item->id }}">Detail Surat Keluar
                            No: {{ $item->nomor_surat }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="detailTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                                    href="#detail{{ $item->id }}" role="tab" aria-controls="detail"
                                    aria-selected="true">Surat Keluar</a>
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
                                                    <p><a href="#"
                                                            class="text-body">{{ $item->unitkerja->nama_unit_kerja }}</a>
                                                    </p>
                                                </div>
                                                <div class="mt-2">
                                                    <h6 class="mb-1">Sifat Surat</h6>
                                                    <p><a href="#" class="text-body">{{ $item->sifat_surat }}</a>
                                                    </p>
                                                </div>
                                                <div class="mt-2">
                                                    <h6 class="mb-1">Perihal</h6>
                                                    <p><a href="#" class="text-body"
                                                            target="_blank">{{ $item->perihal->perihal }}</a></p>
                                                </div>
                                                <div class="mt-2">
                                                    <h6 class="mb-1">Tertuju Kepada</h6>
                                                    <p><a href="#" class="text-body">{{ $item->tujuan }}</a></p>
                                                </div>
                                                <div class="mt-2">
                                                    <h6 class="mb-1">Alamat</h6>
                                                    <p><a href="#" class="text-body">{{ $item->alamat }}</a></p>
                                                </div>
                                                <div class="mt-2"
                                                    style="max-width: 400px; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <h6 class="mb-1">Isi Surat Ringkas</h6>
                                                    <p style="white-space: normal;">
                                                        <a href="#"
                                                            class="text-body">{{ $item->isi_surat_ringkas }}</a>
                                                    </p>
                                                </div>
                                                <div class="row d-flex">
                                                    <div class="col col-md-2">
                                                        <h6 class="mt-2">Aksi File</h6>
                                                    </div>
                                                    <div class="col col-md-10">
                                                        <form action="/surat-keluar/file/update/{{ $item->id }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const perihalSelect = document.getElementById('perihal_select');
            const nomorSuratInput = document.getElementById('nomor_surat');

            perihalSelect.addEventListener('change', function() {
                if (perihalSelect.value) {
                    const perihal = @json($perihal);
                    console.log(perihal);
                    const selectedPerihal = perihal.find(p => p.id == perihalSelect.value);

                    if (selectedPerihal) {
                        const automaticNumber = nomorSuratInput.value.replace("perihal", selectedPerihal
                            .kode)
                        nomorSuratInput.value = automaticNumber;

                    }
                }
            });
        });
    </script>
@endsection
