<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_order extends CI_Controller {

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


 function order_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/order_list";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        $data['link'] = "daftar_order/hapus";

        $dataorder = $this->model_app->dataorder();
	    $data['dataorder'] = $dataorder;
        

        $this->load->view('template', $data);

 }

  function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();


    $sql = "SELECT * FROM pemesanan where id_pemesanan='$id'";

    $row = $this->db->query($sql)->row();

    $data['status'] = 0;

    $id_meja = $row->id_meja;

    $this->db->where('id_meja', $id_meja);
    $this->db->update('meja', $data);

 	$this->db->where('id_pemesanan', $id);
 	$this->db->delete('pemesanan');

    $this->db->where('id_pemesanan', $id);
    $this->db->delete('pemesanan_detail');




 	$this->db->trans_complete();
	
 }

 function view_detail($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/view_order_detail";

        $sql = "SELECT * FROM pemesanan_detail A
                        LEFT JOIN produk B ON B.id_produk = A.id_produk
                        WHERE A.id_pemesanan = '$id'";
        $detail_order = $this->db->query($sql);

        $sql_header = "SELECT * FROM pemesanan
                        WHERE id_pemesanan = '$id'";

        $sql_resto = "SELECT * FROM resto
                        WHERE id_resto = '1'";

        $row_resto = $this->db->query($sql_resto)->row();

        $data['nama_resto'] = $row_resto->nama_resto;
        $data['alamat'] = $row_resto->alamat;

        $row = $this->db->query($sql_header)->row();

        $data['id_pemesanan'] = $id;
        $data['nama_pemesan'] = $row->nama_pemesan;
        $data['cash'] = $row->cash;
        $data['cashback'] = $row->cashback;

        $data['data_detailorder'] = $detail_order;

        $this->load->view('template', $data);

 }


 function trans_bayar($id)
 {

        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/transaksi_order";

        $sql = "SELECT * FROM pemesanan_detail A
                        LEFT JOIN produk B ON B.id_produk = A.id_produk
                        WHERE A.id_pemesanan = '$id'";
        $detail_order = $this->db->query($sql);

        $sql_header = "SELECT * FROM pemesanan
                        WHERE id_pemesanan = '$id'";

        $sql_resto = "SELECT * FROM resto
                        WHERE id_resto = '1'";

        $row_resto = $this->db->query($sql_resto)->row();

        $data['nama_resto'] = $row_resto->nama_resto;
        $data['alamat'] = $row_resto->alamat;

        $row = $this->db->query($sql_header)->row();

        $data['id_pemesanan'] = $id;
        $data['nama_pemesan'] = $row->nama_pemesan;

        $data['data_detailorder'] = $detail_order;

        $this->load->view('template', $data);

 }

 function batal($id)
 {

 $sql = "SELECT * FROM pemesanan where id_pemesanan='$id'";

    $row = $this->db->query($sql)->row();

    $data['status'] = 0;

    $id_meja = $row->id_meja;

    $this->db->where('id_meja', $id_meja);
    $this->db->update('meja', $data);

        $data['status'] = 0;

    $this->db->trans_start();

    $this->db->where('id_pemesanan', $id);
    $this->db->update('pemesanan', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
                $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
                </div>");
                redirect('daftar_order/order_list');    
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
                </div>");
                redirect('daftar_order/order_list');    
            }

 }

 


 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_jabatan";

         $id_dept = trim($this->session->userdata('id_dept'));
        $id = trim($this->session->userdata('id_user'));

        //notification 

        $sql_listticket = "SELECT COUNT(id_ticket) AS jml_list_ticket FROM ticket WHERE status = 2";
        $row_listticket = $this->db->query($sql_listticket)->row();

        $data['notif_list_ticket'] = $row_listticket->jml_list_ticket;

        $sql_approvalticket = "SELECT COUNT(A.id_ticket) AS jml_approval_ticket FROM ticket A 
        LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori 
        LEFT JOIN kategori C ON C.id_kategori = B.id_kategori
        LEFT JOIN karyawan D ON D.nik = A.reported 
        LEFT JOIN bagian_departemen E ON E.id_bagian_dept = D.id_bagian_dept WHERE E.id_dept = $id_dept AND status = 1";
        $row_approvalticket = $this->db->query($sql_approvalticket)->row();

        $data['notif_approval'] = $row_approvalticket->jml_approval_ticket;

        $sql_assignmentticket = "SELECT COUNT(id_ticket) AS jml_assignment_ticket FROM ticket WHERE status = 3 AND id_teknisi='$id'";
        $row_assignmentticket = $this->db->query($sql_assignmentticket)->row();

        $data['notif_assignment'] = $row_assignmentticket->jml_assignment_ticket;

        //end notification

        $sql = "SELECT * FROM daftar_order WHERE id_jabatan = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "daftar_order/update";
			
		$data['id_jabatan'] = $id;		
		$data['nama_jabatan'] = $row->nama_jabatan;
 

        $this->load->view('template', $data);

 }

 function antar($id)
 {

 	
 	$data['status'] = 2;

 	$this->db->trans_start();

 	$this->db->where('id_pemesanan', $id);
 	$this->db->update('pemesanan', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
			    </div>");
				redirect('daftar_order/order_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
			    </div>");
				redirect('daftar_order/order_list');	
			}

 }


 function bayar()
 {

    $id = strtoupper(trim($this->input->post('id_pemesanan')));
    $cash = strtoupper(trim($this->input->post('cash')));
    $cashback = strtoupper(trim($this->input->post('cashback')));


     $sql = "SELECT * FROM pemesanan where id_pemesanan='$id'";

    $row = $this->db->query($sql)->row();

    $data['status'] = 0;

    $id_meja = $row->id_meja;

    $this->db->where('id_meja', $id_meja);
    $this->db->update('meja', $data);

    
    $data['status'] = 3;
    $data['cash'] = $cash;
    $data['cashback'] = $cashback;

    $this->db->trans_start();

    $this->db->where('id_pemesanan', $id);
    $this->db->update('pemesanan', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
                $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
                </div>");
                redirect('daftar_order/order_list');    
            } else 
            {
               
                redirect('daftar_order/view_detail/'.$id);    
            }

 }



    
}
