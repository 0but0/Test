<?php
/**
 * Project: Vendor.
 * User: jing
 * Date: 25/1/18
 * Time: 5:03 PM
 */
namespace OmnyfyCustomization\UploadFile\Ui\Component\Listing;

use Magento\Framework\UrlInterface;

class UploadFileActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [])
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        $resourceFileUrl = $this->urlBuilder->getDirectUrl(
            \OmnyfyCustomization\UploadFile\Model\ImageUploader::BASE_PATCH,
            ['_type' => UrlInterface::URL_TYPE_MEDIA]
        );
        foreach($dataSource['data']['items'] as &$item) {
            $url = $resourceFileUrl;
            $url .= '/' . $item['file_name'];
            $item[$this->getData('name')]['delete'] = [
                'href' => $url,
                'label' => __('Link'),
                'target' => '_blank'
            ];
        }

        return $dataSource;
    }
}