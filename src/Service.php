<?php

namespace Onurkacmaz\LaravelN11;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use SoapClient;

class Service
{

    /**
     * @var int
     */
    public const GENERAL_LIMIT = 100;

    /**
     * @var array[]|null
     */
    protected $_parameters = null;

    /**
     * @var string
     */
    private $_baseUrl = "https://api.n11.com/ws";

    /**
     * Service constructor.
     * @throws N11Exception
     */
    public function __construct()
    {
        if (is_null(config("laravel-n11.api_key")) || is_null(config("laravel-n11.api_secret"))) {
            {
                throw new N11Exception("API KEY or API SECRET cannot be null");
            }
        }
        $this->_parameters = ['auth' => ['appKey' => config("laravel-n11.api_key"), 'appSecret' => config("laravel-n11.api_secret")]];
    }

    /**
     * @param string $endPoint
     * @return SoapClient
     * @throws \SoapFault
     */
    protected function setEndPoint(string $endPoint): SoapClient
    {
        return new SoapClient($this->_baseUrl . "/" . $endPoint);
    }

}
