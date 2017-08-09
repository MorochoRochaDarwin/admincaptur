<?php
/**
 * Created by PhpStorm.
 * User: DARWIN MOROCHO
 * Date: 05/07/2017
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }


    /**
     * @param $email
     * @return mixed usuario con el email indicado
     */
    function get_user_by_username($username)
    {
        $query = $this->db->query("SELECT * FROM usuarios WHERE username='$username'");
        $res = $query->result();  // this returns an object of all results
        if ($res) {
            return $res[0];
        } else {
            return null;
        }
    }

    function get_user_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM usuarios WHERE id=$id");
        $res = $query->result();  // this returns an object of all results
        if ($res) {
            return $res[0];
        } else {
            return null;
        }
    }



    function password_change($pass,$npass, $user_id)
    {

        $user=$this->get_user_by_id($user_id);

        if($user){
            if(password_verify($pass, $user->password)){
                $this->db->set('password', $npass);
                $this->db->where('id', $user_id);
                return $this->db->update('usuarios');
            }else{
                return "La constraseña es invalida";
            }

        }else{
            return "No se pudo encontrar al usuario";
        }


    }


}