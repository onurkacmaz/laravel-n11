<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface TicketInterface
{
    /**
     * @var string
     */
    public const END_POINT = "TicketService.wsdl";
    /**
     * @param int $sellerId
     * @param int $startValue
     * @param int $pageSize
     * @return object
     */
    public function ticketListingAssignedToSeller(int $sellerId, int $startValue = 1, int $pageSize = 1): object;

    /**
     * @param int $sellerId
     * @param int $startValue
     * @param int $pageSize
     * @return object
     */
    public function ticketListingBelongsToSeller(int $sellerId, int $startValue = 1, int $pageSize = 1): object;

    /**
     * @param int $sellerId
     * @param int $ticketId
     * @param string $content
     * @return object
     */
    public function ticketAnswer(int $sellerId, int $ticketId, string $content): object;

    /**
     * @param int $reasonId
     * @param int $sellerId
     * @param string $header
     * @param string $content
     * @return object
     */
    public function create(int $reasonId, int $sellerId, string $header, string $content): object;

    /**
     * @return object
     */
    public function ticketReasons(): object;

    /**
     * @param int $ticketId
     * @param int $sellerId
     * @return object
     */
    public function markAsRead(int $ticketId, int $sellerId): object;
}
