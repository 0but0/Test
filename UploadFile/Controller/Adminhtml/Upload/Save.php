<?php

namespace OmnyfyCustomization\UploadFile\Controller\Adminhtml\Upload;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'OmnyfyCustomization_UploadFile::UploadFile';

    /**
     * @var \OmnyfyCustomization\UploadFile\Model\ImageUploader
     */
    protected $fileUploader;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \OmnyfyCustomization\UploadFile\Model\UploadFactory
     */
    protected $uploadModelFactory;

    /**
     * @var \OmnyfyCustomization\UploadFile\Model\ResourceModel\UploadFactory
     */
    protected $uploadResourceFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \OmnyfyCustomization\UploadFile\Model\ImageUploader $fileUploader,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \OmnyfyCustomization\UploadFile\Model\UploadFactory $uploadModelFactory,
        \OmnyfyCustomization\UploadFile\Model\ResourceModel\UploadFactory $uploadResourceFactory
    ) {
        parent::__construct($context);
        $this->fileUploader = $fileUploader;
        $this->resultFactory = $resultFactory;
        $this->uploadModelFactory = $uploadModelFactory;
        $this->uploadResourceFactory = $uploadResourceFactory;
    }

    public function execute()
    {
        try {
            $values = $this->_request->getPostValue();
            if (isset($values['file_name'][0])) {
                $fileName = $values['file_name'][0]['name'];
                $this->fileUploader->moveFileFromTmp($fileName);

                $model = $this->uploadModelFactory->create();
                $resourceModel = $this->uploadResourceFactory->create();
                $model->setFileName($fileName = $values['file_name'][0]['name']);
                $resourceModel->save($model);

                $this->messageManager->addSuccessMessage('File upload successful.');
                $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
                return $redirect->setUrl($this->_url->getUrl('uploadfile/upload/index'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('File upload failed. Please upload again.');
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            return $redirect->setUrl($this->_url->getUrl('uploadfile/upload/index'));
        }
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
