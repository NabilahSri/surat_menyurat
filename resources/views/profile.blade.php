@extends('template_main')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Pengguna</h4>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary btn-icon" data-bs-toggle="modal" data-bs-target="#editprofile{{ $user->id }}">
                        <svg width="24" viewBox="0 0 24 24" class="animated-rotate icon-24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                       </svg> setup
                      </button>
                    </div>
                    <!-- Modal untuk Edit Profile -->
                    <div class="modal fade" id="editprofile{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editprofileLabel{{ $user->id }}" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h1 class="modal-title fs-5" id="editprofileLabel{{ $user->id }}">Edit Profile</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                          
                           <form class="row g-3 needs-validation" method="POST" action="/profile/update/{{ $user->id }}" enctype="multipart/form-data" novalidate>
                             @csrf
                             <div class="col-md-12 position-relative">
                                 <label for="validationTooltip01" class="form-label">Nama</label>
                                 <input type="text" class="form-control" name="nama" value="{{ $user->name }}" id="validationTooltip01" required>
                             </div>
                             <div class="col-md-6 position-relative">
                               <label for="validationTooltip01" class="form-label">Alamat</label>
                               <input type="text" class="form-control" name="alamat" value="{{ $user->alamat }}" id="validationTooltip01" required>
                           </div>
                             <div class="col-md-6 position-relative">
                               <label for="validationTooltip01" class="form-label">No Telp.</label>
                               <input type="number" class="form-control" name="telp" value="{{ $user->telp }}" id="validationTooltip01" required>
                             </div>
                             <div class="col-md-6 position-relative">
                               <label for="validationTooltip04" class="form-label">Jenis Kelamin</label>
                               <select class="form-select" id="validationTooltip04" value="{{ $user->jenis_kelamin }}" name="jenis_kelamin" required>
                                   <option selected value="{{ $user->jenis_kelamin }}">{{ $user->jenis_kelamin }}</option>
                                   <option value="laki-laki">Laki-laki</option>
                                   <option value="perempuan">Perempuan</option>
                               </select>
                             </div>
                             <div class="col-md-6 position-relative">
                              <label for="validationTooltip01" class="form-label">Unit Kerja</label>
                              <input type="text" class="form-control" name="unit_kerja" id="validationTooltip01" value={{ $user->unitkerja->nama_unit_kerja }} readonly required>
                            </div>
                             <div class="col-md-6 position-relative">
                               <label for="validationTooltip01" class="form-label">Username</label>
                               <input type="text" class="form-control" name="username" id="validationTooltip01" value={{ $user->username }} required>
                             </div>
                             <div class="col-md-6 position-relative">
                              <label for="validationTooltip01" class="form-label">Password</label>
                              <input type="password" class="form-control" name="password" id="validationTooltip01" placeholder="Silahkan input jika akan mengganti password">
                            </div>
                            <div class="col-md-12 position-relative">
                              <label for="validationTooltip01" class="form-label">Foto</label>
                              <input type="file" class="form-control" name="foto" id="validationTooltip01" value={{ $user->foto }}/>
                            </div>
                             <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                             </div>
                           </form>
                         </div>
                       </div>
                     </div>
                   </div>
                  </div>
               <div class="card-body">
                  <div class="new-user-info">
                    <div class="col col-md mb-3">
                      <div class="row ms-1 mb-1">
                        Foto
                      </div>
                      <div class="row">
                        @if($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="User Photo" style="width: 20%">
                        @else
                            <div class="text-danger">
                              Foto tidak tersedia
                            </div>
                        @endif
                      </div>
                    </div>
                     <form>
                        <div class="row">
                           <div class="form-group col-md-6">
                                 <label for="validationTooltip01" class="form-label">Nama</label>
                                 <input type="text" class="form-control" name="nama" value="{{ $user->name }}">
                             </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="lname">Alamat:</label>
                              <input type="text" class="form-control" id="lname" value={{ $user->alamat }}>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="add1">No Telepon:</label>
                              <input type="text" class="form-control" id="add1" value={{ $user->telp }}>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="add2">Jenis Kelamin:</label>
                              <input type="text" class="form-control" id="add2" value={{ $user->jenis_kelamin }}>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="cname">Unit Kerja:</label>
                              <input type="text" class="form-control" id="cname" value={{ $user->unitkerja == null ? '-' : $user->unitkerja->nama_unit_kerja }}>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="uname">Username:</label>
                              <input type="text" class="form-control" id="uname" value={{ $user->username }}>
                           </div>
                        <hr>
                     </form>
                  </div>
               </div>
            </div>
         </div>
    </div>
@endsection