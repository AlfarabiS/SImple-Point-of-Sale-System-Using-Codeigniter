<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
    
    
    public function semua_barang(){
      
      $query = $this->db->query('CALL STOK_BARANG()');

      return $query->result_array();

    }

    public function kategori_barang(){
      
      $query = $this->db->query('SELECT * FROM kategori');

      return $query->result_array();

    }

    public function pencarian_barang($keyword){
      
      $this->db->select('*');
      $this->db->from('barang');
      $this->db->join('kategori', 'barang.id_kategori=kategori.id_kategori','innner');
      $this->db->like('barang',$keyword);
      $this->db->or_like('kategori',$keyword);
      $this->db->order_by('kategori');
      $this->db->order_by('barang');
      $query = $this->db->get();

      return $query->result_array();

    }

    public function update_stok($id_br,$stok_br){
      $query = $this->db->get_where('barang',['id_barang' => $id_br])->row_array();
      $stok_update = $query['stok'] + $stok_br;
      //var_dump($query);
      $this->db->where('id_barang', $id_br);
      $this->db->update('barang',['stok' => $stok_update]);
    }

    public function insert_barang($data){
      $this->db->insert('barang',$data);
    }

    public function insert_transaksi($transaksi){
      $this->db->insert('transaksi',$transaksi);
    }
    
    public function update_transaksi($id_br,$stok_br){
      $query = $this->db->get_where('barang',['id_barang' => $id_br])->row_array();
      $stok_update = $query['stok'] - $stok_br;
      //var_dump($query);
      $this->db->where('id_barang', $id_br);
      $this->db->update('barang',['stok' => $stok_update]);
    }

    public function semua_penjualan(){
      $query = $this->db->query('CALL SEMUA_PENJUALAN()');

      return $query->result_array();
    }
  }