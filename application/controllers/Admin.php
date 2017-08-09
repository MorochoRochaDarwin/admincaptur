<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {   //en el constructor cargamos nuestro modelo
        parent::__construct();

        //si alguien tarta de ingresar al sistema sin autorizacion
        if (!isset($_SESSION['username'])) {
            exit('403 acceso denegado');
        }


        $this->load->model('Usuario_model');
        $this->load->model('Canton_model');
        $this->load->model('Establecimiento_model');
        $this->load->model('Eventos_model');
        $this->load->model('Radares_model');
        $this->load->model('Portadas_model');


    }

    public function index()
    {
        $this->load->view('home');

    }

    public function password()
    {
        $this->load->view('password');

    }


    public function canton($cantonId)
    {

        $canton = $this->Canton_model->get_canton_by_id($cantonId);
        $portadas = $this->Portadas_model->get_by_canton($cantonId);
        if ($canton) {
            $this->load->view('canton', ['canton' => $canton, 'portadas' => $portadas]);
        } else {
            exit('404 pagina no encontrada');
        }


    }


    public function evento($id)
    {

        $ev = $this->Eventos_model->get_by_id($id);
        if ($ev) {
            $this->load->view('evento', ['evento' => $ev]);
        } else {
            exit('404 pagina no encontrada');
        }


    }

    public function establecimiento($id)
    {

        $est = $this->Establecimiento_model->get_by_id($id);
        if ($est) {
            $this->load->view('establecimiento', ['est' => $est]);
        } else {
            exit('404 pagina no encontrada');
        }


    }

    public function list_radares()
    {
        $this->load->view('radares');

    }


    public function establecimientos_canton($cantonId)
    {

        $canton = $this->Canton_model->get_canton_by_id($cantonId);
        if ($canton) {
            $this->load->view('establecimientos', ['canton' => $canton]);
        } else {
            exit('404 pagina no encontrada');
        }


    }


    public function eventos_canton($cantonId)
    {

        $canton = $this->Canton_model->get_canton_by_id($cantonId);
        if ($canton) {
            $this->load->view('eventos', ['canton' => $canton]);
        } else {
            exit('404 pagina no encontrada');
        }


    }


    /**
     * ajax actualiza la informacion de una canton
     */
    public function actualizar_canton()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }


        $id = $_POST['id'];
        $html = $_POST['html'];

        $data = ['descripcion' => $html];

        $result = $this->Canton_model->update($id, $data);

        echo $result;


    }


    /**
     * lista los establecimientos segun un canton
     */
    public function establecimientos()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $cantonId = $_POST{'cantonId'};

        $establecimientos = $this->Establecimiento_model->get_by_canton($cantonId);

        $data = array();

        if ($establecimientos) {
            foreach ($establecimientos as $est) {
                $url_edit = base_url('establecimiento/' . $est->establecimiento_id);
                $json = array(
                    $est->establecimiento_id, $est->nombre_establecimiento,
                    $est->direccion,
                    $est->tipo,
                    "
                <a class='btn btn-info btn-sm' href='$url_edit'><i class='icon-edit'></i> Editar</a>
                <button class='btn btn-danger btn-sm' title='eliminar categoria' onclick=\"eliminar($est->establecimiento_id)\"><i class='icon-trash-2'></i> Eliminar</button>"
                );
                array_push($data, $json);
            }
        }
        echo json_encode(array('data' => $data));
    }


    public function eventos()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $cantonId = $_POST{'cantonId'};

        $eventos = $this->Eventos_model->get_by_canton($cantonId);

        $data = array();

        if ($eventos) {
            foreach ($eventos as $est) {
                $url_edit = base_url('evento/' . $est->evento_id);
                $json = array(
                    $est->evento_id, $est->titulo_evento,
                    $est->direccion,
                    $est->fecha_evento,
                    $est->hora_evento,
                    "
                <a class='btn btn-info btn-sm' href='$url_edit'><i class='icon-edit'></i> Editar</a>
                <button class='btn btn-danger btn-sm' title='eliminar categoria' onclick=\"eliminar($est->evento_id)\"><i class='icon-trash-2'></i> Eliminar</button>"
                );
                array_push($data, $json);
            }
        }
        echo json_encode(array('data' => $data));
    }


    public function radares()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $radares = $this->Radares_model->get_radares();

        $data = array();

        if ($radares) {
            foreach ($radares as $est) {
                $url_edit = base_url('radar/' . $est->radar_id);
                $json = array(
                    $est->radar_id, $est->latitud,
                    $est->longitud,
                    $est->addr,
                    "
              
                <button class='btn btn-danger btn-sm' title='eliminar categoria' onclick=\"eliminar($est->radar_id)\"><i class='icon-trash-2'></i> Eliminar</button>"
                );
                array_push($data, $json);
            }
        }
        echo json_encode(array('data' => $data));
    }


    /**
     * agrega un nuevo establecimiento a la base de datos
     * @return int 1 o -1
     */
    function nuevo_establecimiento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $canton = $_POST['cantonId'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $img64 = $_POST['portada'];
        $twitter = $_POST['twitter'];
        $google = $_POST['google'];
        $youtube = $_POST['youtube'];
        $facebook = $_POST['facebook'];
        $latitud = $_POST['lat'];
        $longitud = $_POST['lng'];
        $pagina_web = $_POST['web'];
        $direccion = $_POST['addr'];
        $descripcion = $_POST['descripcion'];


        if (isset($img64)) {
            list($type, $data) = explode(';', $img64);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'est-' . md5(uniqid(rand(), true)) . '.png';
            $cover_path = '/covers/' . $filename;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/covers/' . $filename, $data);
            $data = [
                'nombre_establecimiento' => $nombre,
                'tipo' => $tipo,
                'twitter' => $twitter,
                'google' => $google,
                'facebook' => $facebook,
                'youtube' => $youtube,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'pagina_web' => $pagina_web,
                'imagen_portada' => $cover_path,
                'direccion' => $direccion,
                'descripcion' => $descripcion,
                'cantonid' => $canton,

            ];

        } else {
            $data = [
                'nombre_establecimiento' => $nombre,
                'tipo' => $tipo,
                'twitter' => $twitter,
                'google' => $google,
                'facebook' => $facebook,
                'youtube' => $youtube,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'pagina_web' => $pagina_web,
                'direccion' => $direccion,
                'descripcion' => $descripcion,
                'cantonid' => $canton,

            ];
        }


        $establecimiento = $this->Establecimiento_model->insert($data);

        if ($establecimiento) {
            return 1;
        } else {
            return -1;
        }


    }


    function edit_establecimiento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        $img64 = $_POST['portada'];
        $twitter = $_POST['twitter'];
        $google = $_POST['google'];
        $youtube = $_POST['youtube'];
        $facebook = $_POST['facebook'];
        $latitud = $_POST['lat'];
        $longitud = $_POST['lng'];
        $pagina_web = $_POST['web'];
        $direccion = $_POST['addr'];
        $descripcion = $_POST['descripcion'];


        if (isset($img64)) {
            list($type, $data) = explode(';', $img64);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'est-' . md5(uniqid(rand(), true)) . '.png';
            $cover_path = '/covers/' . $filename;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/covers/' . $filename, $data);
            $data = [
                'nombre_establecimiento' => $nombre,
                'tipo' => $tipo,
                'twitter' => $twitter,
                'google' => $google,
                'facebook' => $facebook,
                'youtube' => $youtube,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'pagina_web' => $pagina_web,
                'imagen_portada' => $cover_path,
                'direccion' => $direccion,
                'descripcion' => $descripcion,

            ];

        } else {
            $data = [
                'nombre_establecimiento' => $nombre,
                'tipo' => $tipo,
                'twitter' => $twitter,
                'google' => $google,
                'facebook' => $facebook,
                'youtube' => $youtube,
                'latitud' => $latitud,
                'longitud' => $longitud,
                'pagina_web' => $pagina_web,
                'direccion' => $direccion,
                'descripcion' => $descripcion,

            ];
        }


        $establecimiento = $this->Establecimiento_model->update($id, $data);

        if ($establecimiento) {
            return 1;
        } else {
            return -1;
        }


    }


    function nuevo_evento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $canton = $_POST['cantonId'];
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $addr = $_POST['direccion'];
        $img64 = $_POST['img64'];
        $cdescripcion = $_POST['cdescripcion'];
        $descripcion = $_POST['descripcion'];


        if (isset($img64)) {
            list($type, $data) = explode(';', $img64);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'event-' . md5(uniqid(rand(), true)) . '.png';
            $cover_path = '/covers/' . $filename;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/covers/' . $filename, $data);
            $data = [
                'titulo_evento' => $nombre,
                'fecha_evento' => $fecha,
                'hora_evento' => $hora,
                'direccion' => $addr,
                'descripcion_corta' => $cdescripcion,
                'descripcion' => $descripcion,
                'cantonid' => $canton,
                'imagen' => $cover_path,
                'fecha_publicacion' => date("Y-m-d H:i:s"),

            ];

        } else {
            $data = [
                'titulo_evento' => $nombre,
                'fecha_evento' => $fecha,
                'hora_evento' => $hora,
                'direccion' => $addr,
                'descripcion_corta' => $cdescripcion,
                'descripcion' => $descripcion,
                'cantonid' => $canton,
                'fecha_publicacion' => date("Y-m-d H:i:s"),
            ];
        }


        $evento = $this->Eventos_model->insert($data);

        if ($evento) {
            return 1;
        } else {
            return -1;
        }


    }


    function edit_evento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $addr = $_POST['direccion'];
        $img64 = $_POST['img64'];
        $cdescripcion = $_POST['cdescripcion'];
        $descripcion = $_POST['descripcion'];


        if (isset($img64)) {
            list($type, $data) = explode(';', $img64);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'event-' . md5(uniqid(rand(), true)) . '.png';
            $cover_path = '/covers/' . $filename;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/covers/' . $filename, $data);
            $data = [
                'titulo_evento' => $nombre,
                'fecha_evento' => $fecha,
                'hora_evento' => $hora,
                'direccion' => $addr,
                'descripcion_corta' => $cdescripcion,
                'descripcion' => $descripcion,
                'imagen' => $cover_path,
                'fecha_publicacion' => date("Y-m-d H:i:s"),

            ];

        } else {
            $data = [
                'titulo_evento' => $nombre,
                'fecha_evento' => $fecha,
                'hora_evento' => $hora,
                'direccion' => $addr,
                'descripcion_corta' => $cdescripcion,
                'descripcion' => $descripcion,
                'fecha_publicacion' => date("Y-m-d H:i:s"),
            ];
        }


        $evento = $this->Eventos_model->update($id, $data);

        if ($evento) {
            return 1;
        } else {
            return -1;
        }


    }


    function nuevo_radar()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }


        $addr = $_POST['addr'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        $data = [
            'addr' => $addr,
            'latitud' => $lat,
            'longitud' => $lng,
        ];


        $evento = $this->Radares_model->insert($data);

        if ($evento) {
            return 1;
        } else {
            return -1;
        }


    }


    function nueva_portada()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $canton = $_POST['cantonId'];
        $img64 = $_POST['img64'];


        if (isset($img64)) {
            list($type, $data) = explode(';', $img64);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'portada-' . md5(uniqid(rand(), true)) . '.png';
            $cover_path = '/covers/' . $filename;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/covers/' . $filename, $data);
            $data = [
                'cantonid' => $canton,
                'url' => $cover_path,


            ];

            $ep = $this->Portadas_model->insert($data);

            if ($ep) {
                echo "exito";
            } else {
                echo "Error";
            }

        } else {
            echo "Error";
        }


    }


    public function eliminar_portada()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $_POST['id'];
        $res = $this->Portadas_model->delete($id);
        if ($res > 0) {
            echo "exito";
        } else {
            echo "No se pudo eliminar";
        }
    }


    /**
     * elimino un establecimiento
     */
    public function eliminar_establecimiento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $_POST['id'];
        $res = $this->Establecimiento_model->delete($id);
        if ($res > 0) {
            echo "exito";
        } else {
            echo "No se pudo eliminar";
        }
    }


    public function eliminar_evento()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $_POST['id'];
        $res = $this->Eventos_model->delete($id);
        if ($res > 0) {
            echo "exito";
        } else {
            echo "No se pudo eliminar";
        }
    }

    public function eliminar_radar()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $_POST['id'];
        $res = $this->Radares_model->delete($id);
        if ($res > 0) {
            echo "exito";
        } else {
            echo "No se pudo eliminar";
        }
    }


    public function password_change()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $user_id = $_SESSION['user_id'];
        $pass = $_POST['pass'];
        $npass = $_POST['npass'];
        $vnpass = $_POST['vnpass'];


        if (isset($pass) && isset($npass) && isset($vnpass)) {


            if (strlen($npass) > 4) {
                if ($npass == $vnpass) {
                    $res = $this->Usuario_model->password_change($pass, password_hash($npass, PASSWORD_DEFAULT), $user_id);
                    echo $res;
                } else {
                    echo "Las contraseñas no coinciden";
                }

            } else {
                echo "ingrese una nueva contraseña con mas de 5 caracteres";
            }
        } else {
            echo "datos invalidos";
        }


    }


}