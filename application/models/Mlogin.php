<?php if(!defined('BASEPATH')) exit('No direct script access allowed ');

class Mlogin extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
	
	public function auth($user,$pass){
		$this->db->select('username');
        $this->db->from('user');
        $this->db->where("(email = '$user' OR username = '$user')");
        $this->db->where('pass', $pass);
        $q = $this->db->get();
		$hasil = $q->num_rows();
		if ($hasil > 0){
		$this->updateuserlog($user);
		return true;
		}else {
		return false;
		}
	}
	

	public function checkexist($user){
		$this->db->select('username');
        $this->db->from('user');
        $this->db->where("(email = '$user' OR username = '$user')");
        $q = $this->db->get()->num_rows();
        $r = ($q>0) ? true : false;
        return $r;
	}

	public function checkallow($user){
		$this->db->select('username');
        $this->db->from('user');
        $this->db->where("(email = '$user' OR username = '$user')");
        $this->db->where('user_active', 1);
        $q = $this->db->get()->num_rows();
        $r = ($q>0) ? true : false;
        return $r;
	}

	public function checkvalid($user){
		$this->db->select('username');
        $this->db->from('user');
        $this->db->where("(email = '$user' OR username = '$user')");
        $this->db->where('user_valid', 1);
        $q = $this->db->get()->num_rows();
        $r = ($q>0) ? true : false;
        return $r;
	}

	public function updateuserlog($user = null){
		$duser = array (
				'lastlogin'=>Date('Y-m-d H:i:s'),
				//'ulastip'=>$_SERVER['REMOTE_ADDR']
				);
		$this->db->where('username',$user);
		$this->db->update('user',$duser);
	}
	
	public function fetchuserdata($user,$pass){
		$this->db->select('idrole,username,namauser,foto,email');
		$this->db->from('user');
		$this->db->where("(email = '$user' OR username = '$user')");
		$this->db->where('pass', $pass);
		$d = $this->db->get()->result();
		foreach ($d as $qr){
		if ($qr->foto<>null){
			$foto=$qr->foto;
			}
			else{
			$foto='avatar.png';
			}
		$sesi = array(
				'user'=>$qr->username,
				'name'=>$qr->namauser,
				'role'=>$qr->idrole,
				'photo'=>$foto,
				'email'=>$qr->email,
				'logged'=>true
				);
		}
		return $sesi;
	}
	
	public function addlogstat($flogstat = null){
		//$this->db->insert('logstatus',$flogstat);
	}
	
	public function getlatestol($col=null){
		if (''==$col){
		$this->db->select('username,namauser,ulastip,rolename,lastlogin');}
		else {
		$this->db->select($col);
		}
		$this->db->where('lastlogin<>',null);
		($this->session->userdata('role')=='2') ? $this->db->where('user.idrole','3') : null ;
		$this->db->join('role','role.idrole=user.idrole','left');
		$this->db->limit(5,0); //5 latest
		$this->db->order_by('lastlogin','desc');
		return $this->db->get('user')->result_array();	
	}
	
	public function datalogin($column = null, $per_page = null, $page = null, $filter = null){
		$this->db->select($column);
			if($this->session->userdata('role')==1){
				$this->db->where('username<>',$this->session->userdata('user'));
			}else if($this->session->userdata('role')==2){
				$this->db->where('user.idrole','3');
			}else{
				$this->db->where('username','');
			}
		if ($filter != null){
			foreach($filter as $f=>$v){
				if (($f=='period')){
				$this->db->like('DATE_FORMAT(ucreated,"%Y")',$v);
				} else if(($f=='user_active') and ($v!='')){
					$this->db->like($f,$v);			
				}else{
					$this->db->like($f,$v);			
				}
			}
			}
		
		$this->db->join('role','role.idrole=user.idrole','left');
		$this->db->limit($per_page,(($page-1)*($per_page)));
		$this->db->order_by('user.ucreated','desc');
		$q = $this->db->get('user');
		$qr = $q->result_array();	
		return $qr;
	}
	
	public function countlogin($filter = null){
		if($this->session->userdata('role')==1){
				$this->db->where('username<>',$this->session->userdata('user'));
			}else if($this->session->userdata('role')==2){
				$this->db->where('user.idrole','3');
			} else{
				$this->db->where('username','');
			}
		if ($filter != null){
			foreach($filter as $f=>$v){
				if (($f=='period')){
				$this->db->like('DATE_FORMAT(ucreated,"%Y")',$v);
				} else if(($f=='user_active') and ($v!='')){
					$this->db->like($f,$v);			
				}else{
					$this->db->like($f,$v);			
				}
			}
		}
		
		$this->db->join('role','role.idrole=user.idrole','left');
		$this->db->order_by('user.ucreated','desc');
		return $this->db->count_all_results("user");

	}
	
	public function importdata($dtxl){
		//var store result
		$tot = 0;
		$faileduser = '';
		foreach ($dtxl as $key=>$val) {
            $val['ucreated'] = DATE('Y-m-d H:i:s');
            //check duplication row (username)
			$cuser = $this->checkuser($val['username']);           
			$cmail = $this->checkmail($val['email']);                      
            if (($cuser==0) and ($cmail==0)) {
                $this->db->insert('user', $val);
				$tot ++;
            } else {
				$faileduser[]=($key+1).'. '.$val['username'].' - '.$val['email'];
			}
		}
		return array('success'=>$tot,'failed'=>(count($dtxl)-$tot),'faillist'=>implode("<br/> ",$faileduser));
	}
	
	public function exportlogin($dtstart = null,$dtend = null, $dcolumn = null){
		$this->db->select($dcolumn);
		if($this->session->userdata('role')==1){
				
			}else if($this->session->userdata('role')==2){
				$this->db->where('user.idrole','3');
			} else{
				$this->db->where('username','');
			}
			if (($dtstart <> null) and ($dtend)<>null){
			$this->db->where('DATE_FORMAT(ucreated,"%Y-%m-%d") >=',$dtstart);
			$this->db->where('DATE_FORMAT(ucreated,"%Y-%m-%d") <=',$dtend);
			}
		$this->db->join('role','user.idrole=role.idrole','left');
		$this->db->order_by('ucreated','asc');
		return $this->db->get('user')->result_array();
	}

	public function deleteacc($id){
		$this->db->query('SET foreign_key_checks = 0');
		$this->db->where('username',$id);
		$r = $this->db->delete('user');
		$this->db->query('SET foreign_key_checks = 1');
		return $r;
	}
	
	public function detailacc($col,$id){
	$this->db->select($col);
	$this->db->join('role','user.idrole=role.idrole','left');
	$this->db->join('fac','user.idfac=fac.idfac','left');
	$this->db->where('username',$id);
	return $this->db->get('user')->result_array();
	}
	
	public function getdetailbyemail($col,$id){
	$this->db->select($col);
	$this->db->join('level','user.idlevel=level.idlevel','left');
	$this->db->join('fac','user.idfac=fac.idfac','left');
	$this->db->where('email',$id);
	return $this->db->get('user')->row();
	}
	
	public function detaillogin($col,$id){
	$this->db->select($col);
	$this->db->join('jk','jk.idjk=user.idjk','left');
	$this->db->join('fac','user.idfac=fac.idfac','left');
	$this->db->where('username',$id);
	return $this->db->get('user')->result_array();
	}

	public function getdetailbyphone($col,$id){
	$this->db->select($col);
	$this->db->join('level','user.idlevel=level.idlevel','left');
	$this->db->join('fac','user.idfac=fac.idfac','left');
	$this->db->where('uhp',$id);
	return $this->db->get('user')->row();
	}
	
	public function getdetailbyrstcode($col,$code){
	$this->db->select($col);
	$this->db->join('level','user.idlevel=level.idlevel','left');
	$this->db->join('fac','user.idfac=fac.idfac','left');
	$this->db->where('urstcode',$code);
	return $this->db->get('user')->result_array();
	}

	public function updateacc($data=null,$id){
		$this->db->where('username',$id);
		return $this->db->update('user',$data);
	}
	
	public function updateselected($dt,$val){
		$v=0;$x=0;
		foreach($dt as $t){
		$this->db->where('username',$t);
		$r = $this->db->update('user',array('user_active'=>$val));
			if ($r){$v++;} else{$x++;}
		}
		$hsl=array(
			"v"=>$v,
			"x"=>$x
			);
		return $hsl;
	}
	
	public function addacc($data){
		return $this->db->insert('user',$data);
	}
	
	public function getrole(){
	$this->db->select('idrole,rolename');
	$q = $this->db->get('role');
	$return = array();
	$return[''] = 'Please select';
		if($q->num_rows() > 0){
        foreach($q->result_array() as $row){
            $return[$row['idrole']] = $row['rolename'];
			}
		}
	return $return;
	}
	
	public function getallrole(){
	$this->db->select('idrole,rolename');
	return $this->db->get('role')->result_array();
	}
	
	public function checkmail($mail){
		$this->db->select('email');
		$this->db->where('email',$mail);
		$rt = $this->db->get('user')->num_rows();
		if ($rt>0){
		return 1;
		} else{
		return 0;
		}
	}
	
	public function checkuser($us){
		$this->db->select('username');
		$this->db->where('username',$us);
		$rt = $this->db->get('user')->num_rows();
		if ($rt>0){
		return 1;
		} else{
		return 0;
		}
	}

	public function checkhp($us){
		$this->db->select('username');
		$this->db->where('uhp',$us);
		$rt = $this->db->get('user')->num_rows();
		if ($rt>0){
		return 1;
		} else{
		return 0;
		}
	}

	public function getuserstatus($user){
		$this->db->select('ustatus');
		$this->db->where('username',$user);
		return $this->db->get('user')->row()->ustatus;
	}

	public function updatereset($data=null,$email){
		$this->db->where('email',$email);
		return $this->db->update('user',$data);
	}

	public function getallorg(){
		$this->db->select('username');
		$this->db->where('idrole','2');
		$this->db->where('user_active','1');
		return $this->db->get('user')->result_array();
	}

	public function getuserformvalidcode($code){
		$this->db->select('username');
		$this->db->where('uvalidcode',$code);
		return $this->db->get('user')->result();
	}
}