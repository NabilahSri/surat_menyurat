@extends('template_main')

@section('content')
<div class="row">
    <div class="col col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Report Surat Masuk</h4>
                </div>
                <div>
                  <button type="submit" class="btn btn-success">
                    {{-- <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7364 2.76175H8.0844C6.0044 2.75375 4.3004 4.41075 4.2504 6.49075V17.2277C4.2054 19.3297 5.8734 21.0697 7.9744 21.1147C8.0114 21.1147 8.0484 21.1157 8.0844 21.1147H16.0724C18.1624 21.0407 19.8144 19.3187 19.8024 17.2277V8.03775L14.7364 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.4746 2.75V5.659C14.4746 7.079 15.6236 8.23 17.0436 8.234H19.7976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.6406 9.90869V15.9497" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M13.9864 12.2642L11.6414 9.90918L9.29639 12.2642" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                             --}}
                     <a href="/report-sm/cetak_pdf" target="_blank" class="text-white">Export</a>
                  </button>
                </div>
              </div>
            <div class="card-body p-0 mb-5">
                <div class="table-responsive mt-4">
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No. Surat</th>
                            <th>Tgl Surat</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Sifat</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($suratMasuk !== null)
                            @foreach ($suratMasuk as $key => $surat)
                            <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $surat->tanggal_surat }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->tanggal_surat }}</td>
                            <td>{{ $surat->pengirim }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ $surat->sifat_surat }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if ($suratMasuk->isEmpty())
                    <p class="mt-3 text-center">Tidak ada data ditemukan.</p>
                    @endif
              </div>
            </div>
          </div>
    </div>
</div>
@endsection