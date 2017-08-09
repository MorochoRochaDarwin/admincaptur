<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Portadas_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    function get_by_canton($cantonId)
    {
        $query = $this->db->get_where('imagenes_cantones',['cantonid'=>$cantonId]);
        return $query->result();
    }


    function insert($data)
    {
        $result = $this->db->insert('imagenes_cantones', $data);
        return $result;
    }


    function get_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM imagenes_cantones WHERE id=$id");
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
        if ($item->url != null) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item->url)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $item->url);
            }
        }
        return $this->db->delete('imagenes_cantones', array('id' => $id));
    }


}