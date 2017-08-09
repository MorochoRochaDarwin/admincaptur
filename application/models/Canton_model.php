<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Canton_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    function get_canton_by_id($cantonId)
    {
        $query = $this->db->query("SELECT * FROM cantones WHERE cantonid=" . $cantonId);
        $res = $query->result();  // this returns an object of all results
        if ($res) {
            return $res[0];
        } else {
            return null;
        }
    }


    public function update($id, $data)
    {
        return $this->db->update('cantones', $data, array('cantonid' => $id));
    }

}