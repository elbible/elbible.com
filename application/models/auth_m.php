<?php if (!defined('BASEPATH')) exit('No direct scprit access allowed');

/* auth model */

class Auth_m extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  // check id and password
  function login($auth)
  {
   $sql = "select user_id, email from users WHERE user_id='".$auth['user_id']."' AND password='".$auth['password']."'";
   $query = $this->db->query($sql);
   if ($query->num_rows() >0)
   {
   	return $query->row();
   }
   else
   {
     return FALSE;
   }
  }
 }
