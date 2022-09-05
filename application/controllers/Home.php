<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	//sesuaikan dengan link spreadsheet yang didapatkan sebelumnya
	private $feed = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vRbirmFafhI0mH3rw_GvXZOUBoiMXKQ2yVzJ02cKh8ijfpedZjlBPmCa328VK4bC0o6cz7Opj8WOG2J/pub?output=csv';

	// variabel ini akan digunakan untuk melooping data
	private $keys = array();
	private $newArray = array();

	//fungsi untuk mengkonversi csv ke array asosiatif
	public function csvToArray($file, $delimiter)
	{
		if (($handle = fopen($file, 'r')) !== FALSE) {
			$i = 0;
			while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
				for ($j = 0; $j < count($lineArray); $j++) {
					$arr[$i][$j] = $lineArray[$j];
				}
				$i++;
			}
			fclose($handle);
		}
		return $arr;
	}

	public function index()
	{
		// menjalankan fungsi dan memasukan data ke variabel $data 
		$data = $this->csvToArray($this->feed, ',');

		$count = count($data) - 1;

		//row pertama digunakan untuk nama/header
		$labels = array_shift($data);

		//membuat nama-nama key dari header
		foreach ($labels as $label) {
			$this->keys[] = $label;
		}

		//menggabungkan key dan value
		for ($j = 0; $j < $count; $j++) {
			$d = array_combine($this->keys, $data[$j]);
			$this->newArray[$j] = $d;
		}

		$data['newArray'] = $this->newArray;
		$this->load->view('try', $data);
	}
}
