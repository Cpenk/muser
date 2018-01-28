<?php
function select_2($name, $table, $field1, $field2, $pk1, $pk2, $selected, $ket)
{
    $ci = get_instance();
    $cmb = "<select name='$name' id='$name' class='form-control select2'>";
    // $ci->db->where($field1, $pk1);
    $data = $ci->db->get($table)->result();
    $cmb .="<option>".$ket."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk2."'";
        $cmb .= $selected==$d->$pk2?" selected='selected'":'';
        $cmb .=">".  $d->$field2."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
    // hutuf Besar = strtoupper()
}
