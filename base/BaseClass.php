<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of baseClass
 *
 * @author CMatecki
 */
include_once dirname('.') . '/includes/mysql.php';

include_once dirname('.') . '/includes/conf.inc.php';

class BaseClass {

    private $table = "";
    private $primaryColumn = "";

    function __construct() {
        global $db;
        $db = new Database(constant("HOST"), constant("USER"), constant("HASH"));
        $db->select_db(constant("DATABASE"));
    }

    function getTable() {
        return $this->table;
    }

    function setTable($table) {
        $this->table = $table;
    }

    function getPrimaryColumn() {
        return $this->primaryColumn;
    }

    function setPrimaryColumn($primaryColumn) {
        $this->primaryColumn = $primaryColumn;
    }

    function getAll() {
        $sql = "SELECT * FROM `" . $this->getTable() . "` WHERE (deleted IS NULL OR deleted =0)";

        $model = $this->select($sql, $this);
        ;
        return $model;
    }

    function getAllWithOrder($order, $direction) {
        $sql = "SELECT * FROM `" . $this->getTable() . "` WHERE (deleted IS NULL OR deleted =0) order by " . $order . " " . $direction;

        $model = $this->select($sql, $this);

        return $model;
    }

    function getForeign($model, $id) {

        $sql = "SELECT * FROM `" . $model->getTable() . "` WHERE " . $model->getPrimaryColumn() . " = " . $id;

        $model = $this->select($sql, $model);

        return $model[0];
    }

    function getById($id) {

        $sql = "SELECT * FROM `" . $this->getTable() . "` WHERE " . $this->getPrimaryColumn() . " = " . $id;

        $model = $this->select($sql, $this);

        return $model[0];
    }

    function getByIdAsArray($id) {

        $sql = "SELECT * FROM `" . $this->getTable() . "` WHERE " . $this->getPrimaryColumn() . " = " . $id;
        $data = $this->selectQueryAsArray($sql);
        return $data[0];
    }

    function customSelectQuery($sql) {

        $model = $this->select($sql, $this);

        return $model;
    }

