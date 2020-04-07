<?php

namespace App\JsonRpc;

use Illuminate\Support\Str;

/**
 * Class Client
 * @package App\JsonRpc
 */
class Client
{
    const VERSION = '2.0';

    protected $url;

    protected $token;

    private $method;

    private $params;

    public function __construct(string $url, string $token = '')
    {
        $this->url = $url;

        if(!empty($token)) {
            $this->token = $token;
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return Response
     * @throws \Exception
     */
    public function __call(string $name, array $arguments = [])
    {
        $this->method = Str::snake('api_' . $name);
        $this->params = count($arguments) == 1 && is_array($arguments[0]) ? $arguments[0] : $arguments;

        return $this->_curl();
    }

    /**
     * @return Response
     * @throws \Exception
     */
    private function _curl()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'method' => $this->method,
            'params' => $this->params,
            'id' => microtime(),
            'jsonrpc' => self::VERSION
        ]));

        if(!is_null($this->token)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-Tochka-Access-Key: ' . $this->token]);
        }

        $result = curl_exec($curl);

        curl_close($curl);

        return new Response($result);
    }
}
