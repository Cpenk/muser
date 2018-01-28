<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     function rp($angka){
           $jadi="Rp. ".number_format($angka,2,',','.')."-";
            return $jadi;
     }

     function angka($angka){
           $jadi=number_format($angka,0,',','.');
            return $jadi;
     }

/* End of file exportexcel_helper.php */
/* Location: ./application/helpers/exportexcel_helper.php */
