<?php

namespace Onurkacmaz\LaravelN11\Interfaces;

interface CategoryInterface
{
    /**
     * @return mixed
     * @description Üst Seviye Kategorileri Listeler
     */
    public function topLevelCategories();

    /**
     * @param int $categoryId
     * @param int $currentPage
     * @param int $pageSize
     * @return mixed
     * @description İstenilen kategori, üst seviye kategori veya diğer seviye kategorilerden olabilir, bu kategorilere ait olan özelliklerin ve bu özelliklere ait değerlerin listelenmesi için kullanılan metottur.
     */
    public function getCategoryAttributes(int $categoryId, int $currentPage = 1, int $pageSize = 100);

    /**
     * @param int $categoryId
     * @return mixed
     * @description İstenilen kategori, üst seviye kategori veya diğer seviye kategorilerden olabilir, bu kategorilere ait olan özelliklerin ve bu özelliklere ait değerlerin listelenmesi için kullanılan metottur.
     */
    public function getCategoryAttributesId(int $categoryId);

    /**
     * @param int $categoryProductAttrId
     * @param int $currentPage
     * @param int $pageSize
     * @return mixed
     * @description Özelliğe ait değerleri listeler
     */
    public function getCategoryAttributeValue(int $categoryProductAttrId, int $currentPage = 1, int $pageSize = 100);

    /**
     * @param int $categoryId
     * @return mixed
     * @description Kodu verilen kategorinin birinci seviye üst kategorilerine ulaşmak için bu metot kullanılmalıdır.
     * İkinci seviye üst kategorilere ulaşmak için (Örn. “Deri ayakkabı -> Ayakkabı -> Giysi” kategori ağacında “Giysi “ bilgisi) birinci seviye üst kategorinin (Örn. Ayakkabı) kodu verilerek tekrar servis çağırılmalıdır.
     * Sorgulanan kategori sistemde bulunamazsa ‘kategori bulunamadı’ hatası alınır. Eğer ilgili kategori herhangi bir üst kategoriye sahip değilse ”parentCategory” bilgisi response içerisinde yer almaz.
     */
    public function getParentCategory(int $categoryId);

    /**
     * @param int $categoryId
     * @return mixed
     * @description Kodu verilen kategorinin birinci seviye alt kategorilerine ulaşmak için bu metot kullanılmalıdır.
     * İkinci seviye alt kategorilere ulaşmak için (Örn. “Giysi -> Ayakkabı -> Deri ayakkabı” kategori ağacında “Deri ayakkabı” bilgisi) birinci Seviye alt kategorinin (Örn. Ayakkabı) kodu verilerek tekrar servis çağırılmalıdır.
     * Sorgulanan kategori sistemde bulunamazsa hata alınır. Eğer ilgili kategori herhangi bir alt kategoriye sahip değilse response bilgisi boş döner.
     */
    public function getSubCategories(int $categoryId);
}
