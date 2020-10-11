<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\ClaimCancelInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class ClaimCancel extends Service implements ClaimCancelInterface
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * Category constructor
     * endPoint set edildi.
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint(self::END_POINT);
    }

    public function list(array $data): object {
        $this->_parameters["searchData"] = $data;
        return $this->_client->ClaimCancelList($this->_parameters);
    }

    public function deny(int $claimCancelId, int $reasonId, string $note): object {
        $this->_parameters["claimCancelId"] = $claimCancelId;
        $this->_parameters["denyReasonId"] = $reasonId;
        $this->_parameters["denyReasonNote"] = $note;
        return $this->_client->ClaimCancelDeny($this->_parameters);
    }

    public function denyReasonTypes(): object {
        $this->_client->ClaimCancelDenyReasonType($this->_parameters);
    }

    public function approve(int $claimCancelId): object {
        $this->_parameters["claimCancelId"] = $claimCancelId;
        $this->_client->ClaimCancelApprove($this->_parameters);
    }

}
