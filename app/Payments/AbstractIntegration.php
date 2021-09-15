<?php

namespace Payments;

use Exception;

abstract class AbstractIntegration
{
    private $params = [];
    private $method;
    private $token;

    protected function get()
    {
        $this->method = 'GET';

        return $this;
    }

    protected function post()
    {
        $this->method = 'POST';

        return $this;
    }

    protected function getMethod()
    {
        if (empty($this->method)) {
            throw new Exception('Método HTTP inválido.');
        }

        return $this->method;
    }

    protected function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    protected function addParam($key, $value)
    {
        if (empty($value)) {
            return null;
        }

        $this->params[] = "$key=$value";

        return $this;
    }

    protected function addParams(array $params)
    {
        if (empty($params)) {
            return null;
        }

        foreach ($params as $key => $param) {
            $this->params[] = "$key=$param";
        }

        return $this;
    }

    protected function getParams()
    {
        if (empty($this->params)) {
            return null;
        }

        return '?_=&' . implode('&', $this->params);        
    }

    protected function execute($path)
    {
        $method = $this->getMethod();
        if ($method == 'GET') {
            $path .= $this->getParams();
        }

        $requestUrl = config('northintegration.api_base_url') . $path;

        $header = ['Content-Type: application/x-www-form-urlencoded'];
        if (!empty($this->token)) {
            $header[] = "Authorization: Bearer $this->token";
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $requestUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $this->getParams(),
            CURLOPT_HTTPHEADER => $header,
        ]);

        $response = curl_exec($curl);
        $requestInfo = curl_getinfo($curl);
        curl_close($curl);

        $status = $requestInfo['http_code'];
        if (!in_array($status, [200, 201])) {
            throw new Exception('Erro na requisição.', $status);
        }

        return json_decode($response);
    }
}
