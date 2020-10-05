<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Interfaces\TicketInterface;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Ticket extends Service implements TicketInterface
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

    /**
     * @param int $sellerId
     * @param int $startValue
     * @param int $pageSize
     * @return object
     */
    public function ticketListingAssignedToSeller(int $sellerId, int $startValue = 1, int $pageSize = 1): object {
        $this->_parameters["sellerId"] = $sellerId;
        $this->_parameters["first"] = $startValue;
        $this->_parameters["pageSize"] = $pageSize;
        return $this->_client->TicketListingAssignedToSeller($this->_parameters);
    }

    /**
     * @param int $sellerId
     * @param int $startValue
     * @param int $pageSize
     * @return object
     */
    public function ticketListingBelongsToSeller(int $sellerId, int $startValue = 1, int $pageSize = 1): object {
        $this->_parameters["sellerId"] = $sellerId;
        $this->_parameters["first"] = $startValue;
        $this->_parameters["pageSize"] = $pageSize;
        return $this->_client->TicketListingBelongsToSeller($this->_parameters);
    }

    /**
     * @param int $sellerId
     * @param int $ticketId
     * @param string $content
     * @return object
     */
    public function ticketAnswer(int $sellerId, int $ticketId, string $content): object {
        $this->_parameters["sellerId"] = $sellerId;
        $this->_parameters["ticketId"] = $ticketId;
        $this->_parameters["content"] = $content;
        return $this->_client->TicketAnswer($this->_parameters);
    }

    /**
     * @param int $reasonId
     * @param int $sellerId
     * @param string $header
     * @param string $content
     * @return object
     */
    public function create(int $reasonId, int $sellerId, string $header, string $content): object {
        $this->_parameters["reasonId"] = $reasonId;
        $this->_parameters["sellerId"] = $sellerId;
        $this->_parameters["header"] = $header;
        $this->_parameters["content"] = $content;
        return $this->_client->TicketCreate($this->_parameters);
    }

    /**
     * @return object
     */
    public function ticketReasons(): object {
        return $this->_client->TicketReasons($this->_parameters);
    }

    /**
     * @param int $ticketId
     * @param int $sellerId
     * @return object
     */
    public function markAsRead(int $ticketId, int $sellerId): object {
        $this->_parameters["ticketId"] = $ticketId;
        $this->_parameters["sellerId"] = $sellerId;
        return $this->_client->TicketRead($this->_parameters);
    }

}
