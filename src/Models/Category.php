<?php

namespace Onurkacmaz\LaravelN11\Models;

use Onurkacmaz\LaravelN11\Exceptions\N11Exception;
use Onurkacmaz\LaravelN11\Service;
use SoapClient;

class Category extends Service
{

    /**
     * @var SoapClient|null
     */
    private $_client;

    /**
     * @var string
     */
    private $endPoint = "/CategoryService.wsdl";

    /**
     * Category constructor
     * endPoint set edildi.
     * @throws N11Exception|\SoapFault
     */
    public function __construct()
    {
        parent::__construct();
        $this->_client = $this->setEndPoint($this->endPoint);
    }

    /**
     * @return mixed
     * @description Üst Seviye Kategorileri Listeler
     */
    public function topLevelCategories()
    {
        return $this->_client->GetTopLevelCategories($this->_parameters);
    }

    /**
     * @param int $categoryId
     * @param int $currentPage
     * @param int $pageSize
     * @return mixed
     * @description İstenilen kategori, üst seviye kategori veya diğer seviye kategorilerden olabilir, bu kategorilere ait olan özelliklerin ve bu özelliklere ait değerlerin listelenmesi için kullanılan metottur.
     */
    public function getCategoryAttributes(int $categoryId, int $currentPage = 1, int $pageSize = 100) {
        $this->_parameters["categoryId"] = $categoryId;
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize,
        ];
        return $this->_client->GetCategoryAttributes($this->_parameters);
    }

    /**
     * @param int $categoryId
     * @return mixed
     * @description İstenilen kategori, üst seviye kategori veya diğer seviye kategorilerden olabilir, bu kategorilere ait olan özelliklerin ve bu özelliklere ait değerlerin listelenmesi için kullanılan metottur.
     */
    public function getCategoryAttributesId(int $categoryId) {
        $this->_parameters["categoryId"] = $categoryId;
        return $this->_client->GetCategoryAttributesId($this->_parameters);
    }

    /**
     * @param int $categoryProductAttrId
     * @param int $currentPage
     * @param int $pageSize
     * @return mixed
     * @description Özelliğe ait değerleri listeler
     */
    public function getCategoryAttributeValue(int $categoryProductAttrId, int $currentPage = 1, int $pageSize = 100) {
        $this->_parameters["categoryProductAttributeId"] = $categoryProductAttrId;
        $this->_parameters["pagingData"] = [
            "currentPage" => $currentPage,
            "pageSize" => $pageSize,
        ];
        return $this->_client->GetCategoryAttributeValue($this->_parameters);
    }

    /**
     * @param int $categoryId
     * @return mixed
     * @description Kodu verilen kategorinin birinci seviye üst kategorilerine ulaşmak için bu metot kullanılmalıdır.
     * İkinci seviye üst kategorilere ulaşmak için (Örn. “Deri ayakkabı -> Ayakkabı -> Giysi” kategori ağacında “Giysi “ bilgisi) birinci seviye üst kategorinin (Örn. Ayakkabı) kodu verilerek tekrar servis çağırılmalıdır.
     * Sorgulanan kategori sistemde bulunamazsa ‘kategori bulunamadı’ hatası alınır. Eğer ilgili kategori herhangi bir üst kategoriye sahip değilse ”parentCategory” bilgisi response içerisinde yer almaz.
     */
    public function getParentCategory(int $categoryId) {
        $this->_parameters["categoryId"] = $categoryId;
        return $this->_client->GetParentCategory($this->_parameters);
    }

    /**
     * @param int $categoryId
     * @return mixed
     * @description Kodu verilen kategorinin birinci seviye alt kategorilerine ulaşmak için bu metot kullanılmalıdır.
     * İkinci seviye alt kategorilere ulaşmak için (Örn. “Giysi -> Ayakkabı -> Deri ayakkabı” kategori ağacında “Deri ayakkabı” bilgisi) birinci Seviye alt kategorinin (Örn. Ayakkabı) kodu verilerek tekrar servis çağırılmalıdır.
     * Sorgulanan kategori sistemde bulunamazsa hata alınır. Eğer ilgili kategori herhangi bir alt kategoriye sahip değilse response bilgisi boş döner.
     */
    public function getSubCategories(int $categoryId) {
        $this->_parameters["categoryId"] = $categoryId;
        return $this->_client->GetSubCategories($this->_parameters);
    }
}
