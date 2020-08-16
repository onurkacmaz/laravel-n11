<?php

namespace OnurKacmaz\LaravelN11;

use OnurKacmaz\LaravelN11\Exceptions\N11Exception;
use SoapClient;

class Service
{

    /**
     * @var array[]|null
     */
    protected static $_parameters = null;

    /**
     * @var string
     */
    protected static $_baseUrl = "https://api.n11.com/ws";

    /**
     * Service constructor.
     */
    public function __construct()
    {
        if (is_null($_ENV["API_KEY"]) && is_null($_ENV["API_SECRET"])) {
            {
                throw new N11Exception("API KEY and API SECRET cannot be null");
            }
        }
        self::$_parameters = ['auth' => ['appKey' => $_ENV["API_KEY"], 'appSecret' => $_ENV["API_SECRET"]]];
    }

    /**
     * @param string $endPoint
     * @return SoapClient
     */
    protected function setEndPoint(string $endPoint): SoapClient
    {
        return new SoapClient(self::$_baseUrl . $endPoint);
    }

}
