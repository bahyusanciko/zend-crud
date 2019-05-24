<?php

class MenuController extends Zend_Controller_Action{
    const SESSION_NAMESPACE = 'userRegister';

    protected $session;
    public function init(){
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $this->model = new Application_Model_Hr();
        $this->session = new Zend_Session_Namespace(self::SESSION_NAMESPACE);
    }

    public function indexAction()
    {
        $this->view->user =  $this->session->user['nama_admin'];
    }
    public function departmentAction($value=''){
        
    }
    public function jabatanAction($value='')
    {
        
    }
    public function adminAction($value='')
    {
        # code...
    }
    public function reportAction($value=''){
        $data = $this->model->allJab();
        foreach ($data as $row ) {
            $itemArray[] = 
            array(
                 $row['kd_jabatan'],
                 $row['nama_department'],
                 $row['nama_jabatan'],
                 $row['desc_department']
                 );
        }
        $this->view->data = json_encode($itemArray);
    }
}

