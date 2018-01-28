<?php
Class Access_model extends CI_Model
{
 function login($username, $password)
 {
   $this->db->select('*');
   $this->db->where('username', $username);
   $this->db->where('password', MD5($password));
   $this->db->where('status', 'Y');
   $this->db->limit(1);

   $query = $this->db->get('users');

   if($query->num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>