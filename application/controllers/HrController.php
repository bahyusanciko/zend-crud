<?php

class HrController extends Zend_Controller_Action{
    public function init(){
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $this->model = new Application_Model_Hr();
    }

    public function indexAction(){
       $this->redirect('menu');
    }
    public function depAction(){
    	$data = $this->model->allDep();
        $itemArray['dep'] = array_values($data);
        echo json_encode($itemArray,JSON_PRETTY_PRINT);
    	// echo "string";
        die();
    }
    public function jabAction(){
    	$data = $this->model->allJab();
        $itemArray['jab'] = array_values($data);
        echo json_encode($itemArray,JSON_PRETTY_PRINT);
    	// echo "string";
        die();
    }
    public function insertdepAction(){
    	// print_r($_POST);
    	$data = array(
    		'kd_department'	  => '',
            'nama_department' => $_POST['nama'],
             );
        $sqlcek = $this->model->insertDep($data);
        if ($sqlcek) {
            $data = "Success";
            echo json_encode($data);
            die();
        }else{
        $data = "Failed";
        echo json_encode($data);
        die();
        }
    	die();
    }
    public function searchdepAction(){
    	// die(print_r($_GET));
        $id = $_GET['name'];
        if ($_GET['action'] === 'Kode') {
            $sqlcek = $this->model->cariDep($id);
        }elseif ($_GET['action'] === 'Department') {
            $sqlcek = $this->db->query('select * from tbl_department where nama_department like "'.$id.'%"')->fetchAll();
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
        if ($sqlcek) {
            $itemArray['dep'] = array_values($sqlcek);
            echo json_encode($itemArray,JSON_PRETTY_PRINT);
            die();
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
    }
    public function updatedepAction(){
        header('Content-Type: text/plain');
        $test = $_POST['data']; // Don't forget the encoding
        $decoded = json_decode($test, true);
        // die(print_r($decoded));
        $data = array(
            'kd_department' => $decoded['kd_department'],
            'nama_department' => $decoded['nama_department'],
             );
        $sqlcek = $this->model->updateDep($data);
        if ($sqlcek) {
            $data = "Success";
            echo json_encode($data);
            die();
        }else{
        $data = "Failed";
        echo json_encode($data);
        die();
        }
    }
	public function insertjabAction(){
    	$data = array(
    		'kd_jabatan'	  => '',
            'kd_department' => $_POST['devisi'],
            'nama_jabatan' => $_POST['jabatan']
             );
        $sqlcek = $this->model->insertJab($data);
        if ($sqlcek) {
            $data = "Success";
            echo json_encode($data);
            die();
        }else{
        $data = "Failed";
        echo json_encode($data);
        die();
        }
    	die();
    }
    public function updatejabAction(){
        header('Content-Type: text/plain');
        $test = $_POST['data']; // Don't forget the encoding
        $decoded = json_decode($test, true);
        $data = array(
            'kd_jabatan' => $decoded['kd_jabatan'],
            'kd_department' => $decoded['nama_department'],
            'nama_jabatan' => $decoded['nama_jabatan'],
             );
        // die(print_r($data));
        $sqlcek = $this->model->updateJab($data);
        if ($sqlcek) {
            $data = "Success";
            echo json_encode($data);
            die();
        }else{
        $data = "Failed";
        echo json_encode($data);
        die();
        }
    }
}

