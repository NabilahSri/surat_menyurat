@extends('template_main')

@section('content')
  <div class="row">
    <div class="col-sm-12">
        <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="header-title">
              <h4 class="card-title">User</h4>
          </div>
          <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Tambah
            </button>

            <!-- Modal Tambah-->
            <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="row g-3 needs-validation" method="POST" action="/user/create" enctype="multipart/form-data" novalidate>
                      @csrf
                      <div class="col-md-12 position-relative">
                          <label for="validationTooltip01" class="form-label">Nama</label>
                          <input type="text" class="form-control" name="name" id="validationTooltip01" required>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip01" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="validationTooltip01" required>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip01" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="validationTooltip01" required>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip04" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="validationTooltip04" name="jenis_kelamin" required>
                            <option selected disabled value="">...</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip01" class="form-label">Telp.</label>
                        <input type="number" class="form-control" name="telp" id="validationTooltip01" required>
                      </div>
                      <div class="col-md-12 position-relative">
                        <label for="validationTooltip01" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="validationTooltip01" cols="30" rows="2" required></textarea>
                      </div>
                      @if (auth()->user()->role == "superadmin")
                        <div class="col-md-6 position-relative">
                          <label for="validationTooltip04" class="form-label">Role</label>
                          <select class="form-select" id="validationTooltip04" name="role" required>
                              <option selected disabled value="">...</option>
                              <option value="admin">Admin</option>
                              <option value="operator">Operator</option>
                          </select>
                        </div>
                      @elseif (auth()->user()->role == "admin")
                        <div class="col-md-6 position-relative">
                          <label for="validationTooltip04" class="form-label">Role</label>
                          <select class="form-select" id="validationTooltip04" name="role" required>
                              <option selected value="operator">Operator</option>
                          </select>
                        </div>
                      @endif
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip04" class="form-label">Unit Kerja</label>
                        <select class="form-select" id="validationTooltip04" name="id_unit_kerja" required>
                            <option selected disabled value="">...</option>
                            @foreach ($unitkerja as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_unit_kerja }}</option>
                            @endforeach
                        </select>
                      </div>
                       <div class="col-md-12 position-relative">
                          <label for="validationTooltip01" class="form-label">Foto</label>
                          <input type="file" class="form-control" name="foto" id="validationTooltip01"/>
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
          </div>
        </div>
          <div class="card-body">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                        <th style="width: 40px">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Jenis Kelamin</th>
                        <th>Unit Kerja</th>
                        <th>Role</th>
                        <th>Foto</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->username }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>{{ $item->telp }}</td>
                      <td>{{ $item->jenis_kelamin }}</td>
                      <td>{{ $item->unitkerja->nama_unit_kerja }}</td>
                      <td>{{ $item->role }}</td>
                      <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="User Photo" style="border-radius: 50%; width: 100px; height: 100px;">
                        @else
                            <div class="text-danger">
                              Foto tidak tersedia
                            </div>
                        @endif
                      </td>
                    
                      <td>
                        <div class="flex align-items-center list-user-action">
                          <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#edituser{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit" href="#">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                          </a>

                          <!-- Modal untuk Edit Unit Kerja -->
                          <div class="modal fade" id="edituser{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUnitKerjaLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="edituserlabel{{ $item->id }}">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form class="row g-3 needs-validation" method="POST" action="/user/update/{{ $item->id }}" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <div class="col-md-12 position-relative">
                                            <label for="validationTooltip01" class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="name" id="validationTooltip01" value="{{ $item->name }}" required>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                          <label for="validationTooltip01" class="form-label">Username</label>
                                          <input type="text" class="form-control" name="username" id="validationTooltip01" value="{{ $item->username }}" required>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                          <label for="validationTooltip01" class="form-label">Password</label>
                                          <input type="password" class="form-control" name="password" id="validationTooltip01" placeholder="silahkan input jika ingin edit password">
                                        </div>
                                        <div class="col-md-6 position-relative">
                                          <label for="validationTooltip04" class="form-label">Jenis Kelamin</label>
                                          <select class="form-select" id="validationTooltip04" name="jenis_kelamin">
                                              <option selected value="{{ $item->jenis_kelamin }}">{{ $item->jenis_kelamin }}</option>
                                              <option value="laki-laki">Laki-laki</option>
                                              <option value="perempuan">Perempuan</option>
                                          </select>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                          <label for="validationTooltip01" class="form-label">Telp.</label>
                                          <input type="number" class="form-control" name="telp" id="validationTooltip01" value="{{ $item->telp }}" required>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                          <label for="validationTooltip01" class="form-label">Alamat</label>
                                          <textarea class="form-control" name="alamat" id="validationTooltip01" cols="30" rows="2" required>{{ $item->alamat }}</textarea>
                                        </div>
                                        @if (auth()->user()->role == "superadmin")
                                          <div class="col-md-6 position-relative">
                                            <label for="validationTooltip04" class="form-label">Role</label>
                                            <select class="form-select" id="validationTooltip04" name="role" required>
                                              <option selected value={{ $item->role }}>{{ $item->role }}</option>
                                                <option value="admin">Admin</option>
                                                <option value="operator">Operator</option>
                                            </select>
                                          </div>
                                        @elseif (auth()->user()->role == "admin")
                                          <div class="col-md-6 position-relative">
                                            <label for="validationTooltip04" class="form-label">Role</label>
                                            <select class="form-select" id="validationTooltip04" name="role" required>
                                                <option selected value={{ $item->role }}>{{ $item->role }}</option>
                                            </select>
                                          </div>
                                        @endif
                                        <div class="col-md-6 position-relative">
                                          <label for="validationTooltip04" class="form-label">Unit Kerja</label>
                                          <select class="form-select" id="validationTooltip04" name="id_unit_kerja">
                                              <option selected value="{{ $item->id_unit_kerja }}">{{ $item->unitkerja->nama_unit_kerja }}</option>
                                              @foreach ($unitkerja as $unitkerjas)
                                              <option value="{{ $unitkerjas->id }}">{{ $unitkerjas->nama_unit_kerja }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                          <label for="validationTooltip01" class="form-label">Foto</label>
                                          <input type="file" class="form-control" name="foto" id="validationTooltip01" value={{ $item->foto }}/>
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

                          <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                  <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                          </a>
                          <!-- Modal untuk konfirmasi hapus Unit Kerja -->
                          <div class="modal fade" id="deleteConfirmationModal{{ $item->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $item->id }}">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color: grey;">Batal</button>
                                        <a class="btn text-white" href="/user/delete/{{ $item->id }}" style="background-color: red;">Hapus</a>
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

  <script>
  // Add an event listener to the form to check password confirmation
  document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
      var password = form.querySelector('input[name="password"]').value;
      var confirmPassword = form.querySelector('input[name="confirm_password"]').value;

      if (password !== confirmPassword) {
        alert("Password and Confirm Password do not match");
        event.preventDefault(); // Prevent form submission
      }
    });
  });
</script>
  
@endsection