<?php

require APPPATH . 'libraries/REST_Controller.php';

class Simulasi extends REST_Controller{

    // constructor
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('aes');
        $this->load->library('blockchain');
    }

    public function testing_post(){
        $body      = file_get_contents("php://input");

        if ($body == "") {
            $response = array(
                'status'  => "01",
                'message' => "parameter tidak lengkap"
            );
        }
        else{
            $data_json = json_decode($body);
            if (!$data_json) {
                $response = array(
                    'status'  => "03",
                    'message' => "pola salah"
                );
            }
            else{
                $amount = $this->db->escape_like_str($data_json->amount);

                $testCoin     = $this->blockchain;
                $testCoin->push(new Block(1, strtotime("now"), $amount));
                $response = array(
                    'status'      => "00",
                    'message'     => "berhasil",
                    'result'      => $testCoin
                );
            }
        }
        $this->response($response);
    }



}

?>
