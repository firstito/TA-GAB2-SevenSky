<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// panggil file "Server.php"
require APPPATH."libraries/Server.php";
// require APPPATH."libraries/Server.php";

class Pegawai extends Server {

	public function __construct()
	{
        parent::__construct();

        // panggil model "Mpelanggan"
		$this->load->model("Mpegawai", "pgw", TRUE);
	}

    // buat service "GET"
    function service_get()
    {
        // panggil method "get_data"
        $hasil = $this->pgw->get_data();
        // hasil respon
        $this->response(array("pegawai" => $hasil), 200);
    }

       // buat service "POST"
       function service_post()
       {
           // // panggil model "Mpegawai"
           // $this->load->model("Mpegawai","mdl",TRUE);
           // ambil parameter data yang akan di isi
           $data = array(
               "nik" =>$this->post("nik"), //array $data[0]
               "nama" =>$this->post("nama"), //array $data[1]
               "telepon" =>$this->post("telepon"), //array $data[2]
               "alamat" =>$this->post("alamat"), //array $data[3]
               "token" => base64_encode($this->post("nik")),
           );
           // panggil method "save data"
           $hasil = $this->pgw->save_data($data["nik"], $data["nama"], $data["telepon"], $data["alamat"], $data["token"]);
           // jika hasil = 0
           if($hasil == 0)
           {
               $this->response(array("status" =>"Data Pegawai Berhasil Disimpan"),200);
           }
           // jika hasil !=0
           else
           {
               $this->response(array("status" => "Data Pegawai Gagal Disimpan"),200);
           }
       }

        // buat service "PUT"
    function service_put()
    {
        // // panggil model "Mpegawai"
        // $this->load->model("Mpegawai","pgw",TRUE);
        // ambil parameter data yang akan di isi
        $data = array(
            "nik" =>$this->put("nik"), //array $data[0]
            "nama" =>$this->put("nama"), //array $data[1]
            "telepon" =>$this->put("telepon"), //array $data[2]
            "alamat" =>$this->put("alamat"), //array $data[3]
            "token" => base64_encode($this->put("token")),
        );
        // panggil method "save data"
        $hasil = $this->pgw->update_data($data["nik"], $data["nama"], $data["telepon"], $data["alamat"], $data["token"]);

        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" =>"Data Pegawai Berhasil Di Update"),200);
        }
        // jika hasil !=0
        else
        {
            $this->response(array("status" => "Data Pegawai Gagal Di Update"),200);
        }

    }

    // buat service "DELETE"
    function service_delete()
    {
        // // panggil model "Mpegawai"
        // $this->load->model("Mpegawai","pgw",TRUE);
        // ambil parameter token "nik"
        $token = $this->delete("nik");
        //    panggil fungsi "delete_data"
        $hasil = $this->pgw->delete_data(base64_encode($token));
        if($hasil == 1)
        {
            $this->response(array("status" => "Data Pegawai Berhasil Dihapus"),200);
        }
        // jika proses delete gagal
        else
        {

            $this->response(array("status" => "Data Pegawai Gagal Dihapus"),200);
        }
    }
}