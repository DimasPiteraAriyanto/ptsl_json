@extends('auths.layouts.app')
@section('title', 'Pemohon - PTSL')
@section('content')
<div class="x_panel">
  <div class="x_content">
    <div class="x_title">
      <h2>Data<small><i>Pemohon</i></small></h2>
      <div class="clearfix"></div>
    </div>
    <input type="hidden" name="pid" id="pid" value="{{$pid}}">
    <input type="hidden" name="nob" id="nob" value="{{$nob}}">
    <input type="hidden" name="doc" id="doc" value="{{$doc}}">
    <div class="col-md-12" style="margin-bottom: 10px;">
      <h4>{{$penlok->proyek->nama_proyek}}</h4>
      <span class="badge badge-info" style="padding: 8px; margin:1px;">Tahun: {{$penlok->proyek->tahun}}</span>
      <span class="badge badge-secondary" style="padding: 8px; margin:1px;">No. SK Penlok: {{$penlok->no_sk_penlok}}</span>
      <span class="badge badge-warning" style="padding: 8px; margin:1px;">Tanggal SK Penlok: {{$penlok->tanggal_sk_penlok->format('d F Y')}}</span>
      <span class="badge badge-success" style="padding: 8px; margin:1px;">Desa: {{$penlok->desa->nama_desa}}</span>
      <span class="badge badge-danger" style="padding: 8px; margin:1px;">No. Berkas: {{$nob}}</span>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form id="demo-form2" method="post" action="{{route('berkas').'/'.$pid.'/'.$nob.'/'.$doc}}" data-parsley-validate class="form-horizontal form-label-left">
        @csrf

          <input type="hidden" name="doc" value="{{$doc}}">
          <input type="hidden" name="penlok_id" value="{{$penlok->id}}">
          <input type="hidden" name="no_berkas" value="{{$nob}}">

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
              Pilih Jenis Alas Hak <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
              <select class="form-control select2" multiple="multiple" name="jenis_alas_hak_id">
                  @foreach($jenis_alas_hak as $jah)
                      <option value="{{$jah->id}}">{{$jah->nama_jenis_alas_hak}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
              <button type="submit" class="btn btn-success btn-sm">Proses</button>
              <button class="btn btn-primary btn-sm" onclick="self.history.back()" type="reset">Batal</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(function () {
    $('.select2').select2({
          theme: "classic",
          maximumSelectionLength: 1,
    })

    $('#tanggal_lahir').datetimepicker({
        format: 'YYYY-MM-DD'
    });
  })
</script>
@endsection
