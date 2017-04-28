<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_resto extends CI_Controller {

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

    
function view()
    {
        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/profile_resto";

        
        $sql = "SELECT * from resto where id_resto ='1'";

        $row = $this->db->query($sql)->row();

        //general
        $data['nama_resto'] = $row->nama_resto;
        $data['alamat'] = $row->alamat;
        $data['tentang'] = $row->tentang;
        $data['nama_pemilik'] = $row->nama_pemilik;

    
        $this->load->view('template', $data);
    }


    function edit()
    {
        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/edit_profile_resto";

        
        $sql = "SELECT * from resto where id_resto ='1'";

        $row = $this->db->query($sql)->row();

        $data['url'] = "profile_resto/update";

        //general
        $data['nama_resto'] = $row->nama_resto;
        $data['alamat'] = $row->alamat;
        $data['tentang'] = $row->tentang;
        $data['nama_pemilik'] = $row->nama_pemilik;

    
        $this->load->view('template', $data);
    }


    function update()
    {

    $nama_resto = strtoupper(trim($this->input->post('nama_resto')));
    $tentang = strtoupper(trim($this->input->post('tentang')));
    $alamat = strtoupper(trim($this->input->post('alamat')));
    $nama_pemilik = strtoupper(trim($this->input->post('nama_pemilik')));

    $data['nama_resto'] = $nama_resto;
    $data['tentang'] = $tentang;
    $data['alamat'] = $alamat;
    $data['nama_pemilik'] = $nama_pemilik;

    $this->db->trans_start();

    $this->db->where('id_resto', 1);
    $this->db->update('resto', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
                $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal tersimpan.
                </div>");
                redirect('profile_resto/view');   
            } else 
            {
                $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data tersimpan.
                </div>");
                redirect('profile_resto/view');  
            }

 }

    
}
