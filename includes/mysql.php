<?php

class Database {

    var $connid;
    var $erg;

    function Database($host, $user, $passwort) {
        if (!$this->connid = mysqli_connect($host, $user, $passwort)) {
          
        }
        return $this->connid;
    }

    function select_db($db) {
        mysqli_query($this->connid, "set names 'utf8'");
        if (!mysqli_select_db($this->connid, $db)) {
           
        }
    }
   
    function sql($sql) {
        mysqli_query($this->connid, "set names 'utf8'");
		$pos = strrpos($sql, "--");
		
if ($pos === false) {
        if (!$this->erg = mysqli_query($this->connid, $sql)) {
            //echo "Fehler beim Senden der Abfrage...";

            return -1;
        }


        return $this->erg;
		}
    }

    function upsert($sql) {

        mysqli_query($this->connid, "set names 'utf8'");
			$pos = strrpos($sql, "--");

if ($pos === false) {

        if (!$this->erg = mysqli_query($this->connid, $sql)) {
         
            return -1;
        }
        return mysqli_insert_id($this->connid);
		}
    }

}

?>