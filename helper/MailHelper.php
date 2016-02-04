<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailHelper
 *
 * @author ralph.klepper
 */
class MailHelper {
/**
 * builds email from Templates
 * @param void
 * @return string - html-email
 */
	
    function buildEmail ($mail, $daten ) {
        $url = "http://".$_SERVER["SERVER_NAME"].$GLOBALS['BASEPATH'];
        $url = str_replace("\\","",$url);

        $template = $mail.".html";

        //Parser initialisieren 
        $tpl = new TemplateParser("/templates/mail"); 

        //Template hinzufügen
        $tpl->newFile($template);

        //Platzhalter hinzufügen (Platzhaltername, WERT)
        foreach ($daten as $key => $value) {
                $tpl->addPlHo(strtoupper($key),$daten[$key]);
        }

        $tpl->addPlHo("URL",$url);

        //Template parsen und ausgeben
        $output = $tpl->parseTemplate(); 

        return $output;
    }

    function sendEmail ($to, $subject, $HTML) {

        $mail = new nomad_mimemail();
        $mail->set_from(FROM_MAIL,FROM_NAME);
        $mail->set_to($to);
        $mail->set_bcc(BCC);
        $mail->set_subject($subject);
        $mail->set_charset('UTF-8');
        $mail->set_html($HTML);
//		$mail->add_attachment("pic/mail-logo.gif", "mail-logo.gif");
//		$mail->add_attachment("pic/image002.jpg", "image002.jpg");

        $result = $mail->send();

        return $result;
    }

    function sendEmailAndAttachments ($to, $subject, $HTML, $text, $file, $filename) {

        $mail = new nomad_mimemail();
        $mail->set_from(FROM_MAIL,FROM_NAME);
        $mail->set_to($to);
        $mail->set_bcc(BCC);
        $mail->set_subject($subject);
        $mail->set_text($text);
        $mail->set_html($HTML);
        $mail->set_charset("UTF-8");
        $mail->add_attachment($file, $filename);

        $result = $mail->send();

        return $result;
    }
}
