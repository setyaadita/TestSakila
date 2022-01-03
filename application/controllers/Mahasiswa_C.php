<?php
    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'libraries/RestController.php';
    // require APPPATH . 'libraries/Format.php';
    class Mahasiswa_C extends REST_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Mahasiswa_M', 'mhs');
        }
        // Get Data
        public function index_get() {
            $id = $this->get('nim');
            // jika id tidak ada (tidak panggil) 
            if($id === null) {
                // maka panggil semua data
                $mahasiswa = $this->mhs->getMahasiswa();
                // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
            } else {
                $mahasiswa = $this->mhs->getMahasiswa($id);
            }
            if($mahasiswa) {
                $this->response([
                    'status' => true,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
            }
        }
        // delete data
        public function index_delete() {
            $id = $this->delete('nim');
            if($id === null) {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            } else {
                if($this->mhs->deleteMahasiswa($id) > 0) {
                    // Ok
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'deleted success'
                    ], REST_Controller::HTTP_NO_CONTENT);
                } else {
                    // id not found
                    $this->response([
                        'status' => false,
                        'message' => 'id not found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                
                }
            }
        }
        // post data
        public function index_post() {
            $data = [
                'nim' => $this->post('nim'),
                'nama' => $this->post('nama'),
                'id_jurusan' => $this->post('id_jurusan'),
                'alamat' => $this->post('alamat')
            ];
            if ($this->mhs->createMahasiswa($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has been created'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        // update data
        public function index_put() {
            $id = $this->put('nim');
            $data = [
                'nim' => $this->put('nim'),
                'nama' => $this->put('nama'),
                'id_jurusan' => $this->put('id_jurusan'),
                'alamat' => $this->put('alamat')
            ];
            if ($this->mhs->updateMahasiswa($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'update mahasiswa has been updated'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed to update data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
?>