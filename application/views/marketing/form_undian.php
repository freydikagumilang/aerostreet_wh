<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Katalog</title>
    <style>
        .modal {
            position: absolute;
            top: 10px;
        }
        /* Important part */
        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<div class="col-md-12">
	<h1><?= $menu ?></h1>
    <div class="col-md-12">
        <div class="row">
            <div class='col-md-4'>
                <label for="channel">Sumber Data Penjualan</label>
                <select name="channel" id="channel" class="form-control">
                    <option value="0">Pilih Sumber Data Penjualan</option>
                    <?php foreach($channel as $dt){?>
                        <option value="<?= $dt->id; ?>"><?= $dt->nama;?></option>
                    <?php }?>
                </select>
            </div>
            <div class='col-md-4'>
                <label for="periode_sales">Periode Data Penjualan</label>
                <select name="periode_sales" id="periode_sales" class="form-control">
                    <option value="">Pilih Sumber Data Dahulu</option>
                </select>
            </div>
            <div class='col-md-4'>
                <label for="periode_scm">Periode Stock (SCM)</label>
                <select name="periode_scm" id="periode_scm" class="form-control">
                    <?php foreach($tgl_scm as $dt){?>
                        <option value="<?= $dt->periode ?>"><?= $dt->periode?> </option>
                    <?php }?>
                </select>
            </div>
            
        </div>     
        <div class="row">   
            <div class='col-md-3'>
                <label for="jenis_kategori">Jenis item</label>
                <select name="jenis_kategori" id="jenis_kategori" class="form-control">
                    <option value="0">Pilih jenis item</option>
                    <?php foreach(jenis_kategori() as $idx=>$dt){?>
                        <option value="<?= $idx; ?>"><?= $dt;?></option>
                    <?php }?>
                </select>
            </div>
            <div class='col-md-3'>
                <label for="katalog_tipe">Urutkan</label>
                <select name="katalog_tipe" id="katalog_tipe" class="form-control">
                    <?php foreach(katalog_tipe() as $idx=>$dt){?>
                        <option value="<?= $idx; ?>"><?= $dt;?></option>
                    <?php }?>
                </select>
            </div>
            <div class='col-md-3'>
                <label for="periode">Umur CPAS</label>
                <input type="text" name="set_nama" id="umur_cpas" class="form-control" value='15'>
            </div>
            <div class='col-md-3'>
                <label for="channel">Jumlah Data</label>
                <input type="text" class="form-control" id="jumlah_data">
            </div>
            <div class='col-md-6' style="padding-top:30px">
                <button id="preview" class="btn btn-success">Preview Katalog</button>
            </div>
            <div class='col-md-6' style="padding-top:30px">
                <button id="search" class="btn btn-info pull-right" >Tampilkan Item</button>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="result_html">
    </div>
    
    </br>
    <label id="copy_id"></label>
</div>


