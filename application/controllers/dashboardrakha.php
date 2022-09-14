<?php
class Dashboardrakha extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if($this->session->userdata('role_id') != '2'){
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda Belum Login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>');
        redirect('auth/login');
        }
    }

    public function tambah_ke_keranjang($id)
    {
        $barang = $this->model_barang_rakha->find($id);

        $data = array(
            'id'      => $barang->id_brg,
            'qty'     => 1,
            'price'   => $barang->harga,
            'name'    => $barang->nama_brg,
            
        );
        
        $this->cart->insert($data);
        redirect('welcome');
    }

    public function detail_keranjang()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang_rakha');
        $this->load->view('templates/footer');
    }
    public function hapus_keranjang_rakha()
    {
        $this->cart->destroy();
        redirect('welcome');
    }
    public function pembayaran()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran_rakha');
        $this->load->view('templates/footer');
    }
    public function proses_pesanan_rakha()
    {
        $is_processed = $this->model_invoice_rakha->index();
        if($is_processed){
            $this->cart->destroy();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('proses_pesanan_rakha');
            $this->load->view('templates/footer');
        }else{
            echo "Maaf, Pesanan Anda Gagal diproses!";
        }
        
    }
    public function detail($id_brg)
    {
        $data['barang'] = $this->model_barang_rakha->detail_brg($id_brg);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('detail_barang_rakha',$data);
        $this->load->view('templates/footer');
    }
    
}

?>