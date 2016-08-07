<?php
/**
 * Created by PhpStorm.
 * User: Shawn Lavelle
 * Date: 8/7/2016
 * Time: 1:52 PM
 */

namespace at;
global $authKey;
require_once("AirTableKey.php");

class AirTable
{
    private $_authKey;
    private $_baseUrl = "https://api.airtable.com/v0/";

    function AirTable() {
        $this->_authKey = getAuthKey();
        $this->_baseUrl .= $this->_authKey;
    }

    function InitMessage() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Authorization'=>"Bearer " . $this-$this->_authKey,
                "X-API-VERSION"=> "0.1.0",
                )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    function getScenes(){
        $ch = $this->InitMessage();
        curl_setopt($ch, CURLOPT_URL, $this->_baseUrl . "/Scene%20Submissions");
        curl_setopt($ch, CURLOPT_POST, false);
        $o = curl_exec($ch);
        curl_close($ch);
        return json_decode($o, true);
    }
}