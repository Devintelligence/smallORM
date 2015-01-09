<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of baseModel
 *
 * @author CMatecki
 */


class BaseModel extends BaseClass {

    protected $created_at = "";
    protected $deleted = "";
    protected $hidden = "";
    protected $updated_at = "";
    protected $deleted_at = "";
    function getCreated_at() {
        return $this->created_at;
    }

    function setCreated_at($createAt) {
        $this->created_at = $createAt;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function setUpdated_at($updatedAt) {
        $this->updated_at = $updatedAt;
    }

    function getDeleted_at() {
        return $this->deleted_at;
    }

    function setDeleted_at($deleted_at) {
        $this->deleted_at = $deleted_at;
    }

    function getDeleted() {
        return $this->deleted;
    }

    function setDeleted($deleted) {
        $this->deleted = $deleted;
    }



    function getHidden() {
        return $this->hidden;
    }

    function setHidden($hidden) {
        $this->hidden = $hidden;
    }

}

?>
