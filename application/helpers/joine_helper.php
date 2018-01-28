<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function jadwal_kbm($hari, $rombel, $jam)
{
  	$ci = get_instance();
  	$ci->db->where('hari', $hari);
	$ci->db->where('rombel', $rombel);
  	$ci->db->where('jam_ke', $jam);
  	$ci->db->from('jadwal_kbm');
  	$cari = $ci->db->count_all_results();
  	if($cari < 1){
  		return '_';
  	}else{

		$ci->db->select('mp.kode as kode_mp, ptk.kode as kode_ptk');
		$ci->db->from('jadwal_kbm kbm');
		$ci->db->join('kelas kls', 'kbm.rombel = kls.id', 'left');
		$ci->db->join('mata_pelajaran mp', 'kbm.mp = mp.id', 'left');
		$ci->db->join('data_ptk ptk', 'kbm.ptk = ptk.id', 'jeft');
		$ci->db->where('kbm.hari', $hari);
		$ci->db->where('kbm.rombel', $rombel);
		$ci->db->where('kbm.jam_ke', $jam);
		$data = $ci->db->get()->row();
		return $data->kode_mp." | ".$data->kode_ptk;
	}
}