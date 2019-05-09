<?php
class Application_Model_Admin extends Zend_Db_Table
{
	public function init()
    {
        /* Initialize action controller here */
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }
    public function allAdmin()
    {
        $result = $this->db->query("SELECT * FROM tbl_admin")->fetchAll();
        // die(print_r($result));
        return $result;
    }
    public function cekAdmin($id='')
    {
    	$result = $this->db->query('select * from tbl_admin where username_admin = "'.$id.'"')->fetch();
    	// die(print_r($result));
    	return $result;
    }
    public function viewAdmin($id='')
    {
        $result = $this->db->query('select * from tbl_admin where kd_admin = "'.$id.'"')->fetch();
        // die(print_r($result));
        return $result;
    }
    public function deleteAdmin($id=''){
    	$result = $this->db->query('DELETE FROM tbl_admin WHERE kd_admin = "'.$id.'" ');
    	// die(print_r($result));
    	return $result;
    }
    public function updateAdmin($id=''){
        $result = $this->db->query("UPDATE tbl_admin SET nama_admin = '".$id['nama_admin']."', email_admin = '".$id['email_admin']."', no_hp_admin = '".$id['no_hp_admin']."' WHERE kd_admin = '".$id['kd_admin']."' ");
        // die(print_r($result));
        return $result;
    }
    public function insertAdmin($id=''){
        $result = $this->db->query('INSERT INTO tbl_admin (kd_admin, username_admin, password_admin, nama_admin, email_admin, no_hp_admin,img_admin, level_admin, create_date_admin )
        VALUES ("'.$id['kd_admin'].'", "'.$id['username_admin'].'", "'.$id['password_admin'].'", "'.$id['nama_admin'].'","'.$id['email_admin'].'","'.$id['no_hp_admin'].'","'.$id['img_admin'].'","'.$id['level_admin'].'","'.$id['create_date_admin'].'")');
        // die(print_r($result));
        return $result;
    }
    function cariAdmin($id) {
        $result = $this->db->query('select * from tbl_admin where kd_admin like "'.$id.'%"')->fetchAll();
    	// die(print_r($result));
    	return $result;
    }
}

