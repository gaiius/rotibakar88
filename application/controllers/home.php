<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct(){
        parent::__construct();
        $this->load->model('model_app');

        if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Silahkan login terlebih dahulu.
       </div>");
        redirect('login');
        }
        


        
        
    }

    
function index()
    {
        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/dashboard";


        $sql_pemesanan = "SELECT COUNT(id_pemesanan) AS jml_pemesanan FROM pemesanan";
        $row_pemesanan = $this->db->query($sql_pemesanan)->row();

        $sql_koki= "SELECT COUNT(id_pegawai) AS jml_koki FROM pegawai WHERE id_jabatan=3";
        $row_koki = $this->db->query($sql_koki)->row();

        $sql_pelayan= "SELECT COUNT(id_pegawai) AS jml_pelayan FROM pegawai WHERE id_jabatan=4";
        $row_pelayan = $this->db->query($sql_pelayan)->row();

        $sql_produk= "SELECT COUNT(id_produk) AS jml_produk FROM produk";
        $row_produk = $this->db->query($sql_produk)->row();

        $data['jml_pemesanan'] = $row_pemesanan->jml_pemesanan;
        $data['jml_koki'] = $row_koki->jml_koki;
        $data['jml_pelayan'] = $row_pelayan->jml_pelayan;
        $data['jml_produk'] = $row_produk->jml_produk;

        $sql_order = "SELECT COUNT(id_pemesanan) AS jml_order FROM pemesanan";
        $row_order = $this->db->query($sql_order)->row();

        $sql_order_solved = "SELECT COUNT(id_pemesanan) AS jml_order_solved FROM pemesanan WHERE status =3";
        $row_order_solved = $this->db->query($sql_order_solved)->row();

        $sql_order_process = "SELECT COUNT(id_pemesanan) AS jml_order_process FROM pemesanan WHERE status = 1";
        $row_order_process = $this->db->query($sql_order_process)->row();

        $sql_order_receive = "SELECT COUNT(id_pemesanan) AS jml_order_receive FROM pemesanan WHERE status = 2";
        $row_order_receive = $this->db->query($sql_order_receive)->row();

        $sql_order_cancel = "SELECT COUNT(id_pemesanan) AS jml_order_cancel FROM pemesanan WHERE status = 0";
        $row_order_cancel = $this->db->query($sql_order_cancel)->row();

        $data['jml_order_solved'] = $row_order_solved->jml_order_solved / $row_order->jml_order * 100;
        $data['jml_order_process'] = $row_order_process->jml_order_process / $row_order->jml_order * 100;
        $data['jml_order_receive'] = $row_order_receive->jml_order_receive / $row_order->jml_order * 100;
        $data['jml_order_cancel'] = $row_order_cancel->jml_order_cancel / $row_order->jml_order * 100;


        $datameja = $this->model_app->datameja();
        $data['datameja'] = $datameja;

   

        $this->load->view('template', $data);
    }

    
}