    function selectQueryAsArray($sql) {
        global $db;

        $result = $db->sql($sql);
        $obj = array();
        $j = 0;
        while ($row = mysqli_fetch_array($result)) {



            $fields = mysqli_fetch_fields($result);

            foreach ($fields as $field) {
                $fieldname = $field->name;
                $obj[$j][$fieldname] = $this->xss_clean($row[$fieldname]);
            }




            $j++;
        }

        return $obj;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->xss_clean($this->$property);
        }
    }

    public function __set($property, $value) {

        if (property_exists($this, $property)) {
            $this->$property = $value;
        }


        return $this;
    }

    protected function select($sql, $model) {
        global $db;

        $result = $db->sql($sql);
        $obj = array();
        $j = 0;

        while ($row = mysqli_fetch_object($result, get_class($model))) {
            $obj[$j] = $row;

            $j++;
        }

        return $obj;
    }

    public function selectVirtual($sql, $model) {
        global $db;

        $result = $db->sql($sql);
        $obj = array();
        $j = 0;
        $reflectionClass = new ReflectionClass($model);
        $tempModel = $reflectionClass->newInstance();
        while ($row = mysqli_fetch_object($result, get_class($tempModel))) {

            $obj[$j] = $row;

            $j++;
        }

        return $obj;
    }

    function insert() {
        global $db;

        $date = date("Y-m-d H:i");

        $sql = "";

        $sql.="INSERT INTO `" . $this->getTable() . "`";
        $sql.="(" . $this->getModelKeys($this) . ",created_at)";
        $sql.="VALUES";
        $sql.="(" . $this->getModelValues($this) . ",'" . $date . "')";



        $insertId = $db->upsert($sql);


        return $insertId;
    }

    function insertForeign() {
        global $db;

        $date = date("Y-m-d H:i");

        $sql = "";

        $sql.="INSERT INTO `" . $this->getTable() . "`";
        $sql.="(" . $this->getModelKeys($this) . ")";
        $sql.="VALUES";
        $sql.="(" . $this->getModelValues($this) . ")";



        $insertId = $db->upsert($sql);


        return $insertId;
    }

    function insertWithPrimary() {
        global $db;

        $date = date("Y-m-d H:i");

        $sql = "";

        $sql.="INSERT INTO `" . $this->getTable() . "`";
        $sql.="(" . $this->getPrimaryColumn() . "," . $this->getModelKeys($this) . ",created_at)";
        $sql.="VALUES";
        $sql.="(" . $this->getId() . "," . $this->getModelValues($this) . ",'" . $date . "')";



        $insertId = $db->upsert($sql);


        return $insertId;
    }

    function update($model) {
        global $db;
        $date = date("Y-m-d H:i");


        $sql = "";
        $keyColumn = $this->getPrimaryColumn();

        $sql.="UPDATE `" . $this->getTable() . "` SET ";
        $sql.="" . $this->getModelKeyValues($this) . ",updated_at='" . $date . "'";
        $sql.=" WHERE ";
        $sql.=" " . $keyColumn . " = " . $this->getId();


        $insertId = $db->upsert($sql);
        return $insertId;
    }

    function updateWithId($model, $id) {
        global $db;
        $date = date("Y-m-d H:i");
        $sql = "";
        $keyColumn = $model->getPrimaryColumn();
        $sql.="UPDATE `" . $model->getTable() . "` SET ";
        $sql.="" . $this->getModelKeyValues($model) . ",updated_at='" . $date . "'";
        $sql.="WHERE ";
        $sql.="" . $keyColumn . " = " . $id;

        $insertId = $db->upsert($sql);
        return $insertId;
    }

    function delete($id) {
        global $db;
        $date = date("d.m.Y H:i");
        $sql = "UPDATE `" . $this->getTable() . "` set deleted=1,deleted_at='" . $date . "' WHERE " . $this->getPrimaryColumn() . "=" . $id;
        $db->sql($sql);
    }

    function customDeleteQuery($query) {
        global $db;
        $db->sql($query);
    }

    function customUpsertQuery($query) {
        global $db;
        return $db->upsert($query);
    }

    function forceDelete($id) {
        global $db;
        $sql = "DELETE FROM `" . $this->getTable() . "`  WHERE " . $this->getPrimaryColumn() . "=" . $id;
        $db->sql($sql);
    }

    protected function getModelKeyValues($model) {
        global $db;
        $props = get_class_vars(get_class($model));
        $i = 0;
        $values = array();
        foreach ($props as $prop => $value) {
            if ($prop != "table" && $prop != "primaryColumn" && $prop != $this->primaryColumn) {
                $type = gettype($model->$prop);
                if ($model->$prop != "") {

                    $val = ($type == "string") ? "'" . mysqli_real_escape_string($db->connid, $model->$prop) . "'" : $model->$prop;

                    $values[$i] = $prop . "=" . $val;

                    $i++;
                }
            }
        }
        return join(", ", $values);
    }

    protected function getModelValues($model) {
        global $db;


        $props = get_class_vars(get_class($model));
        $i = 0;
        $values = array();

        foreach ($props as $prop => $value) {
            if ($prop != "table" && $prop != "primaryColumn" && $prop != $this->primaryColumn) {
                $type = gettype($model->$prop);
                if ($model->$prop != "") {

                    $val = ($type == "string") ? "'" . mysqli_real_escape_string($db->connid, $model->$prop) . "'" : $model->$prop;

                    $values[$i] = $val;

                    $i++;
                }
            }
        }

        return join(", ", $values);
    }

    protected function getModelKeys($model) {



        $props = get_class_vars(get_class($model));


        $i = 0;
        $keys = array();
        foreach ($props as $prop => $value) {

            if ($prop != "table" && $prop != "primaryColumn" && $prop != $this->primaryColumn) {

                /* @var $prop type */
                if ($model->$prop != "") {

                    $keys[$i] = $prop;
                    $i++;
                }
            }
        }

        return join(", ", $keys);
    }

    function getFields() {

        $columns = $this->selectQueryAsArray("SHOW COLUMNS FROM " . $this->table);

        $foreign = $this->selectQueryAsArray("SELECT column_name AS 'foreign_col', referenced_table_name AS 'ref_table', referenced_column_name AS 'ref_col' FROM information_schema.key_column_usage WHERE table_name = '" . $this->table . "' AND referenced_table_name IS NOT NULL");


        $data = array();
        $i = 0;


        foreach ($columns as $key => $value) {

            foreach ($value as $k => $v) {

                if ($k == "Field") {
                    $data[$i]["field"] = $v;

                    $key = $this->recursive_array_search($v, $foreign);

                    if (intval($key) >= 0) {

                        $data[$i]["ref_col"] = $foreign[$key]["ref_col"];

                        $data[$i]["ref_table"] = $foreign[$key]["ref_table"];
                    }
                }

                if ($k == "Type") {
                    if ($v == "int(11)") {
                        $data[$i]["type"] = "DropDown";
                    } else if (strpos($v, "enum") !== false) {
                        $data[$i]["type"] = "Enum";
                    } else {
                        $data[$i]["type"] = $v;
                    }
                }

                if ($k == "Extra" && $v == "auto_increment") {
                    $data[$i]["field"] = "ID";
                }
            }
            $i++;
        }

        return $data;
    }

    function recursive_array_search($needle, $haystack) {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value OR ( is_array($value) && $this->recursive_array_search($needle, $value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }

    function getEnumValues($field) {

        $columns = $this->selectQueryAsArray("SHOW COLUMNS FROM " . $this->table . " WHERE Field = '{$field}'");

        foreach ($columns as $key => $value) {

            foreach ($value as $k => $v) {


                if ($k == "Type") {
                    preg_match('/^enum\((.*)\)$/', $v, $matches);
                    foreach (explode(',', $matches[1]) as $value) {
                        $enum[] = trim($value, "'");
                    }
                }
            }
        }
        return $enum;
    }

    function xss_clean($input) {

/// Prevents XXS Attacks www.itshacked.com
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $inputx = preg_replace($search, '', $input);
        $inputx = trim($inputx);
        $strip_tags = trim($inputx);
        $inputx = htmlspecialchars($inputx, ENT_QUOTES, 'UTF-8');



        return $inputx;
    }

}

?>
