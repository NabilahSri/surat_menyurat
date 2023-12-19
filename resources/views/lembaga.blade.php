@extends('template_main')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col col-md-8">
            <div class="card">
                @foreach ($lembaga as $item)
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $item->nama_lembaga }}</h4>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                data-bs-target="#editlembaga{{ $item->id }}">
                                <svg width="24" viewBox="0 0 24 24" class="animated-rotate icon-24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg> setup
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-2">
                            <h6 class="mb-1">Kabupaten / Kota:</h6>
                            <p>{{ $item->kabupaten == null ? '-' : $item->kabupaten }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">No Telepon:</h6>
                            <p>{{ $item->telp == null ? '-' : $item->telp }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Email:</h6>
                            <p><a href="#" class="text-body">{{ $item->email == null ? '-' : $item->email }}</a></p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Alamat:</h6>
                            <p><a href="#" class="text-body"
                                    target="_blank">{{ $item->alamat == null ? '-' : $item->alamat }}</a></p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Kepala:</h6>
                            <p><a href="#"
                                    class="text-body">{{ $item->nama_ketua == null ? '-' : $item->nama_ketua }}</a></p>
                        </div>
                    </div>
                    <!-- Modal untuk Edit Lembaga -->
                    <div class="modal fade" id="editlembaga{{ $item->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUnitKerjaModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="">Edit Lembaga</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3 needs-validation" method="POST"
                                        action="/lembaga/update/{{ $item->id }}" novalidate>
                                        @csrf
                                        <input type="hidden" name="unit_id" id="editUnitId">
                                        <div class="col-md-12 position-relative">
                                            <label for="editNamaUnitKerja" class="form-label">Kabupaten / Kota</label>
                                            <input type="text" class="form-control" name="kabupaten" id=""
                                                value="{{ $item->kabupaten }}" required>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                            <label for="editNamaUnitKerja" class="form-label">Telp</label>
                                            <input type="text" class="form-control" name="telp" id=""
                                                value="{{ $item->telp }}"required>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                            <label for="editNamaUnitKerja" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id=""
                                                value="{{ $item->email }}" required>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                            <label for="editNamaUnitKerja" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="" id="" cols="30" rows="2" required>{{ $item->alamat }}</textarea>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                            <label for="editNamaUnitKerja" class="form-label">Nama Kepala</label>
                                            <input type="text" class="form-control" name="nama_ketua" id=""
                                                value="{{ $item->nama_ketua }}" required>
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
                @endforeach
            </div>
        </div>
    </div>

    <script>
        if (session('success')) // Check if a success message is set in the session
            Swal.fire({
                icon: 'success',
                title: 'Update Successful',
                text: 'Data lembaga berhasil di update!',
            });
    </script>
@endsection
