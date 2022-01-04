<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'libraries/RestController.php';

    class Task1 extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('actors/actorM', 'aktor');
        }

         public function index_get() {

            $actor_id = $_GET['id'];

            if($actor_id != '') {
                $film_list = $this->aktor->getFilm($actor_id);
            }

            if($film_list) {
                $this->response([
                    'message' => OK,
                    'data' => $film_list
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'List film aktor tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
            }
        }
       
    }
?>