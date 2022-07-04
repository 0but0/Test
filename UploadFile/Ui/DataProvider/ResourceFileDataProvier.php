<?php

namespace OmnyfyCustomization\UploadFile\Ui\DataProvider;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Reporting;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\UrlInterface;

/**
 * Class PendingOrderDataProvider
 * @package Omnyfy\Mcm\Ui\DataProvider\PendingPayout\Grid
 */
class ResourceFileDataProvier extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider {

    protected $urlBuilder;

    /**
     * @param string                $name
     * @param string                $primaryFieldName
     * @param string                $requestFieldName
     * @param Reporting             $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface      $request
     * @param FilterBuilder         $filterBuilder
     * @param array                 $meta
     * @param array                 $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Reporting $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        UrlInterface $urlBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data
        );
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param SearchResultInterface $searchResult
     * @return array
     */
    protected function searchResultToOutput(SearchResultInterface $searchResult) {
        $arrItems = [];
        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        $arrItems['items'] = [];
        foreach ($searchResult->getItems() as $item) {
            $resourceFileUrl = $this->urlBuilder->getDirectUrl(
                \OmnyfyCustomization\UploadFile\Model\ImageUploader::BASE_PATCH,
                ['_type' => UrlInterface::URL_TYPE_MEDIA]
            );
            $resourceFileUrl .= '/' . $item->getFileName();
            $link = '<a target="_blank" href="' . $resourceFileUrl . '">Link</a>';
            $data = $item->getData();
            $data['file_url'] = $link;
            $arrItems['items'][] = $data;
        }

        return $arrItems;
    }
}
