<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpegawai extends CI_Model {

	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }
    function get_data()
    {
        $this->db->select("id AS id_pgwai, nik AS nik_pgwai, nama AS nama_pgwai, telepon AS telepon_pgwai, alamat AS alamat_pgwai");
        $this->db->from("tb_pegawai");
        $this->db->order_by("nik", "ASC");
        $query = $this->db->get()->result();

        return $query;
    }
}