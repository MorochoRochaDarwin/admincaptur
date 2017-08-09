<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventos_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    function get_by_canton($cantonId)
    {
        $query = $this->db->get_where('eventos',['cantonid'=>$cantonId]);
        return $query->result();
    }


    function insert($data)
    {
        $result = $this->db->insert('eventos', $data);
        return $result;
    }


    function get_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM eventos WHERE evento_id=$id");
        $res = $query->result();  // this returns an object of all results
        if ($res) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        $item = $this->get_by_id($id);
        if ($item->imagen != null) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item->imagen)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $item->imagen);
            }
        }
        return $this->db->delete('eventos', array('evento_id' => $id));
    }


    public function update($id,$data)
    {
        $item = $this->get_by_id($id);
        if ($item->imagen != null) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item->imagen)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $item->imagen);
            }
        }
        return $this->db->update('eventos',$data, array('evento_id' => $id));
    }


}