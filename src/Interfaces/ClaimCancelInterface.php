<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface ClaimCancelInterface
{
    /**
     * @var string
     */
    public const END_POINT = "ClaimCancelService.wsdl";

    /**
     * @param array $data
     * @return object
     * @description Mağazaya gelen sipariş iptal taleplerini liste halinde yollayan servis. Her sayfada 20 iptal bilgisi gelir.
     */
    public function list(array $data): object;

    /**
     * @param int $claimCancelId
     * @param int $reasonId
     * @param string $note
     * @return object
     * @description İptal talebini reddetme servisi.
     */
    public function deny(int $claimCancelId, int $reasonId, string $note): object;

    /**
     * @return object
     * @descriptionRet sebeplerini listeleyen servis. İptal talebi ret servisinde (ClaimCancelDenyRequest) kullanılacaktır.
     */
    public function denyReasonTypes(): object;

    /**
     * @param int $claimCancelId
     * @return object
     * @description İptal talebini onaylama servisi.
     */
    public function approve(int $claimCancelId): object;
}
