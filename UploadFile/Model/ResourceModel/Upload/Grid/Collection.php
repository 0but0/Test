<?php
namespace OmnyfyCustomization\UploadFile\Model\ResourceModel\Upload\Grid;

class Collection extends \OmnyfyCustomization\UploadFile\Model\ResourceModel\Upload\Collection implements \Magento\Framework\Api\Search\SearchResultInterface
{
    public function getAggregations()
    {
    }

    public function setAggregations($aggregations)
    {
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items=null)
    {
        return $this;
    }

    protected function _getItemId(\Magento\Framework\DataObject $item)
    {

    }
}
