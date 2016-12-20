<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database(); // Sayfada database ye  eriþmemizi saðlar
		$this->load->library('session');
	}
	
	public function index()
	{
		//$data['title']="Anasayfa";

		//$query=$this->db->get("settings");
		//$data["veri"]=$query->result();

		//$query=$this->db->query("select * from paylasimlar order by id desc limit 5");
		//$data["veri"]=$query->result();


		/*if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['adsoy'] = $session_data['adsoy'];
			$data['kullaniciadi'] = $session_data['kullaniciadi'];
			$data['id'] = $session_data['id'];
			$data['email'] = $session_data['email'];
		}		
		*/

		$this->load->view('header');			
		
		$this->load->view('content_login');
		
		$this->load->view('footer');
	}
	
	public function login()
	{

		$this->load->view('header');		
		
		$this->load->view('content_login');
		
		$this->load->view('footer');
	}
	public function log_in()
	{ 
		$username_email=$this->input->post('username_email');
		$password=$this->input->post('password');
		
		$this->load->model('User_model');
		$result = $this->User_model->login($username_email,$password);
		
		if($result) {
             $sess_array = array();
             foreach($result as $row) {
                 $sess_array = array(
				 'id' => $row->Id,
				 'username' => $row->username,
				 'password' => $row->password,
				 'email' => $row->email,
				 'forename' => $row->forename,
				 'surname' => $row->surname
				 );
                 
                 $this->session->set_userdata('logged_in', $sess_array);
				 echo "<script language=\"javascript\">window.location=\"".base_url()."Home/profile/".$sess_array['username']."\";</script>";
                 }
          		return TRUE;
          } 
		  else 
		  {
              
			echo "<script language=\"javascript\">alert('Invalid details!');window.location=\"".base_url()."Home/login\";</script>";
            return FALSE;
          }
		
	}
	function logout() {
         $this->session->unset_userdata('logged_in');
         $this->session->sess_destroy();
         redirect('Home/index');
     }
	
	public function sign_up_type()
	{
		$this->load->view('header');			
		
		$this->load->view('content_sign_up_type');
		
		$this->load->view('footer');
	}
	
	public function sign_up_details($type)
	{		

		$this->load->view('header');			
		
		$data["type"]=$type;
		$this->load->view('content_sign_up_details',$data);
		
		$this->load->view('footer');
	}
	public function sign_up()
	{  
		$this->load->model('user_model'); 

		$data=array(		
		'type' => $this->input->post('type'),
		'forename' => $this->input->post('forename'),
		'surname' => $this->input->post('surname'),
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'password' => $this->input->post('password')
		);

		$s_uname="";
		$query=$this->db->query("select * from users where username='".$data["username"]."' limit 1");
		foreach($query->result() as $same_username){
			$s_uname=$same_username->username;
		}

		$s_email="";
		$query=$this->db->query("select * from users where email='".$data["email"]."' limit 1");
		foreach($query->result() as $same_email){
			$s_email=$same_email->email;
		}

		if($s_uname!=NULL)
		{
		
			echo "<script language=\"javascript\">alert('This username already exist!');window.location=\"".base_url()."Home/sign_up_type\";</script>";	
		}

		else if($s_email!=NULL)
		{
			echo "<script language=\"javascript\">alert('This email already exist!');window.location=\"".base_url()."Home/sign_up_type\";</script>";	
		}

		else{
			$this->user_model->sign_up($data); 
			echo "<script language=\"javascript\">alert('Registration is successfull..');window.location=\"".base_url()."Home/login\";</script>";	
		}		

	
	}
	
	public function profile($username)
	{		
		$data['user_name']="";
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['user_name'] = $session_data['username'];
			$data['forename'] = $session_data['forename'];
			$data['surname'] = $session_data['surname'];
		}	


		$this->load->view('header');

		$query=$this->db->query("select * from users where username='".$username."' limit 1");
		$data["veri"]=$query->result();		
		
		$this->load->view('content_profile',$data);
		
		$this->load->view('footer');
	}
	
	public function profile_edit($username)
	{		
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['user_name'] = $session_data['username'];
			$data['forename'] = $session_data['forename'];
			$data['surname'] = $session_data['surname'];
		}	

			if($data['user_name']==$username)
			{
				$this->load->view('header');

				$query=$this->db->query("select * from users where username='".$username."' limit 1");
				$data["veri"]=$query->result();		

				$this->load->view('content_profile_edit',$data);

				$this->load->view('footer');
			}
		else{
			echo "<script language=\"javascript\">alert('you dont have access permit for this!');window.location=\"".base_url()."\";</script>";
		}
		
	}
	public function search()
	{
		$search=$this->input->post('search');
		echo "<script language=\"javascript\">window.location=\"".base_url()."Home/profile/".$search."\";</script>";	
	}
	
	public function certificate()
	{		

		$this->load->view('header');			
		
		$this->load->view('content_certificate');
		
		$this->load->view('footer');
	}
	
	public function paylasim_ekle()
	{  
		$this->load->model('User_model'); // Kayýt iþleminin yapýlacaðý model
		// Kayýt formundandan bilgileri al
		// form nesnelerinden alýnan veriler tablo alanlarý ile eþleþtiriliyor
		$data=array(
		'type' => $this->input->post('type'),
		'forename' => $this->input->post('forename'),
		'surname' => $this->input->post('surname'),
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'password' => $this->input->post('password')
		);
		
		// Data dizisine yüklenen verileri models teki ilgili fonksiyona gönderme
		$this->Paylasim_model->insert_paylasim($data); // ekleme fonk. datalarý gönder
		
		redirect(base_url()."index.php/admin/paylasimlar");		
	
	}
	 public function paylasim_sil($id)
	{ 
		$this->load->model('Paylasim_model'); // Kayýt iþleminin yapýlacaðý model
		$this->Paylasim_model->delete_paylasim($id); // Parametre ile alýnan ID yi silme fonksiyonuna gönder
		redirect(base_url()."index.php/admin/paylasimlar");
	}
	 public function paylasim_duzenle($id)
	{
		$this->load->helper('form');
		
	if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['adsoy'] = $session_data['adsoy'];
			$data['kullaniciadi'] = $session_data['kullaniciadi'];
			$data['id'] = $session_data['id'];
			$data['email'] = $session_data['email'];
			
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar',$data);
		$query=$this->db->query("select * from paylasimlar where Id=".$id);
		$data["veri"]=$query->result();	
		$this->load->view('admin/content_paylasim_duzenle',$data);
		$this->load->view('admin/footer');
		}	
		else{
			redirect(base_url()."index.php/admin/giris");
		}
		
		
	}
	
	public function paylasim_guncelle($id) // Düzenleme formundan gelen verileri güncelleme
	{  
		$this->load->model('Paylasim_model'); // Kayýt iþleminin yapýlacaðý model
		
		
		// form nesnelerinden alýnan veriler tablo alanlarý ile eþleþtiriliyor
		$data=array(
		'baslik' => $this->input->post('baslik'),
		'title' => $this->input->post('title'),
		'keywords' => $this->input->post('keywords'),
		'description' => $this->input->post('description'),
		'name' => $this->input->post('name'),
		'icerik' => $this->input->post('icerik')
		);
		
		// Data dizisine yüklenen verileri models teki ilgili fonksiyona gönderme
		$this->Paylasim_model->update_paylasim($data,$id); //  fonksiypnua datalarý id ile  gönder
		
		redirect(base_url()."index.php/admin/paylasimlar");
	
	}



	public function example()
	{
		$this->load->view('example');	
	}

	function get_tags(){
    $this->load->model('User_model');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->User_model->get_tag($q);
    }
  }
	
}	

