<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{
		$data['tampil'] = json_decode($this->client->simple_get(APIPEGAWAI));

		// foreach($data["tampil"]-> pegawai as $result) {
		// 	# code...
		// 	echo $result->nik_pgw."<br>";
		// }

		$this->load->view('vw_pegawai',$data);
	}

	function setDelete()
    {
        // buat variabel json
		$json  = file_get_contents("php://input");
		$hasil = json_decode($json);

		$delete = json_decode($this->client->simple_delete(APIPEGAWAI, array("nik" => $hasil->niknya)));


		// isi nilai err
		// $err = 1;

		// kiirm hasil ke "vw_mahasiswa"
		echo json_encode(array("statusnya" => $delete->status));
    }

	function addPegawai()
	{
		$this->load->view('en_pegawai');
	}

	// buat fungsi untuk simpan data pegawai
	function setSave()
	{
		// baca nilai dari fetch
		$data = array(
			"nik" => $this->input->post("niknya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponnya"),
			"alamat" => $this->input->post("alamatnya"),
			"token" => $this->input->post("niknya"),
		);
		$save = json_decode($this->client->simple_post(APIPEGAWAI, $data));

		// kiirm hasil ke "vw_mahasiswa"
		echo json_encode(array("statusnya" => $save->status));
		
	}
}
