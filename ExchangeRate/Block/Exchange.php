<?php

namespace Training3\ExchangeRate\Block;

use Magento\Framework\View\Element\Text;
use Training3\ExchangeRate\Helper\Data;
use Magento\Framework\View\Element\Context;

/**
 * Class Exchange
 *
 * @package Training3\ExchangeRate\Block
 */
class Exchange extends Text
{
    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * Exchange constructor.
     *
     * @param Context $context
     * @param array   $data
     * @param Data    $dataHelper
     */
    public function __construct(Context $context, array $data, Data $dataHelper)
    {
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    public function toHtml()
    {
        $data = $this->dataHelper->getRates();
        $this->setText('1 '.$data['base'].' = '. $data['rates']['EUR'].' EUR');
        return parent::toHtml();
    }
}
