<section class="content-header">
      <h1>
        <?=$title;?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <i class="fa fa-home"></i>
        <?=set_breadcrumb();?>
      </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-solid">
      <div class="box-body">
        <div class="box box-default">
        <form action="<?=base_url('Customer/Service/sendrequest');?>" method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="labelimages" class="col-sm-2 control-label">Gambar Barang/Paket</label>
              <div class="col-sm-10">
                <input class="btn btn-default" id="inputimages" placeholder="File" type="file">
              </div>
            </div>
            <div class="form-group">
              <label for="labelimages" class="col-sm-2 control-label">Detail kerusakan</label>
              <div class="col-sm-10">
                <?=$fdetail;?>
              </div>
            </div>
          </div>
          <div class="box-footer text-right">
          <input type="submit" value="Ajukan" class="btn btn-success" />
          </div>
        </form>
      </div>
    </div>
  </section>