<?php

class LoginController extends Zend_Controller_Action{
    const SESSION_NAMESPACE = 'userRegister';

    protected $session;

	public function init()
    {
        /* Initialize action controller here */
        $this->db = Zend_Db_Table::getDefaultAdapter();
        $this->model = new Application_Model_Admin();
        $this->session = new Zend_Session_Namespace(self::SESSION_NAMESPACE);
    }
    function getsecurity(){
        $username = $this->session->user['username_admin'];
        if ($username) {
            $this->redirect('login/admin');
        }else{
            $this->redirect('login');
        }
    }
    public function indexAction(){
       $this->view->title = "Login";
    //$this->view->ipaddres = $this->getUserIP();
    }
    public function cekloginAction(){
        $username = strtolower($_POST['username']);
        $ambil = $this->model->cekAdmin($username);
        $password = strtolower($_POST['password']);
        if (password_verify($password,$ambil['password_admin'])) {
                    $sess = array(
                        'kd_admin' => $ambil['kd_admin'],
                        'username_admin' => $ambil['username_admin'],
                        'password_admin' => $ambil['password_admin'],
                        'nama_admin'     => $ambil['nama_admin'],
                        'img_admin' => $ambil['img_admin'],
                        'email_admin'   => $ambil['email_admin'],
                        'level' => $ambil['level_admin']
                    );
                    //die(print_r($sess));
                    $this->session->user = $sess;
                    $data = "Success";
                    echo json_encode($data);
                    die();
        }else{
            $data = "Failed";
            echo json_encode($data);
            die();
        }

    }
    function logoutAction() {
        session_destroy();
        $this -> redirect('login');
    }
    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
        
    }
}
