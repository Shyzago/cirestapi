<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('MahasiswaModel', 'model');
    }

    public function index_get(){
        $data = $this->model->getMahasiswa();
        $data2 = $this->model->getMahasiswa();
        var_dump($data);
        $this->set_response([
            'status' => TRUE,
            'code' => 200

        ]);
    }

    public function sendmail_post(){
        $to_email = $this->post('email');
        $this->load->library('email');
        $this->email->from('sender@emce.salahjurusan.com', 'Mail SalahJurusan');
        $this->email->to($to_email);
        $this->email->subject('Email Confirmation');
        $this->email->message("<a href='https://shyzago.salahjurusan.com/authentication' style='text-decoration: none;'>Verify</a>");


        if($this->email->send()){
            $this->set_response([
                'status' => TRUE,
                'code' => 200,
                'message' => "Pesan telah terkirim ke Email anda, silahkan cek Inbox anda"
            ], REST_Controller::HTTP_OK);
        
        }else {
            $this->set_response([
                'status' => FALSE,
                'code' => 404,
                'message' => "Email Not Found"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
