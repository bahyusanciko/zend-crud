<?php

class AdminController extends Zend_Controller_Action{
    const SESSION_NAMESPACE = 'userRegister';

    protected $session;

	public function init(){
        /* Initialize action controller here */
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $this->model = new Application_Model_Admin();
        $this->session = new Zend_Session_Namespace(self::SESSION_NAMESPACE);
//        $this->getsecurity();
    }
    function getsecurity(){
        $username = $this->session->user['username_admin'];
        if ($username) {
            $this->redirect('admin');
        }else{
            $this->redirect('login');
        }
    }
    public function indexAction()
    {
//       $this->getsecurity();
        // die(print_r($this->session->user['username_admin'])); 
        $data = $this->model->allAdmin();
        $this->view->title = 'List Admin';
        foreach ($data as $row) {
            $itemArray[] = [
                $row['kd_admin'], 
                $row['nama_admin'],
                $row['email_admin'],
                $row['no_hp_admin']
            ];
        }
        $this->view->user =  $this->session->user['nama_admin'];
        $this->view->data =  json_encode($itemArray);
    }

    public function deleteAction(){
//        $this->getsecurity()
        $adminId = $this->_getparam('id' , 0);
        $cek = $this->model->deleteAdmin($adminId);
        if ($cek) {
            $this->redirect('admin');
            }else{
            $this->redirect('admin/view/id/'.$adminId);
            }      
    }
    public function viewAction(){
//        $this->getsecurity();
        $adminId = $this->_getparam('id' , 0);
        // print_r($adminId);
        $sqlcek = $this->model->viewAdmin($adminId);
        if ($sqlcek) {
             // die(print_r($sqlcek));
            $this->view->data = $sqlcek;
        }else{
            $this->redirect('login/admin');
        }
    }
    public function updatejsonAction(){
        header('Content-Type: text/plain');
        $test = $_POST['data']; // Don't forget the encoding
        $decoded = json_decode($test, true);
        $data = array(
            'kd_admin' => $decoded['kd_admin'],
            'nama_admin' => $decoded['nama_admin'],
            'email_admin' => $decoded['email_admin'],
            'no_hp_admin' => $decoded['no_hp_admin']
             );
        $sqlcek = $this->model->updateAdmin($data);
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
    public function updateAction(){
//        $this->getsecurity();
        $data = array(
            'kd_admin' => $_POST['kode'],
            'nama_admin' => $_POST['nama'],
            'email_admin' => $_POST['email'],
            'no_hp_admin' => $_POST['nomor']
             );
        $sqlcek = $this->model->updateAdmin($data);
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
    public function tambahAction(){
//        $this->getsecurity();
        $this->view->title = "Tambah Data";
    }
    public function insertAction(){
//        $this->getsecurity();
        $data = array(
            'kd_admin' => '',
            'username_admin' => strtolower($_POST['username']),
            'password_admin' => password_hash(strtolower($_POST['password']),PASSWORD_DEFAULT),
            'nama_admin' => $_POST['nama'],
            'email_admin' => $_POST['email'],
            'no_hp_admin' => $_POST['nomor'],
            'level_admin' => 1,
            'create_date_admin' => date('Y-m-d H:i:s'),
            'img_admin' => 'assets/dist/img/default.png'
             );
        $sqlcek = $this->model->insertAdmin($data);
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
    function cariAction() {
//        die(print_r($_POST));
        $kode = $this->_getparam('Kode' , 0);
        $nama = $this->_getparam('Nama' , 0);
        $email = $this->_getparam('Email' , 0);
        $nomor = $this->_getparam('Nomor' , 0);
        if ($kode) {
            $sqlcek = $this->model->cariAdmin($kode);
        }elseif ($nama) {
            $sqlcek = $this->db->query('select * from tbl_admin where nama_admin like "'.$nama.'%"')->fetchAll();
        }elseif ($email) {
            $sqlcek = $this->db->query('select * from tbl_admin where email_admin like "'.$email.'%"')->fetchAll();
        }elseif ($nomor) {
            $sqlcek = $this->db->query('select * from tbl_admin where no_hp_admin like "'.$nomor.'%"')->fetchAll();
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
        if ($sqlcek) {
            $this->view->title = 'List Admin';
            foreach ($sqlcek as $row) {
            $itemArray[] = [
                $row['kd_admin'], 
                
                $row['nama_admin'],
                $row['email_admin'],
                $row['no_hp_admin']
            ];
        }
        $this->view->user =  $this->session->user['nama_admin'];
        $this->view->data =  json_encode($itemArray); 
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
    }
    function searchAction() {
//        die(print_r($_GET['action']));
        $id = $_GET['name'];
        if ($_GET['action'] === 'Kode') {
            $sqlcek = $this->model->cariAdmin($id);
        }elseif ($_GET['action'] === 'Nama') {
            $sqlcek = $this->db->query('select * from tbl_admin where nama_admin like "'.$id.'%"')->fetchAll();
        }elseif ($_GET['action'] === 'Email') {
            $sqlcek = $this->db->query('select * from tbl_admin where email_admin like "'.$id.'%"')->fetchAll();
        }elseif ($_GET['action'] === 'Nomor') {
            $sqlcek = $this->db->query('select * from tbl_admin where no_hp_admin like "'.$id.'%"')->fetchAll();
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
        if ($sqlcek) {
            $this->view->title = 'List Admin';
            foreach ($sqlcek as $row) {
            $itemArray[] = [
                $row['kd_admin'], 
                
                $row['nama_admin'],
                $row['email_admin'],
                $row['no_hp_admin']
            ];
        }
         echo json_encode($itemArray);
         die();
        }else{
            $error = 'kosong';
            echo json_encode($error);
            die();
        }
    }
    function get_kod(){
    $q = $this->db->query("SELECT MAX(RIGHT(kd_admin,3)) AS kd_max FROM tbl_admin")->fetchAll();
    $kd = "";
    if(count($q)>0){
        foreach($q as $k){
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%03s", $tmp);
        }
    }else{
        $kd = "001";
    }
    return "A".$kd;
}

}

