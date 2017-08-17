<?php
namespace Training3\OrderInfo\Block;

use Magento\Framework\View\Element\Context;

/**
 * Class OrderInfo
 *
 * @package Training3\OrderInfo\Block
 */
class OrderInfo extends \Magento\Framework\View\Element\Text
{
    protected $registry;

    public function __construct(Context $context, array $data, \Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $this->setText(print_r($this->registry->registry('order_data'), true));
        return parent::toHtml();
    }
}
