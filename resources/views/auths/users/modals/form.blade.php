<div class="modal fade bs-example-modal-lg f-add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
      </div>
      <div class="modal-body">
        <form id="form-add" method="post" action="{{route('users')}}" data-parsley-validate class="form-horizontal form-label-left">
          @csrf
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="username" name="username" required="required" class="form-control ">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="password" id="password" name="password" required="required" class="form-control ">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Lengkap <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="nama_lengkap" name="nama_lengkap" required="required" class="form-control ">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Level <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
              <select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="level" name="level">
                @foreach($pengguna as $key => $val)
                  <option value="{{(int)$key}}">{{$val}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Proyek <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" required="required" style="width: 100%" multiple="multiple" id="proyek_id" name="proyek_id">
                @foreach($proyek as $p)
                    <option value="{{(int)$p->id}}">{{$p->nama_proyek}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Desa <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" style="width: 100%" multiple="multiple" id="desa_id" name="desa_id">
                @foreach($desa as $d)
                    <option value="{{(int)$d->id}}">{{$d->nama_desa}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary add">Simpan</button>
        <button type="button" class="btn btn-primary update">Ubah</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>