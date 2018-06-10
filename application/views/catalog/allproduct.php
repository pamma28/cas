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
        <!-- product feeds -->
         <div class="row">
          <div class="col-md-8 text-center col-md-offset-2">
            <div class="btn-group" role="group" aria-label="...">
              <button type="button" class="btn btn-default btn-catalog" data-idcat="1">Iphone</button>
              <button type="button" class="btn btn-default btn-catalog" data-idcat="2">Ipad</button>
              <button type="button" class="btn btn-default btn-catalog" data-idcat="3 ">Aksesoris</button>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="box box-solid bg-main-content" id="box-catalog">
          <div class="box-body box-body-catalog ">
          </div>
        </div>
      </div>
    
    <script type="text/javascript">
    $(document).ready(function(){
      getproducts('1');
      $(".box-body-catalog").tooltip({ 
        selector: '[data-toggle=tooltip]',
        container: 'body'
      });
    });

    $(".btn-catalog").click(function(){
      var idproduct = $(this).data('idcat');
      getproducts(idproduct);
    });

    function getproducts(idproduct){
      var jqxhr = $.get( "<?=base_url('Katalog/renderproduct/')?>"+idproduct, function() {
          $(".box-body-catalog").html('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');
        })
          .done(function(data) {
            $(".box-body-catalog").empty();
            $(".box-body-catalog").html(data);
          })
          .fail(function() {
            $(".box-body-catalog").html('<div class="text-danger"><span class="fa fa-triangle-exclamation"></span> Koneksi Eror</div>');
          })
          .always(function() {
            Pace.restart();
          });
    }
    </script>

  </section>