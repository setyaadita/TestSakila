<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'libraries/RestController.php';

    class Task3 extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('actors/actorM', 'aktor');
        }

        public function index_get() {

            $jum_film = $this->aktor->countFilm();

            if($jum_film) {
                $this->response([
                    'status' => OK,
                    'data' => $jum_film
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Film id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
            }
        }
       
    }
?>