<?php
namespace OmnyfyCustomization\UploadFile\Model\ResourceModel;

class Upload extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('changi_resource_file', 'entity_id');
    }
}
