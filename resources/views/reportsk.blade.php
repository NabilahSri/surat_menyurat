@extends('template_main')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">Report Surat Keluar</h3>
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="row mb-4">
                            <div class="col col-md-12 d-flex justify-content-between flex-wrap">
                                <form method="get" action="/report-sk/action" onsubmit="return validateForm()">
                                    <div class="d-flex ustify-content-between">
                                        <div class="row g-3 align-items-center me-5">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">dari tanggal</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" name="tanggal_awal" id="tanggal_awal"
                                                    placeholder="sampai tanggal" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center me-5">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">sampai tanggal</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                                    placeholder="sampai tanggal" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center me-5">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">unit kerja /
                                                    bagian</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select" id="validationTooltip04" name="id_unit_kerja">
                                                    <option selected value="">semua unit</option>
                                                    @foreach ($unitkerja as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_unit_kerja }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center me-5">
                                            <div class="col-auto">
                                                <label for="inputPassword6" class="col-form-label">Perihal</label>
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select" id="validationTooltip04" name="perihal">
                                                    <option selected value="">semua perihal</option>
                                                    @foreach ($perihal as $item)
                                                        <option value="{{ $item->id }}">{{ $item->perihal }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-success">
                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14.7364 2.76175H8.0844C6.0044 2.75375 4.3004 4.41075 4.2504 6.49075V17.2277C4.2054 19.3297 5.8734 21.0697 7.9744 21.1147C8.0114 21.1147 8.0484 21.1157 8.0844 21.1147H16.0724C18.1624 21.0407 19.8144 19.3187 19.8024 17.2277V8.03775L14.7364 2.76175Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M14.4746 2.75V5.659C14.4746 7.079 15.6236 8.23 17.0436 8.234H19.7976"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M11.6406 9.90869V15.9497" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M13.9864 12.2642L11.6414 9.90918L9.29639 12.2642"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                    Report
                                                </button>
                                            </div>
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
    <script>
        function validateForm() {
            var tanggalAwal = document.getElementById("tanggal_awal").value;
            var tanggalAkhir = document.getElementById("tanggal_akhir").value;

            if (!tanggalAwal || !tanggalAkhir) {
                alert("Silakan isi kedua tanggal sebelum melanjutkan.");
                return false;
            }

            return true;
        }
    </script>
@endsection
