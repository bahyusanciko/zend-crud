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

}

