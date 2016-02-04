<?php


include_once $GLOBALS['ROOTPATH'] . '/includes/conf.inc.php';
class Database {

    var $connid;
    var $result;

    function Database() {
        
    }

    function select_db($db) {

        mysqli_query($this->connid, "set names 'utf8'");
        if (!mysqli_select_db($this->connid, $db)) {
            
        }
    }

    function sql($sql) {
        
        $this->connect();
        mysqli_query($this->connid, "set names 'utf8'");


        if (!$this->result = mysqli_query($this->connid, $sql)) {
                printf("Errormessage: %s\n", mysqli_error($this->connid));
            return -1;
        }


        return $this->result;
    }

    public function connect() {
        if (!$this->connid) {
            $this->connid = mysqli_connect(constant("HOST"), constant("USER"), constant("HASH"));
        }

        $this->select_db(constant("DATABASE"));
        return $this->connid;
    }

    function upsert($sql) {
        $this->connect();
        mysqli_query($this->connid, "set names 'utf8'");



        if (!$this->result = mysqli_query($this->connid, $sql) || mysqli_insert_id($this->connid) == -1) {
            $logsql = "INSERT INTO query_log (ts,query) VALUES(NOW(),'" . $sql . "')";
            mysqli_query($this->connid, $logsql);
			    printf($sql);
            return -1;
        }
        return mysqli_insert_id($this->connid);
    }

    public function escape($input) {
        if (!$this->connid) {
            $this->connect();
        }
        return mysqli_real_escape_string($this->connid, $input);
    }

}

?>