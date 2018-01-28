<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function stock($normalisasi, $kondisi, $units)
{
  	$ci = get_instance();
    $ci->db->select('sum(jumlah) as jumlah_satuan');
    $ci->db->select('COUNT(DISTINCT kode_masuk) as unit');
    $ci->db->from('stock_moves');
    $ci->db->where('cek', 1);
    $ci->db->where('normalisasi', $normalisasi);
    $ci->db->where('kondisi', $kondisi);
    $ci->db->group_by('normalisasi');
    $ci->db->group_by('kondisi');
    $cari = $ci->db->count_all_results();
    if($cari < 1){
        return 0;
    }else{
        $ci->db->select('sum(jumlah) as jumlah_satuan');
        $ci->db->select('COUNT(DISTINCT kode_masuk) as unit');
        $ci->db->from('stock_moves');
        $ci->db->where('cek', 1);
        $ci->db->where('normalisasi', $normalisasi);
        $ci->db->where('kondisi', $kondisi);
        $ci->db->group_by('normalisasi');
        $ci->db->group_by('kondisi');
        $rows = $ci->db->get()->row();
        // if($units == 4){
        //     return anchor_popup(site_url('stock_moves/index_qty/'.$normalisasi.'/'.$kondisi.'/2'), $rows->unit, array('class'=>'btn btn-primary btn-xs'));
        // }else{
            return anchor_popup(site_url('stock_moves/index_qty/'.$normalisasi.'/'.$kondisi.'/2'), $rows->jumlah_satuan, array('class'=>'btn btn-primary btn-xs'));
        // }
    }

}
// <?php echo anchor_popup(site_url('stock_moves/index_qty/'.$normalisasi.'/'.$kondisi), '-- Pilih -- ', array('class'=>'btn btn-primary btn-xs')); ?>
