<?php

namespace Onurkacmaz\LaravelN11;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use SoapClient;

class Service
{

    /**
     * @var array[]|null
     */
    protected $_parameters = null;

    /**
     * @var string
     */
    protected $_baseUrl = "https://api.n11.com/ws";

    /**
     * Service constructor.
     */
    public function __construct()
    {
        if (is_null(env("N11_API_KEY")) && is_null(env("N11_API_SECRET"))) {
            {
                throw new N11Exception("API KEY and API SECRET cannot be null");
            }
        }
        $this->_parameters = ['auth' => ['appKey' => env("N11_API_KEY"), 'appSecret' => env("N11_API_SECRET")]];
    }

    /**
     * @param string $endPoint
     * @return SoapClient
     */
    protected function setEndPoint(string $endPoint): SoapClient
    {
        return new SoapClient($this->_baseUrl . $endPoint);
    }

}
