<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Radares_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    function get_radares()
    {
        $query = $this->db->query("SELECT * FROM radares");
        $res = $query->result();  // this returns an object of all results

        return $res;
    }


    function insert($data)
    {
        $result = $this->db->insert('radares', $data);
        return $result;
    }


    function get_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM radares WHERE radar_id=$id");
        $res = $query->result();  // this returns an object of all results
        if ($res) {
            return $res[0];
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        return $this->db->delete('radares', array('radar_id' => $id));
    }





}