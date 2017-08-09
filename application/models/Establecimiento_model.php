<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Establecimiento_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    function get_by_canton($cantonId)
    {
        $query = $this->db->get_where('establecimientos', ['cantonid' => $cantonId]);
        return $query->result();
    }


    function insert($data)
    {
        $result = $this->db->insert('establecimientos', $data);
        return $result;
    }


    function get_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM establecimientos WHERE establecimiento_id=$id");
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
        if ($item->imagen_portada != null) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item->imagen_portada)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $item->imagen_portada);
            }
        }
        return $this->db->delete('establecimientos', array('establecimiento_id' => $id));
    }


    public function update($id, $data)
    {
        $item = $this->get_by_id($id);
        if ($item->imagen_portada != null) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $item->imagen_portada)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $item->imagen_portada);
            }
        }
        return $this->db->update('establecimientos', $data, array('establecimiento_id' => $id));
    }


}