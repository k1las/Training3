<?php
namespace Training3\OrderInfo\Controller;

use Training2\OrderController\Controller\Json\Order;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class OrderRewrite
 *
 * @package Training3\OrderInfo\Controller
 */
class OrderRewrite extends Order
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * OrderRewrite constructor.
     *
     * @param Context                     $context
     * @param OrderRepositoryInterface    $order
     * @param JsonFactory                 $resultJsonFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(Context $context, OrderRepositoryInterface $order, JsonFactory $resultJsonFactory, \Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
        parent::__construct($context, $order, $resultJsonFactory);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $orderId = $this->getRequest()->getParam('orderId');
        try {
            $order = $this->order->get($orderId);
            $response = $this->_formatResponse($order);
        } catch (\Exception $e) {
            $response = ['error' => $e->getMessage(), 'status' => 404];
        }

        if ($this->getRequest()->getParam('json') === "1") {
            return $this->resultJsonFactory->create()
                    ->setData($response);

        }

        $this->registry->register('order_data', $response);
        return $this->resultFactory->create('page');
    }
}
