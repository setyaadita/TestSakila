<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'libraries/RestController.php';

    class ActorC extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('actors/actorM', 'aktor');
        }

        // public function index_get() {

        //     $film_id = explode(",", $_GET['id']);
        //     $film_arr = array();

        //     foreach($film_id as $i =>$key) {
        //         if($film_id[$i] != '') {
        //             $film_arr[$i] = $this->aktor->getFilm($film_id[$i]);
        //         }
        //     }
        //     if($film_arr) {
        //         $this->response([
        //             'message' => OK,
        //             'data' => $film_arr
        //         ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        //     } else {
        //         $this->response([
        //             'status' => false,
        //             'message' => 'Film id not found'
        //         ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
        //     }
        // }

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
                    'message' => 'Film id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
            }
        }

        public function index_post() {
            $data = [
                'actor_id' => $this->post('actor_id'),
                'film_id' => $this->post('film_id'),
                'last_update' => $this->date_today
            ];
            if ($this->aktor->addActor($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Actor berhasil ditambahkan'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        public function index_get_jumlah() {

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