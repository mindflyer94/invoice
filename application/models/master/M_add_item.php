<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_add_item extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function insert_item($reg)
    {
        //print_r($reg);die();
        $data = array('name' => $reg['name'],
            'quantity' => $reg['quantity'],
            'unit_price' => $reg['price'],
            'tax' => $reg['tax']);
        $this->db->insert('product.item', $data);
    }

    function get_tax()
    {

        $this->db->select('*');
        $this->db->from('product.tax');
        $query = $this->db->get('');
        // echo $this->db->last_query();die();
        return $query->result_array();
    }

    function get_item()
    {
        $this->db->select('i.*,t.value');
        $this->db->from('product.item as i');
        $this->db->join('product.tax  as t', 'i.tax=t.id', 'inner');
        $query = $this->db->get('');
        // echo $this->db->last_query();die();
        return $query->result_array();
    }

    function update_item($reg)
    {
        $p_size = $reg['p_id'];
        $dis_size = $reg['amount'];


        for ($i = 0; $i < sizeof($p_size); $i++) {

            $value = $dis_size[$i];
            if ($value == "")
                $value = "0";
            $data = array(
                'discount_price' => $value

            );
            $this->db->where('id', $p_size[$i]);
            $query = $this->db->update('product.item', $data);
            // echo $this->db->last_query();die();
        }
    }

}//class
