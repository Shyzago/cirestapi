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
        $this->email->from('verification@shyzago.salahjurusan.com', 'Shyzago');
        $this->email->to($to_email);
        $this->email->subject('Verification');
        $this->email->message("
		<center>
            <div class='container' style='border: 3px solid rgb(18, 0, 155); padding:16px;'>
                <h1 style='font-size: large; font-weight: 800; '> Salah Jurusan Email Confirmation</h1>
                <hr>
                <p style='line-height: 23px;'>Kami telah melakukan verifikasi pada emailmu dan akunmu siap untuk digunakan ya! 
                Jangan lupa untuk selalu pantau website Salah Jurusan untuk update informasi
                terkini seputar Teknologi, IT dan desain.</p>
                <br>
                <button class='button'> <a href='https://shyzago.salahjurusan.com/authentication' style='text-decoration: none;'>Dashboard</a></button>
                <hr>
                <h5>2022 | Salah Jurusan Official Website</h5>
        
            </div>
        </center>
        ");

        if($this->email->send()) {
            $this->set_response([
                'status' => TRUE,
                'code' => 200,
                'message' => "Success"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,
                'code' => 404,
                'message' => "Failed"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
