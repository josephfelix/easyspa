<?php
class Promocao extends CI_Controller
{
	public function index()
	{
		header('Content-Type: application/pdf');
		print file_get_contents('upload/promocao.pdf');
	}
}
?>