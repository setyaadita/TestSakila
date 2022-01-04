<?php
    class actorM extends CI_model {

        // public function getFilm($film_id = null) {
        //     if($film_id != '') {
        //         return $this->db->get_where('film', ['film_id' => $film_id])->result_array();
        //     } 
        // }

        public function getFilm($actor_id = null) {
            if($actor_id != '') {
                $this->db->select("*");
                $this->db->from('film f');
                $this->db->join('film_actor ac', 'ac.film_id = f.film_id');
                $this->db->where('actor_id', $actor_id);
                $this->db->limit(2);
                $this->db->order_by('f.film_id');
                $qExec = $this->db->get();
                return $qExec->result_array();
            } 
        }

        public function addActor($data) {
            $this->db->insert('film_actor', $data);
            return $this->db->affected_rows();
        } 

        public function countFilm() {
            // $this->db->select('SELECT SUM(film_id.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid';
            $this->db->select('a.first_name AS name, COUNT(af.film_id) AS total ');
            $this->db->from('actor a');
            $this->db->join('film_actor af', 'af.actor_id = a.actor_id');
            $this->db->group_by('af.actor_id');
            $this->db->order_by('af.actor_id');
            $qExec = $this->db->get();
            return $qExec->result_array();
        }
        
    }
?>