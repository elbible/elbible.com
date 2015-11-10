<?php
class User_m extends CI_Model {
 
    function __construct()
    {        
        parent::__construct();
    }
 
    function gets()
    {
        return $this->db->query("SELECT * FROM user")->result();
    }
 
	function getByEmail($email)
	{
		$result = $this->db->get_where('user', array('email'=>$email))->row();
        var_dump($this->db->last_query());       
        return $result;

	}

    function get($option)
    {
        $result = $this->db->get_where('user', array('email'=>$option['email']))->row();
        var_dump($this->db->last_query());
        return $result;
    }
 
    function add($option)
    {
        $this->db->set('email', $option['email']);
        $this->db->set('password', $option['password']);
		$this->db->set('user_name', $option['user_name']);
        $this->db->set('reg_date', 'NOW()', false);
        $this->db->insert('user');
        $result = $this->db->insert_id();
        return $result;
    }
}
?>