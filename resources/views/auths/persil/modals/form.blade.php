<div class="modal fade bs-example-modal-lg f-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Persil</h4>
        </div>
        <div class="modal-body">
          <form id="form-add" method="post" action="{{route('persil')}}" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Pemohon <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nama_pemohon" name="nama_pemohon" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Klaster <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="klaster" name="klaster" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NUB <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="nub" name="nub" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tempat Lahir <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="tempat_lahir" name="tempat_lahir" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Lahir <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control has-feedback-left" id="tanggal_lahir" name="tanggal_lahir" required="required" aria-describedby="inputSuccess2Status4">
                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pekerjaan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="pekerjaan" name="pekerjaan" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Agama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="agama" name="agama" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Kelamin <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select class="form-control select2" style="width: 100%" multiple="multiple" id="jenis_kelamin" name="jenis_kelamin">
                  @foreach(array(0 => "Laki-laki", 1 => "Perempuan") as $jk => $k)
                      <option value="{{$jk}}">{{$k}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Desa <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="desa" name="desa" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kecamatan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="kecamatan" name="kecamatan" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kabupaten <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="kabupaten" name="kabupaten" required="required" class="form-control ">
              </div>
            </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Pemohon <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select class="form-control select2" style="width: 100%" multiple="multiple" id="jenis_pemohon" name="jenis_pemohon">
                  @foreach($jenis_pemohon as $pk => $p)
                      <option value="{{$pk}}">{{$p}}</option>
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
