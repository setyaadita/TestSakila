<?php
    class Mahasiswa_M extends CI_model {
        public function getMahasiswa($id = null) {
            if($id === null) {
                return $this->db->get('mahasiswa')->result_array(); 
            } else {
                return $this->db->get_where('mahasiswa', ['nim' => $id])->result_array();
            }
        }
        public function deleteMahasiswa($id) {
            $this->db->delete('mahasiswa', ['nim' => $id]);
            return $this->db->affected_rows();
        }
        public function createMahasiswa($data) {
            $this->db->insert('mahasiswa', $data);
            return $this->db->affected_rows();
        } 
        public function updateMahasiswa($data, $id) {
            $this->db->update('mahasiswa', $data, ['nim' => $id]);
            return $this->db->affected_rows();
        }
    }
?>