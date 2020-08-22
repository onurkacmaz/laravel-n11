<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class City extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/CityService.wsdl";

    /**
     * City constructor
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @return mixed
     * @description Sistemde kayıtlı şehirlerin kodları ve plaka numaraları ile birlikte listelenmesi için bu metot kullanılır.
     * Adres ile ilgili işlem yapmak istendiği zaman bu servis aracılığı ile elde edilen şehir kodları kullanılır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     */
    public function getCities()
    {
        return $this->_client->GetCities();
    }

    /**
     * @param int $cityCode
     * @return mixed
     * @description
     * Şehir plaka numarası verilen şehrin sistemde kayıtlı olan kodunu ve hangi şehir olduğunu öğrenmek için bu metot kullanılmalıdır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan şehir sistemde bulunamazsa ‘şehir bulunamadı’ hatası alınır.
     */
    public function getCity(int $cityCode)
    {
        return $this->_client->GetCity(["cityCode" => $cityCode]);
    }

    /**
     * @param int $cityCode
     * @return mixed
     * @description Plaka kodu verilen şehre ait ilçelerinin listelenmesi için bu metot kullanılmalıdır.
     * İlçe kodu adres ekleme/güncelleme işlemlerinde kullanılmaktadır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan şehir sistemde bulunamazsa ‘şehir bulunamadı’ hatası alınır.
     */
    public function getDistricts(int $cityCode)
    {
        return $this->_client->GetDistrict(["cityCode" => $cityCode]);
    }

    /**
     * @param int $districtId
     * @return mixed
     * @description İlçe kodu verilen semt/mahallelerin listelenmesi için bu metot kullanılmalıdır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan ilçe sistemde bulunamazsa ‘ilçe bulunamadı’ hatası alınır.
     */
    public function getNeighborhoods(int $districtId)
    {
        return $this->_client->GetNeighborhoods(["districtId" => $districtId]);
    }

}
