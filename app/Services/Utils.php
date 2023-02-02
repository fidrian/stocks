<?php

namespace App\Services;

use Pressutto\LaravelSlack\Facades\Slack;

class Utils
{
    public static function formatMobile($mobile) {
        if(strpos($mobile, '0') !== false) {
            $mobile =  substr_replace($mobile, '62', 0, 1);
        }

       return $mobile;
    }

    // Get current date
    // Ex: 2022-12-31
    public static function getCurrentDate()
    {
        $delivery_date = date("Y-m-d");

        return $delivery_date;
    }

    // Get current time
    // Ex: 06:30:59
    public static function getCurrentTime()
    {
        $delivery_time = date("h:m");

        return $delivery_time;
    }

    // Get current datetime
    // Ex: 2022-12-31 06:30:59
    public static function getCurrentDateTime()
    {
        $delivery_date = date("Y-m-d");
        $delivery_time = date("h:m");

        return $delivery_date . " " . $delivery_time;
    }

    // Date format
    // Ex: 2022-12-31 06:30:59
    public static function dateFormat($date)
    {
        $dateCreate = date_create($date);
        $dateFormat = date_format($dateCreate, 'Y-m-d H:i:s');

        return $dateFormat;
    }

    // Check JSON if valid then return it
    // If not return null
    public static function isJson($json)
    {
        $json_decode = json_decode($json);

        if (json_last_error() === JSON_ERROR_NONE)
            return $json_decode;

        return null;
    }

    // Get courier code from order-kurir
    public static function getCourierCode($courier)
    {
        $courierExplode = explode("__", $courier);
        // $courierName = strtolower($courierNameExplode[0]);

        // if ($courierName == "custom") {
        //     $courierName = strtolower($courierNameExplode[1]);
        // }

        foreach($courierExplode as $c) {
            $c = strtolower($c);

            switch($c) {
                case "jalur nugraha ekakurir (jne)":
                case "jne":
                case "jne - reg":
                case "jne - oke":
                    $courierCode = "jne";
                    break;
                case "j&t express":
                case "j&t":
                case "jnt":
                    $courierCode = "jnt";
                    break;
                case "lion parcel":
                case "lion":
                case "freeongkir - lion parcel":
                case "lion parcel - cod":
                case "lion parcel one pack":
                case "lionparcel":
                    $courierCode = "lion";
                    break;
                case "citra van titipan kilat (tiki)":
                case "tiki":
                    $courierCode = "tiki";
                    break;
                case "sicepat express":
                case "sicepat":
                    $courierCode = "sicepat";
                    break;
                case "anteraja":
                    $courierCode = "anteraja";
                    break;
                case "gojek":
                case "gosend":
                case "gosend express":
                case "gojek instant":
                case "gosend (sameday)":
                case "gosend sameday":
                case "gosend di pesankan customer":
                    $courierCode = "gojek";
                    break;
                case "grab":
                case "grab sameday":
                case "grab instant":
                    $courierCode = "grab";
                    break;
                case "ninja express":     
                case "ninja":
                    $courierCode = "ninja";
                    break;
                case "jet express":
                    $courierCode = "jet";
                    break;
            }
        }

        return $courierCode;
    }

    // Get courier type from order-kurir
    public static function getCourierType($courier)
    {
        $courierExplode = explode("__", $courier);

        // JNE__9000__Layanan reguler__9.000
        // if (count($courierTypeExplode) == 4) {
        //     $courierType = strtolower($courierTypeExplode[2]);
        // } else {
        //     $courierType = strtolower($courierTypeExplode[1]);
        // }

        // Find anything contains courier type
        foreach($courierExplode as $ct) {
            $ct = strtolower($ct);

            switch ($ct) {
                // case "layanan reguler":
                case "reg":
                case "jne":
                case "jne_reg":
                case "jne reg":
                    $courierType = "reg";
                    break;
                case "oke":
                case "ongkos kirim ekonomis":
                case "ongkos_kirim_ekonomis":
                    $courierType = "oke";
                    break;
                case "jne yes":
                case "jne_yes":
                case "yes":
                case "yakin esok sampai":
                case "yakin_esok_sampai":
                    $courierType = "yes";
                    break;
                case "gosend":
                case "gosend instant":
                case "gosend_instant":
                case "grab":
                case "gojek":
                case "instant":
                    $courierType = "instant";
                    break;
                case "same_day":
                case "same day":
                case "same day service. available from 08:00 to 15:00.":
                    $courierType = "same_day";
                    break;
                case "instant_car":
                case "instant car":
                    $courierType = "instant_car";
                    break;
                case "ctc":
                case "jne city courier":
                case "jne_city_courier":
                    $courierType = "ctc";
                    break;
                case "j&t":
                case "jnt":
                case "ez":
                    $courierType = "ez";
                    break;
                case "reg_pack":
                case "regpack":
                case "reg pack":
                    $courierType = "reg_pack";
                    break;
                case "jago_pack":
                case "jagopack":
                case "jago pack":
                case "layanan pengiriman standard":
                    $courierType = "jago_pack";
                    break;
                case "one_pack":
                case "onepack":
                case "one pack":
                case "one day service":
                case "one_day_service":
                case "layanan besok sampai":
                case "layanan_besok_sampai":
                    $courierType = "one_pack";
                    break;
                case "best":
                case "besok sampai tujuan":
                case "besok_sampai_tujuan":
                    $courierType = "best";
                    break;
                case "next day":
                case "next_day":
                    $courierType = "next_day";
                    break;
                case "standard":
                    $courierType = "standard";
                    break;                    
             }
        }

        // dd($courierType);

        return $courierType;
    }

