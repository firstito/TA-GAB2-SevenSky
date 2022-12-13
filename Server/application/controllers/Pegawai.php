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
}