@extends('auths.layouts.app')
@section('title', 'Dashboard - PTSL')
@section('content')
<div class="x_panel">
   <div class="x_title">
      <h2>{{$jenis_alas_hak->nama_jenis_alas_hak}}</h2>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12" style="margin-bottom: 10px;">
         <h4>{{$penlok->proyek->nama_proyek}}</h4>
         <span class="badge badge-info" style="padding: 8px; margin:1px;">Tahun: {{$penlok->proyek->tahun}}</span>
         <span class="badge badge-secondary" style="padding: 8px; margin:1px;">No. SK Penlok: {{$penlok->no_sk_penlok}}</span>
         <span class="badge badge-warning" style="padding: 8px; margin:1px;">Tanggal SK Penlok: {{$penlok->tanggal_sk_penlok->format('d F Y')}}</span>
         <span class="badge badge-success" style="padding: 8px; margin:1px;">Desa: {{$penlok->desa->nama_desa}}</span>
         <span class="badge badge-danger" style="padding: 8px; margin:1px;">No. Berkas: {{$nob}}</span>
      </div>
      <div class="col-md-12 col-sm-12 ">
          <form id="demo-form2" method="post" action="{{route('alas-hak')}}">
          @csrf

          <input type="hidden" name="pid" id="pid" value="{{$pid}}">
          <input type="hidden" name="nob" id="nob" value="{{$nob}}">
          <input type="hidden" name="doc" id="doc" value="{{$doc}}">
          <input type="hidden" name="jid" id="jid" value="{{Request::segment(7)}}">
          <input type="hidden" name="session" id="session" class="form-control" value="{{$session}}">

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pemohon <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" multiple="multiple" name="pemohon_id" id="pemohon_id">
                  @foreach($pemohon as $p)
                      <option value="{{$p->id}}">{{$p->nama_pemohon}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Klaster <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" multiple="multiple" name="klaster">
                  @foreach(array("K1", "K2", "K3", "K4") as $k)
                      <option value="{{$k}}">Klaster: {{$k}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Status Surat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" multiple="multiple" name="status_surat">
                  @foreach(array("Asli", "Foto Copy") as $s)
                      <option value="{{$s}}">{{$s}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" multiple="multiple" name="jenis_hak">
                  @foreach(array("Hak Milik", "Hak Guna Bangunan", "Hak Guna Usaha", "Hak Pakai", "Hak Wakaf") as $hk)
                      <option value="{{$hk}}">{{$hk}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Alas Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="nama_alas_hak" id="nama_alas_hak" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Alas Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="no_alas_hak" id="no_alas_hak" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Alas Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" class="form-control has-feedback-left" id="tanggal_alas_hak" name="tanggal_alas_hak" required="required" aria-describedby="inputSuccess2Status4">
              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pembuat Alas Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="pembuat_alas_hak" id="pembuat_alas_hak" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Luas yang Dimohon <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="luas_yang_dimohon" id="luas_yang_dimohon" class="form-control">
            </div>
          </div>
          <center>Batas Tanah:</center>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Utara <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="utara" id="utara" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Timur <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="timur" id="timur" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selatan <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="selatan" id="selatan" class="form-control">
            </div>
          </div>

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Barat <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" name="barat" id="barat" class="form-control">
            </div>
          </div>



          <!-- JUAL BELI, GANTI USAHA -->
          @if($jid == 4 || $jid == 8)
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="harga" id="harga" class="form-control">
                </div>
              </div>
          @endif
          <!-- BATAS -->

          <!-- WARISAN -->
          @if($jid == 6)
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Almarhum <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="nama_almarhum" id="nama_almarhum" class="form-control">
                </div>
              </div>

              <center>Meninggal:</center>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" class="form-control has-feedback-left" id="tanggal_meninggal" name="tanggal_meninggal" required="required" aria-describedby="inputSuccess2Status4">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Desa <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="desa_meninggal" id="desa_meninggal" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kecamatan <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="kecamatan_meninggal" id="kecamatan_meninggal" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kabupaten <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="kabupaten_meninggal" id="kabupaten_meninggal" class="form-control">
                </div>
              </div>

              <center>Tinggal Terakhir di:</center>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Desa <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="desa_tinggal" id="desa_tinggal" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kecamatan <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="kecamatan_tinggal" id="kecamatan_tinggal" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kabupaten <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="kabupaten_tinggal" id="kabupaten_tinggal" class="form-control">
                </div>
              </div>

              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perkawinan Dengan <span>*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="perkawinan_dengan" id="perkawinan_dengan" class="form-control">
                </div>
              </div>
          @endif
          <!-- BATAS -->

          <!-- SAKSI -->
          @if($jid != 1)
              <div class="card-box table-responsive" style="margin-bottom: 5px;">
                <table id="saksitable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popSaksi()"  class="btn btn-info btn-sm">Entri Saksi</a></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Nama Saksi</th>
                      <th>NIK</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <script type="text/javascript">
                  function popSaksi() {
                    var pid = $('#pid').val();
                    var nob = $('#nob').val();
                    var doc = $('#doc').val();
                    var session = $('#session').val();
                    var myWindow = window.open("{{url(config('app.root').'/saksi')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
                    myWindow.onunload = function(){
                        $('#saksitable').DataTable().ajax.reload();
                    };
                  }
              </script>
          @endif
          <!-- BATAS -->

          <!-- PIHAK PERTAMA -->
          @if($jid == 4 || $jid == 5 || $jid == 8 || $jid == 9)
              <div class="card-box table-responsive"  style="margin-bottom: 5px;">
                <table id="pihakpertamatable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popPihakPertama()"  class="btn btn-info btn-sm">Entri Pihak I</a></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Nama Pihak Pertama</th>
                      <th>NIK</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <script type="text/javascript">
                  function popPihakPertama() {
                    var pid = $('#pid').val();
                    var nob = $('#nob').val();
                    var doc = $('#doc').val();
                    var session = $('#session').val();
                    var myWindow = window.open("{{url(config('app.root').'/pihak-pertama')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=no,scrollbars=yes,resizable=no,top=500,left=500,width=4000,height=4000");
                    myWindow.onunload = function(){
                        $('#pihakpertamatable').DataTable().ajax.reload();
                    };
                  }
              </script>
          @endif
          <!-- BATAS -->

          <!-- PERSETUJUAN KELUARGA -->
          @if($jid == 5)
              <div class="card-box table-responsive" style="margin-bottom: 5px;">
                <table id="persetujuankeluargatable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popPersetujuanKeluarga()"  class="btn btn-info btn-sm">Entri Persetujuan Keluarga</a></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Nama Pihak Pertama</th>
                      <th>NIK</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <script type="text/javascript">
                  function popPersetujuanKeluarga() {
                    var pid = $('#pid').val();
                    var nob = $('#nob').val();
                    var doc = $('#doc').val();
                    var session = $('#session').val();
                    var myWindow = window.open("{{url(config('app.root').'/persetujuan-keluarga')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
                    myWindow.onunload = function(){
                        $('#persetujuankeluargatable').DataTable().ajax.reload();
                    };
                  }
              </script>
          @endif
          <!-- BATAS -->

          <!-- AHLI WARIS -->
          @if($jid == 6)
              <div class="card-box table-responsive" style="margin-bottom: 5px;">
                <table id="ahliwaristable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popAhliWaris()"  class="btn btn-info btn-sm">Entri Ahli Waris</a></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Nama Ahli Waris</th>
                      <th>NIK</th>
                      <th>Proses</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <script type="text/javascript">
                  function popAhliWaris() {
                    var pid = $('#pid').val();
                    var nob = $('#nob').val();
                    var doc = $('#doc').val();
                    var session = $('#session').val();
                    var myWindow = window.open("{{url(config('app.root').'/ahli-waris')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
                    myWindow.onunload = function(){
                        $('#ahliwaristable').DataTable().ajax.reload();
                    };
                  }
              </script>
          @endif
          <!-- BATAS -->

          <!-- SEMUA -->
          <div class="card-box table-responsive" style="margin-bottom: 5px;">
            <table id="penerimakuasatable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popPenerimaKuasa()"  class="btn btn-info btn-sm">Entri Penerima Kuasa</a></th>
                </tr>
                <tr>
                  <th>ID</th>
                  <th>Nama Penerima Kuasa</th>
                  <th>NIK</th>
                  <th>Proses</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <script type="text/javascript">
              function popPenerimaKuasa() {
                var pid = $('#pid').val();
                var nob = $('#nob').val();
                var doc = $('#doc').val();
                var session = $('#session').val();
                var myWindow = window.open("{{url(config('app.root').'/penerima-kuasa')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
                myWindow.onunload = function(){
                    $('#penerimakuasatable').DataTable().ajax.reload();
                };
              }
          </script>
          <!-- BATAS -->

          <!-- SEMUA -->
          <div class="card-box table-responsive" style="margin-bottom: 5px;">
            <table id="penyanggahtable" class="table table-striped responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th colspan="100"><a style="color: #FFF; cursor: pointer;" onclick="popPenyanggah()"  class="btn btn-info btn-sm">Entri Penyanggah</a></th>
                </tr>
                <tr>
                  <th>ID</th>
                  <th>Nama Penyanggah</th>
                  <th>NIK</th>
                  <th>Proses</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <script type="text/javascript">
              function popPenyanggah() {
                var pid = $('#pid').val();
                var nob = $('#nob').val();
                var doc = $('#doc').val();
                var session = $('#session').val();
                var myWindow = window.open("{{url(config('app.root').'/penyanggah')}}/" + pid + '/' +nob+ '/' + doc + '/' + session, "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
                myWindow.onunload = function(){
                    $('#penyanggahtable').DataTable().ajax.reload();
                };
              }
          </script>
          <!-- BATAS -->

          <div class="ln_solid"></div>
          <div class="item form-group">
            <div class="col-md-12 col-sm-12 offset-md-12">
              <button type="submit" class="btn btn-success btn-sm">Proses</button>
              <button class="btn btn-primary btn-sm" onclick="self.history.back()" type="reset">Batal</button>
            </div>
          </div>
        </form>
      </div>
   </div>
</div>
<!-- modals -->
<!-- end Modals -->
@endsection
@section('scripts')
<script>
  var session = $('#session').val();
  var SITEURL = "{{URL::to('').'/'.config('app.root').'/'}}";

  function deleteRecordSaksi(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-saksi/' + id,
          success: function(data){
            console.log(data)
            var table = $('#saksitable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  function deleteRecordPihakPertama(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-pihak-pertama/' + id,
          success: function(data){
            console.log(data)
            var table = $('#pihakpertamatable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  function deleteRecordPersetujuanKeluarga(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-persetujuan-keluarga/' + id,
          success: function(data){
            console.log(data)
            var table = $('#persetujuankeluargatable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  function deleteRecordAhliWaris(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-ahli-waris/' + id,
          success: function(data){
            console.log(data)
            var table = $('#ahliwaristable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  function deleteRecordPenerimaKuasa(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-penerima-kuasa/' + id,
          success: function(data){
            console.log(data)
            var table = $('#penerimakuasatable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  function deleteRecordPenyanggah(id) {
      var result = confirm("Apakah anda yakin?");
      if(result == true){
        $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      $.ajax({
          type: 'DELETE',
          url: SITEURL + 'temp-penyanggah/' + id,
          success: function(data){
            console.log(data)
            var table = $('#penyanggahtable').DataTable();
            table.ajax.reload(null, false);
          }
      });
    }
  }

  $(document).ready( function () {
    $('.select2').select2({
      theme: "classic",
      maximumSelectionLength: 1,
    });

    $('#tanggal_alas_hak').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tanggal_meninggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    /** saksi **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#saksitable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-saksi/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_saksi', name: 'nama_saksi' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordSaksi(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end saksi **/

    /** pihak pertama **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#pihakpertamatable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-pihak-pertama/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_pihak_pertama', name: 'nama_pihak_pertama' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordPihakPertama(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end pihak pertama **/


    /** persetujuan keluarga **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#persetujuankeluargatable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-persetujuan-keluarga/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_persetujuan_keluarga', name: 'nama_persetujuan_keluarga' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordPersetujuanKeluarga(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end persetujuan keluarga **/


    /** ahli waris **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#ahliwaristable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-ahli-waris/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_ahli_waris', name: 'nama_ahli_waris' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordAhliWaris(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end ahli waris **/

    /** penerima kuasa **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#penerimakuasatable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-penerima-kuasa/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_penerima_kuasa', name: 'nama_penerima_kuasa' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordPenerimaKuasa(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end penerima kuasa **/

    /** penyanggah **/
    $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var tableData = $('#penyanggahtable').DataTable({
      responsive: true,
      processing: false,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: SITEURL + "json/temp-penyanggah/" + session,
      },

      columns: [
            { data: 'id', name: 'id', 'visible': true },
            { data: 'nama_penyanggah', name: 'nama_penyanggah' },
            { data: 'nik', name: 'nik' },
            {   data: 'id',
                      name: 'action',
                      orderable: false,
                      searchable: false,
                      "render": function ( data, type, row, meta ) {
              return '<button type="button" class="btn btn-danger btn-sm" style="padding-top:1px !important; padding-bottom:1px !important;" id="'+ data +'" onclick="deleteRecordPenyanggah(this.id);"><i class="fa fa-trash-o"></i></button>'
                      }
                  },
      ],

      order: [[0, 'asc']]
    });
    /** end penyanggah **/
  });
</script>
@endsection
