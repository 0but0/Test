<?php
namespace OmnyfyCustomization\UploadFile\Model\ResourceModel\Upload;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'omnyfycustomization_uploadfile_upload_collection';
    protected $_eventObject = 'upload_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OmnyfyCustomization\UploadFile\Model\Upload', 'OmnyfyCustomization\UploadFile\Model\ResourceModel\Upload');
    }
}
