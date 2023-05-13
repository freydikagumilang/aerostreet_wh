<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->helper('form');

if (!function_exists('bt_text'))
{
    function bt_text($id='',$label='',$placeholder='',$value='',$required=false, $classes='', $readonly=false, $extra='',$hide=false)
    {
        $rq = '';
        if ($required == true) {
            $rq = 'required';
        }
        $disabled = '';
        if ($readonly == true) {
        	$disabled = 'readonly style="tab-index: -1;"';
        }
		$display="";
		if($hide==true){
			$display="style='display:none'";
		}
        $return='<div class="form-group form-group-default '.$rq.'" '.$display.'>';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<input type="text" class="form-control '.$classes.'" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'" '.$rq.' '.$disabled.' '.$extra.'>';
        $return.='</div>';
		return $return;
    }

	function bt_number($id='', $label='', $placeholder='', $value='', $required = false, $classes = '', $readonly = false, $min = 0, $extra = '')
    {
        $rq = '';
        if ($required == true) {
            $rq = 'required';
        }
        $disabled = '';
        if ($readonly == true) {
        	$disabled = 'readonly style="pointer-events: none; tab-index: -1;"';
        }
        $return='<div class="form-group form-group-default '.$rq.'">';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<input type="number" min="'.$min.'" class="form-control '.$classes.'" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'" '.$rq.' '.$disabled.' '.$extra.'>';
        $return.='</div>';
		return $return;
    }
}

if (!function_exists('bt_text_ar'))
{
    function bt_text_ar($id='',$label='',$placeholder='',$value='',$required=false, $classes='', $readonly=false)
    {
        $rq = '';
        if ($required == true) {
            $rq = 'required';
        }
        $disabled = '';
        if ($readonly == true) {
        	$disabled = 'readonly style="pointer-events: none; tab-index: -1;"';
        }
        $return='<div class="form-group form-group-default '.$rq.'">';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<input type="text" class="form-control text-left '.$classes.'" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'" '.$rq.' '.$disabled.'>';
        $return.='</div>';
		return $return;
    }
}

if (!function_exists('bt_password'))
{
    function bt_password($id='',$label='',$placeholder='',$value='',$required=false)
    {
        $rq = '';
        if ($required == true) {
            $rq = 'required';
        }
        $return='<div class="form-group form-group-default '.$rq.'">';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<input type="password" class="form-control" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'" '.$rq.'>';
        $return.='</div>';
		return $return;
    }
}

if (!function_exists('bt_file'))
{
    function bt_file($id='',$label='',$placeholder='',$value='')
    {
        $return='<div class="form-group">';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<input type="file" class="form-control" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'" >';
        $return.='</div>';
		return $return;
    }
}

if (!function_exists('bt_select'))
{
	function bt_select($id='',$label='',$value=array(),$default='',$multiple="", $class="", $required=false, $disabled = false)
	{
		$disabled = $disabled ? "disabled='disabled'" : null;
		$return='<div class="form-group form-group-default '.$class.'">';
		if ($required) $return.='<div class="pull-right text-danger" style="font-size: 20px;">*</div>';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.=form_dropdown($id,$value,$default,'class="form-control '.$class.'" id="'.$id.'" '.$multiple.' '.$disabled);
		$return.='</div>';
		return $return;
	}
}

if (!function_exists('bt_textarea'))
{
	function bt_textarea($id='',$label='',$value='',$height='50px', $class='')
	{
		$return='<div class="form-group form-group-default">';
		$return.='<label for="'.$id.'">'.$label.'</label>';
		$return.='<textarea name="'.$id.'" id="'.$id.'" class="form-control '.$class.'"  style="height:'.$height.';">'.$value.'</textarea>';
		$return.='</div>';
		return $return;
	}
}

if (!function_exists('bt_group_text'))
{
	function bt_group_text($id='',$label='',$value='',$icon='')
	{
		$return='<div class="form-group">';
		$return.='<div class="input-group">';
		$return.='<input type="text" name="'.$id.'" id="'.$id.'" class="form-control" placeholder="'.$label.'" value="'.$value.'">';
		$return.='<div class="input-group-addon"><i class="'.$icon.'"></i></div>';
		$return.='</div>';
		$return.='</div>';
		return $return;
	}
}

if (!function_exists('bt_group_select'))
{
	function bt_group_select($id='',$value=array(),$default='',$icon='')
	{
		$return='<div class="form-group">';
		$return.='<div class="input-group">';
		$return.=form_dropdown($id,$value,$default,'class="form-control" id="'.$id.'"');
		$return.='<div class="input-group-addon"><i class="'.$icon.'"></i></div>';
		$return.='</div>';
		$return.='</div>';
		return $return;
	}
}

if (!function_exists('bt_radio_group'))
{
	function bt_radio_group($name='',$options=array(),$title='',$values='',$inline=TRUE)
	{
		$return= '<span class="">'.$title.' : </span>';
		$return.='<div class="radio radio-primary">';
		foreach($options as $key=>$value)
		{
			$return.='<input type="radio" autocomplete="off" value="'.$key.'" name="'.$name.'"';
			if($key == $values)
				$return.=' checked="checked" ';
      $return.=' id="'.$name.$key.'">';
      $return.='<label for="'.$name.$key.'">'.$value.'</label>';
      if (!$inline)
        $return.='<br/>';
		}
		$return.='</div>';
        return $return;
	}
}
