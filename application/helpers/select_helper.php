<?php
function select($name, $table, $field, $pk, $selected, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $cmb = "<select name='$name' ".$disabled." id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  $d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}

function select_cart($name, $my_form, $table, $field, $pk, $selected, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $cmb = "<select form='$my_form' name='$name' ".$disabled." id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  $d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}

function multiple_select($name, $id, $table, $field, $pk, $selected, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $cmb = "<select name='$name' ".$disabled." id='$id' class='form-control select2' multiple='multiple' data-placeholder='$ket'>";
    $data = $ci->db->get($table)->result();
    // $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        // $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .= in_array($d->$pk, explode(',', $selected))?" selected='selected'":'';
        $cmb .=">".  $d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}

function select_where($name, $table, $field, $pk, $selected, $where, $value_where, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $ci->db->where($where, $value_where);
    $cmb = "<select name='$name' ".$disabled." id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".bln_thn($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}

function select_penduduk($name, $table, $field, $pk, $selected, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $ci->db->where('status_penduduk', 1);
    $ci->db->or_where('status_penduduk', 2);
    $ci->db->or_where('status_penduduk', 4);
    $ci->db->or_where('status_penduduk IS NULL');
    $cmb = "<select name='$name' ".$disabled." id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  $d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}

function select_status($name, $table, $field, $pk, $selected, $ket, $disabled = NULL)
{
    $ci = get_instance();
    $ci->db->where('id <', 3);
    $cmb = "<select name='$name' ".$disabled." id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  $d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}