<script >
    $(document).ready(function(){
        katalog_tipe = <?php echo json_encode(katalog_tipe()) ?>;
        jenis_kategori = <?php echo json_encode(jenis_kategori()) ?>;
        katalog_tipe_color= <?php echo json_encode(katalog_tipe_color()) ?>;
        $("#channel").change(function(){
            channel_id=$(this).val();
            $.post("<?= base_url()."/marketing/katalog/get_sales_periode"; ?>/"+channel_id,function(res){
                $('#periode_sales').empty();
                $.each(res, function (i, item) {
                    $('#periode_sales').append($('<option>', { 
                        value: item.periode,
                        text : item.periode
                    }));
                });
                console.log(res);
            },"json")
        })
        $("#search").click(function(){
            array_item =[];
            if(localStorage.getItem('keep_item')!==null){
                itm = JSON.parse(localStorage.getItem('keep_item'));
                $.each(itm,function(idx,val){
                    array_item.push(val.id);
                })
            };
            console.log(array_item);
            
            data = {
                chanel_id:$("#channel").val(),
                set_nama:$("#set_nama").val(),
                umur_cpas:$("#umur_cpas").val(),
                periode_sales:$("#periode_sales").val(),
                periode_scm:$("#periode_scm").val(),
                channel:$("#channel").val(),
                katalog_tipe:$("#katalog_tipe").val(),
                jenis_kategori:$("#jenis_kategori").val(),
                jumlah_data:$("#jumlah_data").val(),
                array_item:array_item
                
            }
            // console.log(data);
            $.post("<?= base_url()."/marketing/katalog/search_produk"; ?>",data,function(res){
                $("#result_html").html(res);
            })
        })
        function generate_katalog(){
            array_item = [];
            if(localStorage.getItem('keep_item')!==null){
                console.log("masuk");
                array_item = JSON.parse(localStorage.getItem('keep_item'));
            }
            html="<div class='row'>";
            total_data=0;
            $.each(array_item,function(idx,val){
                total_data++;
                $("#modal_preview").modal("show");
                html+='<div class="col-md-3">';
                    html+='<div style="height: 30px;max-width:200px">';
                        html+='<label><strong style="color:'+ katalog_tipe_color[val.katalog_tipe] +'">'+katalog_tipe[val.katalog_tipe]+'</strong> </label>';
                        html+='<a class="text-danger pull-right"><i class="fa fa-trash delete-item" data-id='+idx+'></i></a></br>';
                    html+='</div>';                        
                    html+='<img src="'+val.img+'" style="width:200px !important" >';
                    html+='<div style="height: 100px">';
                        html+='<label>'+val.kd_produk+'</br>'+val.nama+'</label>';
                    html+='</div>';
                    html+='<label>Market Place :'+val.market_place+'</label></br>';
                    html+='<label>Durasi CPAS :'+val.durasi_cpas+'hari</label></br>';
                    html+='<label>Umur Stock :'+val.umur_stock +' hari</label></br>';
                    html+='<label>Jenis :'+ jenis_kategori[val.jenis_kategori]+'</label></br>';
                    html+='<label>Varian Tersedia :'+ (val.total_varian - val.varian_kosong)+'/'+val.total_varian+'</label></br>';
                    html+='<div class="row">';
                        html+='<div class="col-md-6">';
                            html+='<label  style="color:'+((val.katalog_tipe=="TP")?katalog_tipe_color["TP"]:"#000")+'"><i class="fa fa-eye"></i> '+val.kunjungan_produk+'</label>';
                        html+='</div>';
                        html+='<div class="col-md-6">';
                            html+='<label style="color:'+ ((val.katalog_tipe=="HP")?katalog_tipe_color["HP"]:"#000")+'"><i class="fa fa-shopping-cart" ></i> '+val.masuk_keranjang+'</label></br>';
                        html+='</div>';
                        html+='<div class="col-md-6">';
                            html+='<label style="color:'+((val.katalog_tipe=="BS")?katalog_tipe_color["BS"]:((val.katalog_tipe=="SL")?katalog_tipe_color["SL"]:"#000"))+'"><i class="fa fa-truck" ></i> '+val.siap_kirim+'</label>';
                        html+='</div>';
                        html+='<div class="col-md-6">';
                            html+='<label style="color:'+((val.katalog_tipe=="REG")?katalog_tipe_color["REG"]:"#000") +'"><i class="fa fa-cubes" ></i>'+val.stock+'</label>';
                        html+='</div>';
                    html+='</div>';
                html+='</div>';
            });
            html+="</div>";
            $("#preview_katalog").html(html);
            $("#total_data_katalog").html("- Total data : "+total_data);
        }
        $("#preview").click(function(){
            generate_katalog();
            // $("#modal_preview").modal("show");
            $("#test_modal").modal("show")

            
        })
        $("#clear_all_katalog").click(function(){
            localStorage.removeItem('keep_item');
            $.notify("Katalog berhasil di reset","success");
            $("#test_modal").modal("hide");
        });
        
        $(document).on("click",".keep_item",function(){
            // $(this).data("meta");
            // console.log($(this).data("item"));
            array_item = [];
            if(localStorage.getItem('keep_item')!==null){
                console.log("masuk");
                array_item = JSON.parse(localStorage.getItem('keep_item'));
            }
            
            array_item.push($(this).data("item"));
            localStorage.setItem("keep_item", JSON.stringify(array_item));
            $.notify("Berhasil Menambahkan ke Katalog","success");
        });
        $(document).on("click",".delete-item",function(){
            // $(this).data("meta");
            id_array= $(this).data("id");
            array_item = [];
            if(localStorage.getItem('keep_item')!==null){
                array_item = JSON.parse(localStorage.getItem('keep_item'));
                array_item.splice(id_array,1);
                localStorage.setItem("keep_item", JSON.stringify(array_item));
                $.notify("Berhasil Menghapus dari Katalog","error");
                generate_katalog();
            }
        });
        $("#getid").click(function(){
            array_item = [];
            if(localStorage.getItem('keep_item')!==null){
                array_item = JSON.parse(localStorage.getItem('keep_item'));
            }
            // daftar_kd=[];
            html = ""
            $.each(array_item,function(idx,val){
                // console.log(val.kd_produk);
                html += val.sku_internal+" - "+val.kd_produk+" - "+val.nama+"</br>";
            });
            $("#copy_id").html(html);
            
        })
        
        
    })
</script>
</body>
</html>



