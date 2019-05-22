<?php
class Application_Model_Hr extends Zend_Db_Table
{
	function init(){
        /* Initialize action controller here */
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }
    function allDep(){
        $result = $this->db->query("SELECT * FROM tbl_department")->fetchAll();
        // die(print_r($result));
        return $result;
    }
    function allJab(){
        $result = $this->db->query("SELECT * FROM tbl_jabatan,tbl_department WHERE tbl_department.kd_department = tbl_jabatan.kd_department ")->fetchAll();
        // die(print_r($result));
        return $result;
    }
    function cariDep($id=''){
    	$result = $this->db->query('SELECT * from tbl_department where kd_department LIKE "%'.$id.'%"')->fetchAll();
    	// die(print_r($result));
    	return $result;
    }
    function delDep($id=''){
    	$result = $this->db->query('DELETE FROM tbl_department WHERE kd_department = "'.$id.'" ');
    	// die(print_r($result));
    	return $result;
    }
    function updateDep($data=''){
        $result = $this->db->query("UPDATE tbl_department SET nama_department = '".$data['nama_department']."' WHERE kd_department = '".$data['kd_department']."' ");
        // die(print_r($result));
        return $result;
    }
    function insertDep($data=''){
        $result = $this->db->query('INSERT INTO tbl_department (kd_department, nama_department )
        VALUES ("'.$data['kd_department'].'","'.$data['nama_department'].'")');
        // die(print_r($result));
        return $result;
    }
    function insertJab($data=''){
        $result = $this->db->query('INSERT INTO tbl_jabatan ( kd_jabatan, kd_department, nama_jabatan )
        VALUES ("'.$data['kd_jabatan'].'","'.$data['kd_department'].'","'.$data['nama_jabatan'].'")');
        // die(print_r($result));
        return $result;
    }
    function updateJab($data=''){
        $result = $this->db->query("UPDATE tbl_jabatan SET nama_jabatan = '".$data['nama_jabatan']."' , kd_department = '".$data['kd_department']."' WHERE kd_jabatan = '".$data['kd_jabatan']."' ");
        // die(print_r($result));
        return $result;
    }
    function cariJab($id=''){
        $result = $this->db->query('SELECT * FROM tbl_jabatan LEFT JOIN tbl_department on tbl_jabatan.kd_department = tbl_department.kd_department WHERE tbl_jabatan.kd_jabatan LIKE "%'.$id.'%" ')->fetchAll();
        // die(print_r($result));
        return $result;
    }
    function delJab($id=''){
        $result = $this->db->query('DELETE FROM tbl_jabatan WHERE kd_jabatan = "'.$id.'" ');
        // die(print_r($result));
        return $result;
    }
}

