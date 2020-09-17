<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface OrderInterface
{

    /**
     * @var string
     */
    public const OUT_OF_STOCK = "OUT_OF_STOCK";

    /**
     * @var string
     */
    public const OTHER = "OTHER";

    /**
     * @param array $searchData
     * @return object
     * @description Verilen arama kriterlerine göre sipariş bilgisi ile beraber sipariş maddelerini de listelemek için kullanılır.
     */
    public function getOrderDetail(array $searchData = []): object;

    /**
     * @param array $searchData
     * @return object
     * @description Bu metot sipariş ile ilgili özet bilgileri listelemek için kullanılır.
     */
    public function getOrders(array $searchData = []): object;

    /**
     * @param int $orderId
     * @return object
     * @description Sipariş N11 ID bilgisi kullanarak sipariş detaylarını almak için kullanılır, sipariş N11 ID bilgisine OrderService OrderList veya DetailedOrderList metotlarıyla ulaşılabilir.
     * n11 platform üzerinden kargo ücretinin ödenmesi ve bunun tahsilat bilgileri “serviceItemList” alanından ulaşılabilir.
     */
    public function orderDetail(int $orderId): object;

    /**
     * @param int $orderId
     * @param int $numberOfPackages
     * @return object
     * @description Sistemde mağazadan kaç adet paket geleceğini görmek isteyen kargo firmaları için NumberofPackage (Paket Sayısı) alanı tanımlanmıştır.
     * NumberofPackage alanına izin verilen kargo firmaları ile gönderim sağlayan mağazalar, sipariş onaylanırken kaç adet paket çıkışı yapacağına dair adet girmesi gerekmektedir.
     * Mağazanın gireceği adet sayısına göre kargo firması tarafımıza barkod gönderimi sağlayacaktır.
     * ,Mevcut sistemde NumberofPackage kullanmayacak kargo firmaları ile sipariş gönderen mağazalar bu alanı boş gönderebileceklerdir.
     *
     * Sipariş maddesinin n11 ID si kullanılarak kabul edilmesi için kullanılır.
     * Kabul edilen sipariş daha sonra mağaza tarafından reddedilemez.
     * Sipariş n11 ID sine OrderService içinden OrderDetail veya DetailedOrderList metodu kullanılarak erişilir.
     */
    public function orderItemAccept(int $orderId, int $numberOfPackages): object;

    /**
     * @param int $orderId
     * @param string $rejectReason
     * @param string $rejectReasonType
     * @return object
     * @description Sipariş maddesinin n11 ID si kullanılarak reddedilmesi için kullanılır.
     * Reddedilen sipariş daha sonra mağaza tarafından kabul edilemez.
     * Sipariş n11 ID sine OrderService içinden OrderDetail veya DetailedOrderList metodu kullanılarak erişilir.
     */
    public function orderItemReject(int $orderId, string $rejectReason, string $rejectReasonType = self::OUT_OF_STOCK): object;

    /**
     * @param int $orderId
     * @return object
     * @description Sipariş maddesinin n11 ID si kullanılarak kargoya verilmesi için kullanılır.
     * Sipariş n11 ID sine OrderService içinden OrderDetail veya DetailedOrderList metodu kullanılarak erişilir.
     * Ön koşul olarak güncelleme yapılmak istenen sipariş maddesinin durumunun (OrderItemStatus) “Ödendi” veya “Kabul edildi” olması gerekmektedir.
     * Aksi durumda “ön koşullar sağlanamadı” cevabı alınır.
     * Kargo şirketlerinin listesi için ShipmentCompanyService den GetShipmentCompanies metodu kullanılmalıdır.
     */
    public function makeOrderItemShipment(int $orderId): object;
}
