<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpegawai extends CI_Model {

	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }
    function get_data()
    {
        $this->db->select("id AS id_pgw, nik AS nik_pgw, nama AS nama_pgw, telepon AS telepon_pgw, alamat AS alamat_pgw");
        $this->db->from("tb_pegawai");
        $this->db->order_by("nik", "ASC");
        $query = $this->db->get()->result();

        return $query;
    }

    // buat fungsi untuk save data
    function save_data($nik, $nama, $telepon, $alamat, $token)
    {
         // cek apakah nik ada atau tidak
         $this->db->select("nik");
         $this->db->from("tb_pegawai");
         $this->db->where("TO_BASE64(nik) = '$token'");
        //  $this->db->where("nik = '$nik'");
         // eksekusi query
         $query = $this->db->get()->result();
         // jika nik tidak ditemukan
         if(count($query) == 0)
         {
            // isi nilai untuk masing" filed
            $data = array(
                "nik" => $nik,
                "nama" => $nama,
                "telepon" => $telepon,
                "alamat" => $alamat,
            );

            // simmoan data
            $this->db->insert("tb_pegawai", $data);
            $hasil = 0;
            
         }
        //  jika nik ditemukan 
         else
         {
            $hasil = 1;

         }
         return $hasil;

    }

    // fungsi untuk update data
    function update_data($nik, $nama, $telepon, $alamat, $token)
    {
             // cek apakah nik ada atau tidak
             $this->db->select("nik");
             $this->db->from("tb_pegawai");
             $this->db->where("TO_BASE64(nik) != '$token' AND nik = '$nik'");
            //  $this->db->where("nik = '$nik'");
             // eksekusi query
             $query = $this->db->get()->result();
             // jika nik tidak ditemukan
             if(count($query) == 0)
             {
                 // isi nilai untuk masing" filed
            $data = array(
                "nik" => $nik,
                "nama" => $nama,
                "telepon" => $telepon,
                "alamat" => $alamat,
            );

            // hapus data pegawai
            $this->db->where("TO_BASE64(nik) = '$token'");
            $this->db->update("tb_pegawai", $data);
            // kirim nilai hasil = 0
            $hasil = 0;



             }
            //  jika nik di temukan
            else
            {
                $hasil =1;

            }
            return $hasil;
    }

        // buat fungsi untuk delete data
        function delete_data($token)
        {
            // cek apakah nik ada atau tidak
            $this->db->select("nik");
            $this->db->from("tb_pegawai");
            $this->db->where("TO_BASE64(nik) = '$token'");
            // eksekusi query
            $query = $this->db->get()->result();
            // jika nik ditemukan
            if(count($query) ==1)
            {
                // hapus data pegawai
                $this->db->where("TO_BASE64(nik) = '$token'");
                $this->db->delete("tb_pegawai");
                // kirim nilai hasil = 1
                $hasil = 1;
            }
            // jika nik tidak di temukan
            else
            {
                // kirim nilai hasil =0
                $hasil = 0;
            }
            // kirim variabel hasil ke "controler" Pegawai
            return $hasil;
        }
}