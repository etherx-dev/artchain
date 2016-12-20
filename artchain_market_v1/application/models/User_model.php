<?php
class User_model extends CI_Model {

	function __construct() { 
         parent::__construct(); 
      }
	  
	  function get_tag($q){
    $this->db->select('username');
    $this->db->like('username', $q);
    $query = $this->db->get('users');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['username'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
	public function sign_up($data)
	    {
	    if ($this->db->insert("users",$data)) // Kullanıcı tablosuna dataları ekle
		{
	    return true;
		}  
	  }
	  function login($username_email,$password) 
	  {        
	  	$this->db->select('
            users.Id,
            users.username,
            users.email,
            users.forename,
            users.surname,
            users.password')
          ->from('users')
          ->where("(users.email = '$username_email' OR users.username = '$username_email')")
          ->where('password', $password);
        $this->db->limit(1);         
        
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
        }
     }
	public function insert_paylasim($data)
	    {
	    if ($this->db->insert("paylasimlar",$data)) // Kullanıcı tablosuna dataları ekle
		{
	    return true;
		}  
	  }

	public function delete_paylasim($id)
	    {
	    if ($this->db->delete("paylasimlar","id=".$id)) // Kullanıcı tablosundan belirtilen "id" li datayı siler
		{
	    return true;
		}  
	  }

	public function delete_yorum($id)
	    {
	    if ($this->db->delete("yorumlar","id=".$id)) // Kullanıcı tablosundan belirtilen "id" li datayı siler
		{
	    return true;
		}  
	  }
	  
	public function update_paylasim($data,$id)  // İd si ve datası gönderilen verileri günceller
	{
		$this->db->where('id', $id);
		$this->db->update('paylasimlar' ,$data);
		return true;
	}  
	
	 public function update_paylasim_resim($data,$id)  // İd si ve datası gönderileb verileri günceller
	{
		$this->db->where('id', $id);
		$this->db->update('paylasimlar' ,$data);
		return true;
	}  
}