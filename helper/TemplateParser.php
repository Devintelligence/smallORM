<?php
#############################################################
#             PHP TemplateParser Klasse.
#   Umfang:
#      - Bearbeiten mehrerer Dateien ohne Neuinizialisierung der Klasse
#      - Hinzufügen einzelner Platzhalter
#      - Hinzufügen ganzer Platzhalterarrays
#      - Definieren von verschachtelten Blöcken.
#
#   Tutorials und Codebeispiele unter
#       http://www.tutorials.de/forum/php-tutorials/241271-templateparser-klasse-mit-verschachtelten-bloecken.html
#
#   Autor/Coder: Stefan Grubisic (fanste)
#   © 2006 Stefan Grubisic
#############################################################


#error_reporting(0);
class TemplateParser
{
    var $TemplatePlHo = array();
    var $CountTemplateFile = -1;
    var $openedTemplate = array();
    var $templatePath = '';
    var $templateFile = '';

	/*----------------------------------------
	| Konstruktor. Es kann der Pfad zu einem Haupttemplateordner angegeben werden.
	------------------------------------------*/
    function TemplateParser($templatePath = '')
    {
        $this->templatePath = $templatePath;
    }

    /*----------------------------------------
	| Hinzufügen eines neuen Templates
	| $filename (Pfad + ) Name des Templates
	------------------------------------------*/
    function newFile($filename)
    {
        $this->CountTemplateFile++;
        $this->TemplatePlHo[$this->CountTemplateFile] = array('.' => array());

        $this->templateFile = dirname($_SERVER['SCRIPT_FILENAME']).$this->templatePath.'/'.$filename;
        $this->openedTemplate[] = implode('',file($this->templateFile));

        return true;
    }

    /*----------------------------------------
	| Hinzufügen von Platzhaltern
	| $PlHoName = Platzhaltername
	| $PlHoValue = Ersetzungswert
	------------------------------------------*/
    function addPlHo($PlHoName, $PlHoValue)
    {
        $this->TemplatePlHo[$this->CountTemplateFile]["."][$PlHoName] = $PlHoValue;
    }

    /*----------------------------------------
	| Hinzufügen eines Platzhalterarrays
	| $array = Platzhalterarray
	|   Format:
	|      array("Platzhaltername1" => "Platzhalterwert1",
	|            "Platzhaltername2" => "Platzhalterwert2" )
	------------------------------------------*/
    function addPlHoArray($array)
    {
        foreach($array as $key => $value)
        {
            $this->TemplatePlHo[$this->CountTemplateFile]["."][$key] = $value;
        }
    }

	/*----------------------------------------
	| Hinzufügen verschachtelter Blöcke
	| $blockname = Name(n) des/der Blockes/Blöcke
	|   Format: 1. Blockname: Blockname1
	|           2. und weitere Blocknamen durch Punkt anhängen: Blockname1.Blockname2.Blockname3
	------------------------------------------*/
    function addBlockPlHo($blockname, $array)
    {
            if (strstr($blockname, '.'))
            {
                $blocks = explode('.', $blockname);
                $blockcount = sizeof($blocks) - 1;
                $str = '$this->TemplatePlHo[$this->CountTemplateFile]';
                for ($i = 0; $i < $blockcount; $i++)
                {
                    $str .= '[\'' . $blocks[$i] . '.\']';
                    eval('$lastkey = sizeof(' . $str . ') - 1;');
                    $str .= '[' . $lastkey . ']';
                }
                $str .= '[\'' . $blocks[$blockcount] . '.\'][] = $array;';

                eval($str);
            }
            else
            {
                $this->TemplatePlHo[$this->CountTemplateFile][$blockname . '.'][] = $array;
            }

            return true;
    }

	/*----------------------------------------
	| Überprüfen, ob der übergebene $key einen Punkt enthält. Wenn nicht, einen anhängen.
	------------------------------------------*/
    function createKey($key)
    {
        if(strstr($key,'.'))
        {
            return $key;
        }
        else
        {
            return $key.".";
        }
    }

	/*----------------------------------------
	| Ersetzten der verschachtelten Blöcke.
	| $blockname = Name des Blocken, bzw Platzhalterarray
	| $blockcode = Templatecode, der zum aktuellen Block gehört
	| $fileNum = In dieser Templatedatei befinden wir uns gerade.
	------------------------------------------*/
    function blockReplace($blockname, $blockcode, $fileNum)
    {
        $blockcode_copy = $blockcode;
        $data = "";

        if(substr(stripslashes($blockname),0,11) == "serialized:")
        {
            $blockNum = unserialize(stripslashes(substr($blockname,11)));
        }
        elseif(array_key_exists($this->createKey($blockname),$this->TemplatePlHo[$fileNum]))
        {
            $blockNum = $this->TemplatePlHo[$fileNum][$this->createKey($blockname)];
        }
        else
        {
            $blockNum = 'NONE';
        }


        if($blockNum != 'NONE')
        {

            for($i=0;$i<count($blockNum);$i++)
            {
                $blockcode = $blockcode_copy;
                foreach($blockNum[$i] as $key => $value)
                {
                    if(is_array($value) && strstr($key,'.'))
                    {
                        $key = substr($key,0,-1);
                        $dimensions = addslashes('serialized:'.serialize($blockNum[$i][$this->createKey($key)]));

                        $blockcode = preg_replace("#<!-- BEGIN ".$key." -->(.*)<!-- END ".$key." -->#Ueis","\$this->blockReplace('$dimensions', '$1', $fileNum)",$blockcode);
                    }
                    else
                    {
                        $blockcode = preg_replace("#{[[:space:]]*?(".$key."){1,}?[[:space:]]*?}#", $value, $blockcode);
                    }
                }
                $data .= $blockcode;

            }
            return $data;
        }
        else
        {
            return /*$blockcode*/'';
        }
    }

	/*----------------------------------------
	| Aufruf des Ersetzungsvorganges.
	| Keine Parameter
	------------------------------------------*/
    function parseTemplate()
    {
        for($tmpFile=0;$tmpFile<count($this->openedTemplate);$tmpFile++)
        {
            $this->openedTemplate[$tmpFile] = preg_replace("#<!-- BEGIN (.*) -->(.*)<!-- END \\1 -->#Uis","\$this->blockReplace('$1','$2', $tmpFile)",$this->openedTemplate[$tmpFile]);
            $i = 0;
            foreach($this->TemplatePlHo[$tmpFile]['.'] as $key => $value)
            {
                $this->openedTemplate[$tmpFile] = preg_replace("#{[[:space:]]*?(".$key."){1,}?[[:space:]]*?}#", $value, $this->openedTemplate[$tmpFile]);
            }
        }

        return $this->outputParsedPage();
        exit;
    }

	/*----------------------------------------
	| Ausgabe aller Platzhalter, Templatedateien, usw
	| Keine Parameter
	------------------------------------------*/
    function print_out()
    {
        echo nl2br(print_r($this,false));
    }

	/*----------------------------------------
	| Löscht alle \ vor " und '
	| Keine Parameter
	------------------------------------------*/
    function outputParsedPage()
    {
        $code = implode("",$this->openedTemplate);
        $code = preg_replace("#(\\\){1,}(\"|')#Uis","$2",$code);
        return $code;
    }
}
?>
