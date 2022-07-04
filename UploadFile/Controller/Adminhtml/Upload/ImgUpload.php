<?php
namespace OmnyfyCustomization\UploadFile\Controller\Adminhtml\Upload;

use Magento\Framework\Controller\ResultFactory;

class ImgUpload extends \Magento\Catalog\Controller\Adminhtml\Category\Image\Upload
{
    /**
     * Image uploader
     *
     * @var OmnyfyCustomization\UploadFile\Model\ImageUploader
     */
    protected $fileUploader;

    /**
     * File key
     *
     * @var string
     */
    protected $_fileKey = 'file_name';

    /**
     * AllowExtensions
     */
    protected $allowExtensions = [
        'jpg' => 'jpg',
        'pdf' => 'pdf',
        'jepg' => 'jepg',
        'png' => 'png'
    ];

    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Catalog\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ImageUploader $imageUploader,
        \OmnyfyCustomization\UploadFile\Model\ImageUploader $fileUploader
    ) {
        parent::__construct($context, $imageUploader);
        $this->fileUploader = $fileUploader;
    }

    public function execute()
    {
        try {
            $this->fileUploader->setAllowedExtensions($this->allowExtensions);
            $result = $this->fileUploader->saveFileToTmpDir($this->_fileKey);
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
