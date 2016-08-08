<?php
/**
 * Created by PhpStorm.
 * User: Shawn Lavelle
 * Date: 8/7/2016
 * Time: 1:52 PM
 */

require_once("AirTableKey.php");

class AirTable
{
    private $_authKey = "";
    private $_baseUrl = "https://api.airtable.com/v0/";
    private $lastCall = Array();

    function AirTable() {
        $this->_authKey = getAuthKey();
        $this->_baseUrl .= getAppKey() . "/";
    }

    function InitMessage() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                "Authorization: Bearer " . $this->_authKey,
                "X-API-VERSION: 0.1.0",
                )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    function doWait() {
        if (count($this->lastCall) == 5) {
            sleep(1);
            $this->lastCall = array();
            rray_push($this->lastCall, time());
        }
    }

    function getAllScenes() {
        $offset = "";
        $scenes = array();
        do {
            $result = $this->getScenes($offset);

            if (isset($result['records']))
                foreach ($result['records'] as $s)
                    array_push($scenes, $s);

            if (isset($result['offset']))
                $offset = $result['offset'];

        } while(isset($result['offset']));
        return $scenes;
    }

    private function getScenes($offset = ""){
        $this->doWait();
        $ch = $this->InitMessage();
        $url = $this->_baseUrl . "Scenes?maxRecords=999&view=Web" . (($offset != "") ? "&offset=" . $offset : '');
        curl_setopt($ch, CURLOPT_URL, $url);
        echo $this->_baseUrl . "Scenes ($offset).<br/>";
        curl_setopt($ch, CURLOPT_POST, false);
        $o = curl_exec($ch);
        curl_close($ch);
        return json_decode($o, true);
    }
}