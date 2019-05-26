<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }

    public function indexAction(){
        $this->redirect('login');
       $this->view->ipaddres = $this->getUserIP();
    }
    public function login(){
        # code...
    }
    public function adminAction(){
        $username = strtolower($_POST['username']);
        // die(print_r($username));
        $ambil = $this->db->query('select * from tbl_admin where username_admin = "'.$username.'"')->fetch();
                $password = strtolower($_POST['password']);
        if (password_verify($password,$ambil['password_admin'])) {
            // $this->db->where('username_admin',$username);
            // $query = $this->db->get('tbl_admin');
            //     foreach ($query->result() as $row) {
            //         $sess = array(
            //             'kd_admin' => $row->kd_admin,
            //             'username_admin' => $row->username_admin,
            //             'password_admin' => $row->password_admin,
            //             'nama_admin'     => $row->nama_admin,
            //             'img_admin' => $row->img_admin,
            //             'email_admin'   => $row->email_admin,
            //             'telpon_admin'   => $row->telpon_admin,
            //             'alamat_admin'  => $row->alamat_admin,
            //             'level' => $row->level_admin
            //         );
            //         // die(print_r($sess));
            //         $this->session->set_userdata($sess);
                    $data = $this->db->query("SELECT * FROM tbl_admin")->fetchAll();
                    // print_r($show);
                    $this->view->title = 'List Admin';
                    $this->view->admin = $data;
        }else{
            echo "salah";
            die();
        }

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

