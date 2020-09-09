<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface CityInterface
{
    /**
     * @return mixed
     * @description Sistemde kayıtlı şehirlerin kodları ve plaka numaraları ile birlikte listelenmesi için bu metot kullanılır.
     * Adres ile ilgili işlem yapmak istendiği zaman bu servis aracılığı ile elde edilen şehir kodları kullanılır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     */
    public function getCities(): object;

    /**
     * @param int $cityCode
     * @return mixed
     * @description
     * Şehir plaka numarası verilen şehrin sistemde kayıtlı olan kodunu ve hangi şehir olduğunu öğrenmek için bu metot kullanılmalıdır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan şehir sistemde bulunamazsa ‘şehir bulunamadı’ hatası alınır.
     */
    public function getCity(int $cityCode): object;

    /**
     * @param int $cityCode
     * @return mixed
     * @description Plaka kodu verilen şehre ait ilçelerinin listelenmesi için bu metot kullanılmalıdır.
     * İlçe kodu adres ekleme/güncelleme işlemlerinde kullanılmaktadır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan şehir sistemde bulunamazsa ‘şehir bulunamadı’ hatası alınır.
     */
    public function getDistricts(int $cityCode): object;

    /**
     * @param int $districtId
     * @return mixed
     * @description İlçe kodu verilen semt/mahallelerin listelenmesi için bu metot kullanılmalıdır.
     * Genel kullanıma açık bir servis olduğu için servisin kullanımı sırasında herhangi bir güvenlik kontrolü yapılmamaktadır.
     * Sorgulanan ilçe sistemde bulunamazsa ‘ilçe bulunamadı’ hatası alınır.
     */
    public function getNeighborhoods(int $districtId): object;
}
