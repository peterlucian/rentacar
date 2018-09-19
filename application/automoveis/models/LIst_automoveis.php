<?php
class List_automoveis extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_auto($id=NULL)
        {
                $categoria = $this->input->post('categoria');
                $filtro = $this->input->post('filtro');

                $this->db->select('cores.id AS id_cor, modelos.id AS id_modelo, automoveis.id, automoveis.disponibilidade, modelos.nome AS modelo, cores.nome AS cor, fabricantes.nome AS fabricante');
                $this->db->from('automoveis');
                $this->db->join('modelos', 'automoveis.modelo_id=modelos.id');
                $this->db->join('cores', 'automoveis.cor_id=cores.id');
                $this->db->join('fabricantes', 'modelos.fabricante_id=fabricantes.id');
                
                if(!is_null($id)) $this->db->where('automoveis.id', $id);
                if(isset($categoria)){ 
                    $this->db->like($categoria.'.nome', "$filtro");
                    $this->db->order_by($categoria.'.nome', "asc");
                }
                $query = $this->db->get();
                return $query->result_array();
        }
        

        public function get_data()
        {
                $this->db->select('cores.id AS id_cor, cores.nome AS cor, modelos.id AS id_modelo, 
modelos.nome AS modelo');
                $this->db->from('modelos');
                $this->db->join('cores', 'modelos.id=cores.id', 'LEFT');
    
                $query = $this->db->get();
                return $query->result_array();
        }

        public function set_auto()
        {
            $data = array(
                'cor_id' => $this->input->post('cor'),
                'modelo_id' => $this->input->post('modelo'),
                'disponibilidade' => $this->input->post('disponibilidade')
            );

            return $this->db->insert('automoveis', $data);
        }

        public function update_auto()
        {
            $data = array(
                'cor_id' => $this->input->post('cor'),
                'modelo_id' => $this->input->post('modelo'),
                'disponibilidade' => $this->input->post('disponibilidade')
            );

            $id=$this->input->post('id');

            $this->db->where('id', $id);
            return $this->db->update('automoveis', $data);
        }

        public function delete_auto($id){
            return $this->db->delete('automoveis', array('id' => $id));
        }


}

/* SELECT automoveis.disponibilidade, modelos.nome AS modelo, cores.nome AS cor,  fabricantes.nome AS fabrincante
FROM automoveis
JOIN modelos ON automoveis.modelo_id=modelos.id 
JOIN cores ON automoveis.cor_id=cores.id
JOIN fabricantes ON modelos.fabricante_id=fabricantes.id
 
SELECT cores.id AS id_cor, cores.nome AS cor, modelos.id AS id_modelo, 
modelos.nome AS modelo FROM modelos LEFT JOIN cores ON modelos.id=cores.id;

SELECT * FROM `cores` c WHERE c.id not in(Select cor_id 
from automoveis where modelo_id=1)
*/