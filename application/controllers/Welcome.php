<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
    {   //en el constructor cargamos nuestro modelo
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    public function index()
    {
        if(isset($_SESSION['username'])){
            redirect('home');
        }else{
            $this->load->view('login', ['error' => null]);
        }

    }


    public function login()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username != null && $password != null) {
            $usuario = $this->Usuario_model->get_user_by_username($username);

            if ($usuario) {

                if (password_verify($password, $usuario->password)) {//si el usuario se logeo correctamente
                    $_SESSION['user_id'] = $usuario->id;
                    $_SESSION['username'] = $usuario->username;
                    redirect(site_url('home'));
                } else {
                    $this->load->view('login', ['error' => 'La contraseña ingresada no es correcta']);
                }

            } else {
                $this->load->view('login', ['error' => 'No se encontro el usuario']);
            }
        } else {
            $this->load->view('login', ['error' => 'Usuario o contreaseña invalidos']);
        }

    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }


}
