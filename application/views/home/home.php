<!-- Content Header (Page header) -->
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
    <div class="box box-solid bg-main-content no-border">
      <div class="box-body">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 text-center">
            <div class="box box-solid box-primary">
              <div class="box-body">
              <h4><b>Cek Status Servis Anda</b></h4>
              <?php print(form_open(base_url('Home/searchidtx'),array('class'=>'form-inline','id'=>'searchtx')));?>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  <input type="text" name="idtx" class="form-control" placeholder="Masukkan ID transaksi servis">
                </div>
                <input type="button" name="" value="Search" class="btn btn-primary">
              <?=form_close();?>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center col-md-offset-2">
            <div class="box box-solid box-default">
              <div class="box-body">
              <h4><b><i>Ingin produk baru?</i></b></h4>
              <a href="<?=base_url('Katalog');?>" role="button" class="btn btn-default"><span class="fa fa-book fa-4x text-default"></span></a>
              <h3><u><i class="fa fa-info-circle text-info" role="button" data-toggle="popover" data-trigger="focus" data-content="Katalog berisi produk yang bisa Anda beli."></i></u> Katalog</h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 text-center ">
            <div class="box box-solid box-default">
              <div class="box-body">
              <h4><b><i>Ajukan servis?</i></b></h4>
              <a href="<?=base_url('Katalog');?>" role="button" class="btn btn-default"><span class="fa fa-wrench fa-4x text-default"></span></a>
              <h3> <u><i class="fa fa-info-circle text-info" role="button" data-toggle="popover" data-trigger="focus" data-content="Servis menyediakan layanan perbaikan dan penggantian komponen gadget Anda"></i></u> Servis</h3>
              </div>
            </div>
          </div>
        </div>
        <!-- product feeds -->
         <div class="row">
          <div class="col-md-12">
                <h3 class="text-center"><b>Produk Kami</b></h3>
                <div class="row">
                  <div  class="col-md-12">
                    <div id="productfeed">
                      <?php for($i=1;$i<10;$i++) {?>
                      <div style="padding: 10px">
                      <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-teal">
                          <h5 class="widget-user-username"><b>Iphone 6</b></h5>
                          
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?=base_url('upload/products/iphone6.png')?>" alt="Product name" max-height="50px">
                        </div>
                          <div class="box-footer">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="box box-solid text-center">
                                  <div class="box-body">
                                  <h5 class=""><i class="widget-user-desc">Rp. 5.000.000,-</i></h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <h5 class="description-header">12</h5>
                                  <span class="description-text"><i class="fa fa-eye"></i></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <h5 class="description-header">26</h5>
                                  <span class="description-text"><i class="fa fa-shopping-cart text-success"></i></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-4">
                                <div class="description-block">
                                  <h5 class="description-header">118</h5>
                                  <span class="description-text"><i class="fa fa-heart text-danger"></i></span>
                                </div>
                                <!-- /.description-block -->
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $('body').popover({
          selector: '[data-toggle=popover]',
          trigger: 'click focus'
        });
      });
      $('#productfeed').slick({
          centerMode: true,
          centerPadding: '8%',
          slidesToShow: 4,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '5%',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '5%',
                slidesToShow: 1
              }
            }
          ]
        });
    </script>
  </section>