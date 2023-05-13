
<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">

  <title><?php echo $title ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Simple line icons-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/select2.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
</head>

<body id="page-top">
    <div id="loader">Memuat...</div>
    <header class=" d-flex align-items-center" id="badan" >
        <div class="container px-4 px-lg-5" >
              <div class="row">
                <div class="col"></div>
                  
                    <div class="col-12" style="background-color: rgb(0,0,0); /* Fallback color */
                    color: white;
                    background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
                    padding:10px !important;
                    border-radius: 0.5em;" id="login_div">
                      <label for="user">User Name</label>
                        <input type="text" class="form-control" name="user" placeholder="User Name" id="user">
                      </br>
                      <button class="btn btn-warning btn-block" id="btn_login" >Masuk</button>
                    </div>
                    <div class="col-12" style="background-color: rgb(0,0,0); /* Fallback color */
                    color: white;
                    background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
                    padding:10px !important;
                    border-radius: 0.5em;" id="input_div">
                      
                      </br>
                      
                      <h1 class="mb-1" id="label_nama_user">Stock Opname oleh </h1>
                      
                      
                      <div id="loading">
                        Menyimpan Data...
                      </div>
                      <div >
                          <label for="rak">Rak</label>
                            <input type="text" class="form-control" name="rak" placeholder="Rak" id="rak">
                          </br>
                          <label for="order_no">Item</label>
                          <select name="item" id="item_id" style="width:100% !important;>
                            <option value="">-Pilih Item-</option>
                          </select>
                          </br>
                          </br>
                          <label id="nama_produk_lengkap"></label>
                          </br>
                          
                          <strong>Size</strong>
                          <input type="hidden" name="size" id="size">
                          <div id="pilihan_size" ></div>
                          </br>
                          <label for="stock">Stock</label>
                            <input type="number" class="form-control" name="stock" placeholder="Stock" id="stock">
                          </br>
                          <button type="submit" class="btn btn-warning btn-block" id="btn_simpan_1" >Preview</button>
                          
                      </div>
                    </div>
                    <label id="msg"></label>
              </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Stock Opname</h4>
              </div>
              <div class="modal-body">
                <label id="preview_rak">Nama Produk : </label></br>
                <label id="preview_prod">Nama Produk : </label></br>
                <label id="preview_size">Nama Produk : </label></br>
                <label id="preview_stock">Nama Produk : </label></br>
                <button type="submit" class="btn btn-warning btn-block" id="btn_simpan" >Simpan</button>
              </div>
            </div>

          </div>
        </div>
    </header>

  <!-- Bootstrap core JS-->
  <script src="<?php echo base_url();?>assets/js/jquery_min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?php echo base_url();?>assets/js/notify.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/select2.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
        document.getElementById('badan').style.visibility="hidden";
    } else if (state == 'complete') {
        setTimeout(function(){
          document.getElementById('loader');
          document.getElementById('loader').style.visibility="hidden";
          document.getElementById('badan').style.visibility="visible";
        },1000);
    }
  }
    $(document).ready(function(){
      $("#loader").hide();
      $("#badan").show();
      $("#loading").hide();
      // localStorage.setItem("products",products);
      // product = [{"id":1,"kode":"red fast car1"},{"id":2,"kode":"red fast car2"}];
      user = localStorage.getItem("user_name");
      if(user==null){
        $("#login_div").show();
        $("#input_div").hide();
      }else{
        $("#input_div").show();
        $("#login_div").hide();
        btn_log_out = "<a href='#' id='logout'><i class='fa-close'></i></a>"
        $("#label_nama_user").html("Stok Opname oleh "+localStorage.getItem("user_name")+" "+btn_log_out);
      }
      $("#btn_login").click(function(){
        if($("#user").val()==""){
          $.notify("User Name Belum diisi", "error");
          return false;
        }
        localStorage.setItem("user_name",$("#user").val());
        $("#label_nama_user").html("Stok Opname oleh "+localStorage.getItem("user_name"));
        $("#login_div").hide();
        $("#input_div").show();
      })
      
      function matcher(term, text, opt) {
        var $option = $(opt),
          $optgroup = $option.parent('optgroup'),
          label = $optgroup.attr('label');

        term = term.toUpperCase();
        text = text.toUpperCase();

        const terms = term.split(' ')

        return terms.every(term => {
          if (text.indexOf(term) > -1 ||
            (label !== undefined &&
              label.toUpperCase().indexOf(term) > -1)) {
            return true;
          }
        })
      }
      if(localStorage.getItem("products")==null){
        // console.log("download");
        download_sku();
      }else{
        build_search_sku();
      }
      function download_sku(){
        $.post("<?php echo site_url("register/formulir/get_sku")?>",[],function(response){
          // console.log(response)
          products = JSON.stringify(response);
          localStorage.setItem("products",products);
          build_search_sku();
        },"JSON");
      }
      function build_search_sku(){
          q = JSON.parse(localStorage.getItem("products"));
          var newOption = new Option( "Pilih Produk",0, false, false);
          $('#item_id').append(newOption);
          $.each(q,function(idx,val){
            var newOption = new Option( val.kode,idx, false, false);
            $('#item_id').append(newOption);
          });
            $("#item_id").select2({
              matcher: matcher
            });
          
          
      }

      
      
      $('#item_id').change(function(){
        products = JSON.parse(localStorage.getItem("products"));
        // console.log(products);
        product=products[$('#item_id').select2('val')];
        // console.log(product)
        sizes = (product.ukuran).split(",")
        $("#nama_produk_lengkap").html("Produk </br>"+product.kode);
        html="<table>";
        $.each(sizes,function(idx,val){
          if((idx+1)%4 ==0 || idx==0){
            html += (idx!=0)?"</tr>":"";
            html += "<tr>";
          }
          html += '<td style="height:90px !important;width:90px !important"><div class="form-check">';
          html += '<input class="form-check-input" type="radio" name="exampleRadios" id="size-'+val+'" value="'+val+'">';
          html += '<label class="form-check-label" for="exampleRadios1">';
          html += val+'</label></div></td>';
        })
        html += "</tr></table>";
        $("#pilihan_size").html(html);
        
      })
      $(document).on("click",".form-check-input",function(){
        $("#size").val($(this).val());
      })

      $("#btn_simpan_1").click(function(){
        if($('#rak').val()==""){
          $.notify("Rak Belum diisi", "error");
          return false;
        }
        if($('#item_id').select2('val')==""){
          $.notify("Item Belum dipilih", "error");
          return false;
        }
        if($('#size').val()==""){
          $.notify("Size Belum dipilih", "error");
          return false;
        }
        if($('#stock').val()=="" || $('#stock').val()=="0"){
          $.notify("Stock Belum diisi", "error");
          return false;
        }
        product=products[$('#item_id').select2('val')];

        $("#preview_rak").html("RAK : "+$('#rak').val())
        $("#preview_prod").html("PRODUK :"+product.kode)
        $("#preview_size").html("UKURAN :"+$('#size').val())
        $("#preview_stock").html("STOK :"+$('#stock').val())
        
        $("#myModal").modal("show");
      })

      $("#btn_simpan").click(function(){
        if($('#rak').val()==""){
          $.notify("Rak Belum diisi", "error");
          return false;
        }
        if($('#item_id').select2('val')==""){
          $.notify("Item Belum dipilih", "error");
          return false;
        }
        if($('#size').val()==""){
          $.notify("Size Belum dipilih", "error");
          return false;
        }
        if($('#stock').val()=="" || $('#stock').val()=="0"){
          $.notify("Stock Belum diisi", "error");
          return false;
        }
        product=products[$('#item_id').select2('val')];
        $("#preview_rak").html("RAK : "+$('#rak').val())
        $("#preview_prod").html("PRODUK :"+product.kode)
        $("#preview_size").html("UKURAN :"+$('#size').val())
        $("#preview_stock").html("STOK :"+$('#stock').val())
        text = "STOCK OPNAME </br>";
        text += "RAK : "+$('#rak').val()+"</br>";
        text += "PRODUK :"+product.kode+"</br>";
        text += "UKURAN :"+$('#size').val()+"</br>";
        text += "STOK :"+$('#stock').val()+"</br>";
        
        data={
          "user_name":localStorage.getItem("user_name"),
          "id_produk":product.id,
          "kd_produk":product.kd_produk,
          "size":$("#size").val(),
          "rak":$("#rak").val(),
          "stock":$("#stock").val(),
        }
        // $('#item_id').select2("val","");
        $("#size").val("");
        // $("#pilihan_size").html("");
        // $('#rak').val("");
        $("#stock").val("0");


        $("#preview_rak").html("")
        $("#preview_prod").html("")
        $("#preview_size").html("")
        $("#preview_stock").html("")
        $("#nama_produk_lengkap").html("");
        product=products[$('#item_id').select2('val')];

        $.post("<?php echo site_url("register/formulir/save_so")?>",data,function(response){
            // $.notify(response.msg, "success");
            $("#msg").html(response.msg+"</br>"+text);
          },"JSON");
          $("#myModal").modal("hide");
      })

    
    
    })
    
  </script>
</body>

</html>