    // Get courier type from order-kurir
    public static function getCourierTypeName($courierType)
    {
        $courierTypeName = $courierType;
        $courierTypeName = strtolower($courierTypeName);

        switch ($courierTypeName) {
            case "layanan reguler":
            case "reg":
            case "reguler":
            case "layanan pengiriman dokumen":
            case "layanan pengiriman standard":
            case "layanan standard":
            case "jnt":
            case "lion parcel":
            case "lion_parcel":
                $courierTypeName = "REG";
                break;
            case "yakin esok sampai":
            case "yes":
                $courierTypeName = "YES";
                break;
            case "ctc":
            case "jne city courier":
            case "jne_city_courier":
                $courierTypeName = "CTC";
                break;
            case "ez":
            case "regular service":
            case "regular_service":
                $courierTypeName = "EZ";
                break;
            case "regpack":
            case "reg pack":
            case "reg_pack":
                $courierTypeName = "REGPACK";
                break;
            case "layanan besok sampai":
                $courierTypeName = "ONEPACK";
                break;
            case "instant":
                $courierTypeName = "INSTANT";
                break;
            case "instant_car":
            case "instant car":
                $courierTypeName = "INSTANT CAR";
                break;
            case "same_day":
            case "same day":
                $courierTypeName = "SAME DAY";
                break;
        }

        return $courierTypeName;
    }

    // Get courier name from courier code
    public static function getCourierName($courierCode)
    {
        switch($courierCode) {
            case "jne":
                $courierName = "Jalur Nugraha Ekakurir (JNE)";
                break;
            case "jnt":
                $courierName = "J&T Express";
                break;
            case "lion":
                $courierName = "Lion Parcel";
                break;
            case "tiki":
                $courierName = "Citra Van Titipan Kilat (TIKI)";
                break;
            case "sicepat":
                $courierName = "SiCepat Express";
                break;
            case "anteraja":
                $courierName = "AnterAja";
                break;
            case "gojek":
                $courierName = "GOJEK";
                break;
            case "grab":
                $courierName = "GRAB";
                break;
            case "ninja":
                $courierName = "ninja";
                break;
            case "jet":
                $courierName = "JET Express";
                break;
            default:
                $courierName = null;
                break;
        }

        return $courierName;
    }

    // Get courier short name from courier code
    public static function getCourierShortName($courierCode)
    {
        switch($courierCode) {
            case "jne":
                $courierName = "JNE Express";
                break;
            case "jnt":
                $courierName = "J&T Express";
                break;
            case "lion":
                $courierName = "Lion Parcel";
                break;
            case "tiki":
                $courierName = "TIKI";
                break;
            case "sicepat":
                $courierName = "SiCepat Express";
                break;
            case "anteraja":
                $courierName = "AnterAja";
                break;
            case "gojek":
                $courierName = "GOSEND";
                break;
            case "grab":
                $courierName = "GRAB";
                break;
            case "ninja":
                $courierName = "ninja";
                break;
            case "jet":
                $courierName = "JET Express";
                break;
            default:
                $courierName = null;
                break;
        }

        return $courierName;
    }

    // Get courier logo from courier code
    public static function getCourierLogo($courierCode)
    {
        switch($courierCode) {
            case "jne":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/JNE_16x9.png";
                break;
            case "jnt":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/JNT%20Express_16x9.png";
                break;
            case "lion":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Lion%20Parcel_16x9.png";
                break;
            case "tiki":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Tiki_16x9.png";
                break;
            case "sicepat":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Si%20Cepat%20Express_16x9.png";
                break;
            case "anteraja":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Anter%20Aja_16x9.png";
                break;
            case "gojek":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Gosend_16x9.png";
                break;
            case "grab":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Grab%20Express_16x9.png";
                break;
            case "ninja":
                $courierLogo = "https://storage.googleapis.com/kasual/courier-logo/Ninja%20Xpress_16x9.png";
                break;
            case "jet":
                $courierLogo = "";
                break;
            default:
                $courierLogo = "";
                break;
        }

        return $courierLogo;
    }

    // Send Slack notification
    public static function sendSlack(
        $url,
        $channel,
        $notification
    ) {
        // Setup slack notification
        $test = "";

        if (env("APP_STATUS") == "staging") {
            $test = "[Test]\n";

            $channel .= "-test";

            $url .= "_TEST";
        }

        $url = env($url);

        // Notification
        $notification = "```" .
            $test .
            $notification .
            "```";

        // Send Slack notification
        Slack::to($channel)
        ->webhook($url)
        ->send($notification);
    }

    // Get grams in kilo
    public function gramToKilo($grams)
    {
        $ratio = 1000;

        return $grams / $ratio;
    }

    /**
     * Validates a given latitude $lat
     *
     * @param float|int|string $lat Latitude
     * @return bool `true` if $lat is valid, `false` if not
     */
    function validateLatitude($lat) {
        return preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $lat);
    }

    /**
     * Validates a given longitude $long
     *
     * @param float|int|string $long Longitude
     * @return bool `true` if $long is valid, `false` if not
     */
    function validateLongitude($long) {
        return preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $long);
    }

    /**
     * Validates a given coordinate
     *
     * @param float|int|string $lat Latitude
     * @param float|int|string $long Longitude
     * @return bool `true` if the coordinate is valid, `false` if not
     */
    function validateLatLong($lat, $long) {
        return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $lat.','.$long);
    }
}
