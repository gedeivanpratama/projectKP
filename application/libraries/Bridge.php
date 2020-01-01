<?php

class Bridge
{
    public static function post($url,$data = [])
    {
        $curl = curl_init($url);

        $dataToJson = json_encode($data);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataToJson);

        curl_setopt($curl, CURLOPT_HTTPHEADER,['Content-Type:application/json']);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        return $result;
        
        curl_close($curl);
        // return $dataToJson;
    }

    public static function get($url)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}