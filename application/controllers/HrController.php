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
        // die();
    	$data = array(
    		'kd_department'	  => '',
            'nama_department' => $_POST['nama'],
            'desc_department' => $_POST['desc'],
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
            $sqlcek = $this->db->query('select * from tbl_department where nama_department like "%'.$id.'%"')->fetchAll();
        }elseif ($_GET['action'] === 'Description') {
            $sqlcek = $this->db->query('select * from tbl_department where desc_department like "%'.$id.'%"')->fetchAll();
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
        $post = $_POST['data']; // Don't forget the encoding
        $decoded = json_decode($post, true);
        // die(print_r($decoded));
        $data = array(
            'kd_department' => $decoded['kd_department'],
            'nama_department' => $decoded['nama_department'],
            'desc_department' => $decoded['desc_department']
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
    public function deletedepAction(){
        $depId = $_POST['name'];
        // die(print_r($_POST));
        $cek = $this->model->delDep($depId);
        if ($cek){
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
    public function searchjabAction(){
        // die(print_r($_GET));
        $action1 = $_GET['action1'];
        $action2 = $_GET['action2'];
        $search1 = $_GET['search1'];
        $search2 = $_GET['search2'];
        if ($action2 === 'nama_department') {
            $sqlcek = $this->db->query('SELECT * FROM tbl_jabatan LEFT JOIN tbl_department on tbl_jabatan.kd_department = tbl_department.kd_department WHERE tbl_jabatan.kd_jabatan LIKE "%'.$search1.'%" AND tbl_department.nama_department LIKE "%'.$search2.'%"')->fetchAll();
        }else{
             $sqlcek = $this->db->query('SELECT * FROM tbl_jabatan LEFT JOIN tbl_department on tbl_jabatan.kd_department = tbl_department.kd_department WHERE tbl_jabatan.kd_jabatan LIKE "%'.$search1.'%" AND tbl_jabatan.nama_jabatan LIKE "%'.$search2.'%"')->fetchAll();
        }
        if ($sqlcek) {
            $itemArray['jab'] = array_values($sqlcek);
            echo json_encode($itemArray,JSON_PRETTY_PRINT);
            die();
        }else{
            $error = 'kosong';
            echo json_encode($error,JSON_PRETTY_PRINT);
            die();
        }
    }
    public function deletejabAction(){
        $jabId = $_POST['name'];
        // die(print_r($_POST));
        $cek = $this->model->delJab($jabId);
        if ($cek){
        $data = "Success";
            echo json_encode($data);
            die();
        }else{
            $data = "Failed";
            echo json_encode($data);
            die();
        }      
    }
    public function exportexcelAction(){
        $data = $this->model->allJab();
        foreach ($data as $row ) {
            $productResult[] = array(
                'No' => $row['kd_jabatan'],
                'Jabatan' => $row['nama_jabatan'],
                'Department' => $row['nama_department'],
                'Description' => $row['desc_department']
                 );
        }
        $filename = "Report-".date('Y-m-d').".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $isPrintHeader = false;
        if (! empty($productResult)) {
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        }
        exit();
    }
}

