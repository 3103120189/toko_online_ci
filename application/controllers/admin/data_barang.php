<?php
class Data_barang extends CI_controller{
    public function __construct(){
        parent::__construct();

        if($this->session->userdata('role_id') != '1'){
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda Belum Login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>');
        redirect('auth/login');
        }
    }
    public function index()
    {
        $data['barang'] = $this->model_barang_rakha->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_barang_rakha', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi_rakha()
    {
        $nama_brg          = $this->input->post('nama_brg');
        $keterangan        = $this->input->post('keterangan');
        $kategori          = $this->input->post('kategori');
        $harga             = $this->input->post('harga');
        $stok              = $this->input->post('stok');
        $gambar            =$_FILES['gambar']['name'];
        if($gambar=''){}else{
            $config ['upload_path']       ='./uploads';
            $config ['allowed_types']     ='jpg|jpeg|png|tiff';
            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('gambar')){
                echo "Gambar Gagal diuplad!";
            }else{
                $gambar=$this->upload->data('file_name');
            }
        }
        $data = array(
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok,
            'gambar'        => $gambar
        );

        $this->model_barang_rakha->tambah_barang($data, 'tb_barang');
        redirect('admin/data_barang/index');
    }
    public function edit_rakha($id)
    {
        $where = array('id_brg'   =>$id);
        $data['barang']  = $this->model_barang_rakha->edit_barang($where, 'tb_barang')->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_barang_rakha', $data);
        $this->load->view('templates_admin/footer');
    }
    public function update_rakha()
    {
        $id                  = $this->input->post('id_brg');
        $nama_brg            = $this->input->post('nama_brg');
        $keterangan          = $this->input->post('keterangan');
        $kategori            = $this->input->post('kategori');
        $harga               = $this->input->post('harga');
        $stok                = $this->input->post('stok');

        $data = array(
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok,
        );

        $where = array(
            'id_brg'  =>$id
        );

        $this->model_barang_rakha->update_data($where,$data, 'tb_barang');
        redirect('admin/data_barang/index');
    }

    public function hapus_rakha($id)
    {
        $where = array('id_brg'  => $id);
        $this->model_barang_rakha->hapus_data($where, 'tb_barang');
        redirect('admin/data_barang/index');
    }

}


?>