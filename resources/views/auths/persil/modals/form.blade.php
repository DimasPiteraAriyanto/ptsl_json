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
                    <select class="form-control select2" style="width: 100%" multiple="multiple" id="nama_pemohon" name="nama_pemohon">
                        @foreach($persil as $item)
                          <option value="{{$item->pemohon->id}}">{{$item->pemohon->nama_pemohon}}</option>
                        @endforeach
                      </select>
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
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Luas Pengukuran <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="luas_pengukuran" name="luas_pengukuran" required="required" class="form-control ">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Penggunaan Tanah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" class="form-control" id="penggunaan_tanah" name="penggunaan_tanah" required="required">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanda Batas <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="tanda_batas" name="tanda_batas" required="required" class="form-control ">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. PBT <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="no_pbt" name="no_pbt" required="required" class="form-control ">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. GU <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="no_gu" id="no_gu" class="form-control" required="required">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No Berkas Fisik <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="no_berkas_fisik" name="no_berkas_fisik" required="required" class="form-control ">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NIB <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" id="nib" name="nib" required="required" class="form-control ">
                </div>
              </div>

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Panitia Ajudikasi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <select class="form-control select2" style="width: 100%" multiple="multiple" id="ajudikasi_id" name="ajudikasi_id">
                  @foreach($persil as $item)
                    <option value="{{$item->ajudikasi->id}}">{{$item->ajudikasi->nama_pegawai}}</option>
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
