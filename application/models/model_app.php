<?php

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================
    
    public function getkodepegawai()
    {
        $query = $this->db->query("select max(id_pegawai) as max_code FROM pegawai");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_nik = $max_fix + 1;

        $nik = "P".sprintf("%04s", $max_nik);
        return $nik;
    }


    public function getkodepemesanan()
    {
        $query = $this->db->query("select max(id_pemesanan) as max_code FROM pemesanan");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 2, 9);

        $max = $max_fix + 1;

        $nik = "TR".sprintf("%09s", $max);
        return $nik;
    }


     public function getkodeproduk()
    {
        $query = $this->db->query("select max(id_produk) as max_code FROM produk");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max = $max_fix + 1;

        $id_produk = "R".sprintf("%04s", $max);
        return $id_produk;
    }

    

     public function getkodeakun()
    {
        $query = $this->db->query("select max(id_akun) as max_code FROM akun");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_id_akun = $max_fix + 1;

        $id_akun = "A".sprintf("%04s", $max_id_akun);
        return $id_akun;
    }
    
    public function datajabatan()
    {
    $query = $this->db->query('SELECT * FROM jabatan');
    return $query->result();
    }

    public function datapegawai()
    {
    $query = $this->db->query('SELECT A.id_pegawai, A.nama_pegawai, A.alamat, A.jk, B.nama_jabatan
                               FROM pegawai A LEFT JOIN jabatan B ON B.id_jabatan = A.id_jabatan');
    return $query->result();
    }

    public function dataproduk()
    {
    $query = $this->db->query('SELECT A.id_produk, A.nama_produk, A.harga, A.aktif, B.nama_kategori
                               FROM produk A LEFT JOIN kategori B ON B.id_kategori = A.id_kategori');
    return $query->result();
    }


    public function dataproduk_makanan()
    {
    $query = $this->db->query("SELECT A.id_produk, A.nama_produk, A.harga, A.aktif, B.nama_kategori
                               FROM produk A LEFT JOIN kategori B ON B.id_kategori = A.id_kategori WHERE A.id_kategori = '2'");
    return $query->result();
    }


    public function dataorder()
    {
    $query = $this->db->query("SELECT *,  A.status as STATUS_PESAN FROM PEMESANAN A 
                                LEFT JOIN meja C ON C.id_meja = A.id_meja");
    return $query->result();

    }


    public function dataproduk_minuman()
    {
    $query = $this->db->query("SELECT A.id_produk, A.nama_produk, A.harga, A.aktif, B.nama_kategori
                               FROM produk A LEFT JOIN kategori B ON B.id_kategori = A.id_kategori WHERE A.id_kategori = '3'");
    return $query->result();
    }


    public function datainformasi()
    {

        $query = $this->db->query("SELECT A.tanggal, A.subject, A.pesan, C.nama_pegawai, A.id_informasi
                                   FROM informasi A 
                                   LEFT JOIN pegawai C ON C.id_pegawai =  A.id_pegawai
                                   WHERE A.aktif = 1");
        return $query->result();

    }

  

    
    public function dataakun()
    {
         $query = $this->db->query('SELECT A.username, A.level, A.id_akun, B.id_pegawai, B.nama_pegawai, A.password
            FROM akun A LEFT JOIN pegawai B ON B.id_pegawai = A.username');

         return $query->result();

    }

    public function datakategori()
    {
    $query = $this->db->query('SELECT * FROM kategori');
    return $query->result();
    }

    public function datameja()
    {
    $query = $this->db->query('SELECT * FROM meja');
    return $query->result();
    }

   
    public function dropdown_kategori()
    {
        $sql = "SELECT * FROM kategori ORDER BY nama_kategori";
        $query = $this->db->query($sql);
            
            $value[''] = '-- PILIH --';
            foreach ($query->result() as $row){
                $value[$row->id_kategori] = $row->nama_kategori;
            }
            return $value;
    }

    public function dropdown_meja()
    {
        $sql = "SELECT * FROM meja WHERE status=0 ORDER BY id_meja ";
        $query = $this->db->query($sql);
            
            $value[''] = '-- PILIH MEJA --';
            foreach ($query->result() as $row){
                $value[$row->id_meja] = $row->nama_meja;
            }
            return $value;
    }

    public function dropdown_pegawai()
    {
        $sql = "SELECT A.nama_pegawai, A.id_pegawai FROM pegawai A 
                ORDER BY nama_pegawai";
        $query = $this->db->query($sql);
            
            $value[''] = '-- PILIH --';
            foreach ($query->result() as $row){
                $value[$row->id_pegawai] = $row->nama_pegawai;
            }
            return $value;
    }

    public function dropdown_jabatan()
    {
        $sql = "SELECT * FROM jabatan ORDER BY nama_jabatan";
        $query = $this->db->query($sql);
            
        $value[''] = '-- PILIH --';
        foreach ($query->result() as $row){
            $value[$row->id_jabatan] = $row->nama_jabatan;
        }
        return $value;
    }



    public function dropdown_jk()
    {
        $value[''] = '--PILIH--';            
        $value['LAKI-LAKI'] = 'LAKI-LAKI';
        $value['PEREMPUAN'] = 'PEREMPUAN';           
            
            return $value;
    }

    public function dropdown_aktif()
    {
        $value[''] = '--PILIH--';            
        $value[1] = 'YA';
        $value[0] = 'TIDAK';           
            
            return $value;
    }

    public function dropdown_level()
    {
        $value[''] = '--PILIH--';            
        $value['ADMIN'] = 'ADMIN';
        $value['USER'] = 'USER';           
            
            return $value;
    }



   

   

}