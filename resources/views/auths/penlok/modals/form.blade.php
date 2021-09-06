<div class="modal fade bs-example-modal-lg f-add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Penlok</h4>
      </div>
      <div class="modal-body">
        <form id="form-add" method="post" action="{{route('users')}}" data-parsley-validate class="form-horizontal form-label-left">
          @csrf

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

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Persil <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="jumlah_persil" name="jumlah_persil" required="required" class="form-control ">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. SK Penlok <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="no_sk_penlok" name="no_sk_penlok" required="required" class="form-control ">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal SK Penlok <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" class="form-control has-feedback-left" id="tanggal_sk_penlok" name="tanggal_sk_penlok" required="required" aria-describedby="inputSuccess2Status4">
              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
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