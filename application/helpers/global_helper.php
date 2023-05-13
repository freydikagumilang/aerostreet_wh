<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

if (!function_exists('clean_data_import_csv'))
{
	// return array('code','name','number','lower','space')
	function clean_data_import_csv($string='', $is_name=FALSE)
	{
		$temp = trim($string);
		$temp = preg_replace('/\s+/', ' ', $temp);

		//space
		$result['space'] = $temp;

		$temp = strtolower($temp);

		//lower
		$result['lower'] = $temp;

		//number
		$number = str_replace(',','',$temp);
		if (empty($number)) $number = 0;
		$result['number'] = $number;

		//name
		$name = '';
		if ($is_name) $name = strlen($temp) > 4 ? ucwords($temp) : strtoupper($temp);
		else $name = ucwords($temp);
		$result['name'] = str_replace('"',"`",(str_replace("'",'`',$name)));

		//code
		$code = strtoupper($temp);
		$result['code'] = str_replace(" ",'',str_replace("'",'',str_replace('"','',$code)));

		return $result;
	}
}
if (!function_exists('katalog_tipe'))
{
	// return array('code','name','number','lower','space')
	function katalog_tipe($kd="")
	{
		$tipe=array(
			"BS" => "Terlaris",
			"TP" => "Banyak Dikunjungi",
			"HP" => "Banyak Masuk Keranjang",
			"REG" => "Normal",
			"SLOW" => "Paling tidak laku",
		);
		if ($kd=="")
			return $tipe;
		else
			return $tipe[$kd];
	}
}

if (!function_exists('katalog_tipe_color'))
{
	// return array('code','name','number','lower','space')
	function katalog_tipe_color($kd="")
	{
		$katalog_tipe_color=array(
			"BS" => "#018F9C",
			"TP" => "#40826d",
			"HP" => "#5E72EB",
			"REG" => "#E69D45",
			"SLOW" => "#D45769",
		);
		if ($kd=="")
			return $katalog_tipe_color;
		else
			return $katalog_tipe_color[$kd];
	}
}

if (!function_exists('jenis_kategori'))
{
	function jenis_kategori($kd="")
	{
		$jenis_kategori=array(
			"0" => "-",
			"1" => "JAKET",
			"2"=>"CHINOS",
			"3"=>"HOODIE",
			"4"=>"T SHIRT",
			"5"=>"LONG SLEEVE",
			"6"=>"OVERSIZE",
			"7"=>"CEWEK",
			"8"=>"SANDAL",
			"9"=>"SEPATU",
			"10"=>"SEPATU EXTERNAL",
			"11"=>"KEMEJA",
		);
		if ($kd=="")
			return $jenis_kategori;
		else
			return $jenis_kategori[$kd];
	}
}
$CI =& get_instance();

if (!function_exists('my_datatables'))
{
	function my_datatables($id='',$url='',$page=0, $sort=false,$item_per_page=50,$afterload_function="",$scrollx=false)
	{
		$return='';
		$return.='var table = $("'.$id.'");';
		$return.='var settings = {';

		if(!$sort){
			$return.=my_datatables_config($id,$url,$page,$item_per_page,$afterload_function,$scrollx);
		} else {
			$return.=my_sortable_datatables_config($id,$url,$page,$item_per_page,$afterload_function);
		}

		$return.='};';
		$return.='table.dataTable(settings);';

		return $return;
	}
}

if (!function_exists('my_datatables_config'))
{
	function my_datatables_config($id='',$url='',$page=0,$item_per_page=50,$afterload_function="",$scrollx=false)
	{
		$basic_config = '
			"sDom": "<'."'table-responsive'".'t><'."'row'".'<p i>>",
		    "sPaginationType": "full_numbers",
			"responsive": true,
			"scrollX": '.(($scrollx===true)?'true':'false').',
		    "destroy": true,
		    "ordering": false,
		    "oLanguage": {
		        "sProcessing": "..Harap Tunggu..",
				"sLengthMenu": "_MENU_ ",
		        "sInfo": "Menampilkan <b>_START_ sampai _END_</b> dari _TOTAL_ data",
				"sInfoEmpty": "Tidak ada data untuk ditampilkan",
				"oPaginate": {
					"sFirst": "Awal",
					"sPrevious": "Sebelum",
					"sNext": "Sesudah",
					"sLast": "Akhir"
				}
		    },
			"processing" : true,
		    "iDisplayLength": '.$item_per_page.',
			"iDisplayStart": '.$page.',
		    "bprocessing": true,
			"serverSide": true,
			"initComplete": function( settings, json ) {
				console.log("loaded");
				'.((strpos($afterload_function,"(")===false)?(($afterload_function!='')?($afterload_function.'();'):''):$afterload_function).'
			},
		    "ajax": {
		    	url:"'.site_url($url).'",
		    	type:"post",
		    	error: function(jqXHR, textStatus, errorThrown) {
	              	$("'.$id.'").css("display","none");
				  	console.debug(textStatus, errorThrown);
				}
		    }';
		return $basic_config;
	}
}

if (!function_exists('my_sortable_datatables_config'))
{
	function my_sortable_datatables_config($id='',$url='',$page=0,$item_per_page=50,$afterload_function="")
	{
		$basic_config = '
			"sDom": "<'."'table-responsive'".'t><'."'row'".'<p i>>",
		    "sPaginationType": "full_numbers",
			"responsive": true,
		    "destroy": true,
		    "scrollCollapse": true,
		    "oLanguage": {
		        "sProcessing": "..Harap Tunggu..",
				"sLengthMenu": "_MENU_ ",
		        "sInfo": "Menampilkan <b>_START_ sampai _END_</b> dari _TOTAL_ data",
				"sInfoEmpty": "Tidak ada data untuk ditampilkan",
				"oPaginate": {
					"sFirst": "Awal",
					"sPrevious": "Sebelum",
					"sNext": "Sesudah",
					"sLast": "Akhir"
				}
		    },
			"processing" : true,
		    "iDisplayLength": '.$item_per_page.',
			"iDisplayStart": '.$page.',
		    "bprocessing": true,
			"serverSide": true,
			"initComplete": function( settings, json ) {
				console.log("loaded");
				'.(($afterload_function!='')?($afterload_function.'();'):'').'
			},
		    "ajax": {
		    	url:"'.site_url($url).'",
		    	type:"post",
		    	error: function(jqXHR, textStatus, errorThrown) {
	              	$("'.$id.'").css("display","none");
				  	console.debug(textStatus, errorThrown);
	            }
		    }';
		return $basic_config;
	}
}