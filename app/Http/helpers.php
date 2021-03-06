<?php

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

if (!function_exists('dateBr2Sql')) {
    function dateBr2Sql($date)
    {
        if(empty($date)){
            return false;
        }

        $formatInput = 'd/m/Y';
        $formatOutput = 'Y-m-d';
        if(substr_count($date,':') == 2){
            $formatInput = 'd/m/Y H:i:s';
            $formatOutput = 'Y-m-d H:i:s';
        }

        $prepareDate = DateTime::createFromFormat($formatInput, $date);
        return $prepareDate->format($formatOutput);
    }
}

if (!function_exists('dateSql2Br')) {
    function dateSql2Br($date)
    {
        if(empty($date)){
            return false;
        }

        $formatInput = 'Y-m-d';
        $formatOutput = 'd/m/Y';
        if(substr_count($date,':') == 2){
            $formatInput = 'Y-m-d H:i:s';
            $formatOutput = 'd/m/Y H:i:s';
        }

        $prepareDate = DateTime::createFromFormat($formatInput, $date);
        return $prepareDate->format($formatOutput);
    }
}

if (!function_exists('currencyBrl2Float')) {
    function currencyBrl2Float($value) : float
    {
        return (float) str_replace(",", ".", str_replace(".", "", $value));
    }
}

if (!function_exists('currencyFloat2Brl')) {
    function currencyFloat2Brl($value) : string
    {
        return 'R$' .  number_format($value, 2, ",", ".");
    }
}

if (!function_exists('valueInCents')) {
    function valueInCents($value)
    {
        if (strlen($value) == 2) {
            return preg_replace('/\D/', '', $value . '00');
        }

        return preg_replace('/\D/', '', $value);
    }
}

if (!function_exists('getOnlyNumber')) {
    function getOnlyNumber($value)
    {
        return preg_replace('/\D/', '', $value);
    }
}

if (!function_exists('getOnlyPhone')) {
    function getOnlyPhone($value)
    {
        return preg_replace('/^([0-9]{2})/', '', getOnlyNumber($value));
    }
}

if (!function_exists('getOnlyDdd')) {
    function getOnlyDdd($value)
    {
        return preg_replace('/^([0-9]{2}).*/', '$1', getOnlyNumber($value));
    }
}

if (!function_exists('removeAccents')) {
    function removeAccents($value)
    {
        return preg_replace(array("/(??|??|??|??|??)/","/(??|??|??|??|??)/","/(??|??|??|??)/","/(??|??|??|??)/","/(??|??|??|??)/","/(??|??|??|??)/","/(??|??|??|??|??)/","/(??|??|??|??|??)/","/(??|??|??|??)/","/(??|??|??|??)/","/(??)/","/(??)/"),explode(" ","a A e E i I o O u U n N"), $value);
    }
}
if (!function_exists('removeSpecial')) {
    function removeSpecial($value)
    {
        return preg_replace('/[^a-z0-9]/i', ' ', removeAccents($value));
    }
}


if (!function_exists('getTime')) {
    function getTime($value):string{
        return preg_replace('/([0-9]{2}:[0-9]{2}):[0-9]{2}/', '$1', $value);
    }
}

if (!function_exists('site')) {
    function site($path = null, $parameters = [], $secure = null)
    {
        $url = url($path, $parameters, $secure);
        $url = preg_replace('/(.+?:\/\/)(.+?\.)(.*)/','$1$3', $url);

        return $url;
    }
}

if (!function_exists('getIdYoutube')) {
    function getIdYoutube($url)
    {
        return preg_replace('/.*(\/|\?v=)(.{11})([&|\/].*|)/', '$2', $url);
    }
}

if (!function_exists('maskCep')) {
    function maskCep($cep)
    {
        if (empty($cep)) {
            return '';
        }

        $mask = '#####-###';
        $cep = str_replace(' ', '', getOnlyNumber($cep));

        for ($i = 0; $i < strlen($cep); $i++) {
            $mask[strpos($mask, '#')] = $cep[$i];
        }

        return $mask;
    }
}

if (!function_exists('getFullFtpUrl')) {
    function getFullFtpUrl($path)
    {
        return config('filesystems.disks.ftp.url') . $path;
    }
}

function logTransactionData()
{
    $file_name = "./pagar_me_post_back_" . date('Y-m-d_H-i-s') . '.txt';
    $myfile = fopen($file_name, "a");
    ob_start();

    echo "POST\n";
    print_r(request()->post());

    $txt = ob_get_contents();
    ob_end_flush();

    fwrite($myfile, $txt);
    fclose($myfile);
}

function logTransactionError($txt)
{
    $file_name = "./ERROR_pagar_me_post_back_" . date('Y-m-d_H-i-s') . '.txt';
    $myfile = fopen($file_name, "a");
    fwrite($myfile, $txt);
    fclose($myfile);
}
