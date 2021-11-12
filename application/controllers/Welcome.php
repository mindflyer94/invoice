<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('master/m_add_item');
        $this->load->database();
    }

    function __destruct()
    {
        $this->db->close();
    }

    public function index()
    {
        // echo 'here';die();
        $data['tax']= $this->m_add_item->get_tax(); //print_r($data['tax']);die();
        $data['result']= $this->m_add_item->get_item();//print_r($data['result']);die();
        $this->load->view('master/add_items',$data);
    }
    function insert_item(){
        $reg['name'] = $this->security->xss_clean($this->input->post('name'));
        $reg['quantity'] = $this->security->xss_clean($this->input->post('quantity'));
        $reg['price'] = $this->security->xss_clean($this->input->post('price'));
        $reg['tax'] = $this->security->xss_clean($this->input->post('tax'));
        $reg['submit'] = $this->security->xss_clean($this->input->post('btnsubmit'));

        if (!empty($reg['submit'])) {
            $data['items'] = $this->m_add_item->insert_item($reg);
        }
        redirect('welcome/index');
    }
    function update_invoice(){ //echo "sdasdsadsa";die();
         $reg['p_id'] = $this->security->xss_clean($this->input->post('p_id'));// print_r($reg['p_id']);die();
         $reg['amount'] = $this->security->xss_clean($this->input->post('amount[]')); //print_r($reg['amount']);die();
         $reg['save'] = $this->security->xss_clean($this->input->post('save'));
        if (!empty($reg['save'])) {
            $data['items'] = $this->m_add_item->update_item($reg);
        }
        $data['result']= $this->m_add_item->get_item();
        redirect('welcome/index');
    }
}
