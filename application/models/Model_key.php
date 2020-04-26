<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Model_key extends CI_Model{
 
    function create($id,$key){
        $data = array('user_id' => $id,
        'key'=>$key,
        'level'=>1,//isi terserah ynag penting angka karena tipe data int
        'date_created'=>date('Ymd'));
        $query = $this->db->insert('keys', $data);
        return $query;
    }
    function verifyCreate($id,$key){
        $this->db->where('user_id', $id);
        $this->db->where('key', $key);
        $query = $this->db->get('keys');
        return $query;
    }
    function getByUser($user){
        $this->db->where('user_id', $user);
        $this->db->limit('1');
        $query = $this->db->get('keys');
        return $query;
    }
}