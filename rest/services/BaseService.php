<?php

class BaseService{

    protected $dao;

    public function __construct($dao){
        $this->dao = $dao;
    }

    public function get_all(){
        $this->dao->get_all;
    }
    
    public function get_by_id($id){
        $this->dao->get_by_id($id);
    }

    public function delete($id){
        $this->dao->delete($id);
    }

    public function add($entity){
        $this->dao->add($entity);
    }

    public function update($entity,$id){
        $this->dao->update($entity,$id);
    }

    
}
?>