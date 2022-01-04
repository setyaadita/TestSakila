<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'libraries/RestController.php';

    class Task2 extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('actors/actorM', 'aktor');
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
       
    }
?>