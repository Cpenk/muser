<?php
function select($name, $table, $field, $pk, $selected, $ket)
{
    $ci = get_instance();
    #$cmb = "<select name='$name' class='form-control'>";
    $ci->db->where('link', $link)
    $data = $ci->db->get($table)->result();
    $cmb = $data['add'];
    return $cmb;  
}
