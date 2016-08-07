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
    private $_baseUrl = "https://api.airtable.com/v0/appJEZiHXN7M2csbj/";

    function AirTable() {
        $this->_authKey = getAuthKey();
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

    function getScenes(){
        $ch = $this->InitMessage();
        curl_setopt($ch, CURLOPT_URL, $this->_baseUrl . "Scenes?maxRecords=1000&view=Web");
        echo $this->_baseUrl . "Scenes.<br/>";
        curl_setopt($ch, CURLOPT_POST, false);
        $o = curl_exec($ch);
        curl_close($ch);
        return json_decode($o, true);
    }
}