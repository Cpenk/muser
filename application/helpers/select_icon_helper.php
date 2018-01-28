<?php
function select_icon($name, $table, $field, $pk, $selected, $ket)
{
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control select2'>";
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".$d->$field." <i class='fa fa-check'></i></option>";
    }
    $cmb .="</select>";
    return $cmb;  
}
