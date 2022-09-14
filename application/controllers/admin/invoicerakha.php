<?php
class Invoicerakha extends CI_Controller{
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
        $data['invoice'] = $this->model_invoice_rakha->tampil_data();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/invoicerakha',$data);
        $this->load->view('templates_admin/footer');
    }
    public function detail($id_invoice)
    {
        $data['invoice'] = $this->model_invoice_rakha->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoice_rakha->ambil_id_pesanan($id_invoice);
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/detail_invoice_rakha',$data);
        $this->load->view('templates_admin/footer');
    }
}

?>