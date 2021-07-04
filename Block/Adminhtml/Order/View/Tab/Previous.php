<?php

namespace Magelearn\SimpleNote\Block\Adminhtml\Order\View\Tab;


class Previous extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Template
     *
     * @var string
     */
    protected $_template = 'order/view/tab/previous.phtml';
	protected $orderCollectionFactory;
	protected $customers;
	protected $orderRepository;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
		\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
		\Magento\Customer\Model\Customer $customers,
		\Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
		$this->orderCollectionFactory = $orderCollectionFactory;
		$this->customers = $customers;
		$this->orderRepository = $orderRepository;
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Previous Orders');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Customer Previous Orders');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        // For me, I wanted this tab to always show
        // You can play around with the ACL settings 
        // to selectively show later if you want
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        // For me, I wanted this tab to always show
        // You can play around with conditions to
        // show the tab later
        return false;
    }

    /**
     * Get Tab Class
     *
     * @return string
     */
    public function getTabClass()
    {
        // I wanted mine to load via AJAX when it's selected
        // That's what this does
        return 'ajax only';
    }

    /**
     * Get Class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->getTabClass();
    }

    /**
     * Get Tab Url
     *
     * @return string
     */
    public function getTabUrl()
    {
        // customtab is a adminhtml router we're about to define
        // the full route can really be whatever you want
        return $this->getUrl('previoustab/*/previoustab', ['_current' => true]);
    }
    
    /**
     * @param string $entity_id
     *
     * @return object
     */
	public function getOrder($entity_id)
	{
		return $this->orderRepository->get($entity_id);
	}
	
	public function getPreviousOrders($currentOrder)
	{
		$order = $this->coreRegistry->registry('current_order');
		
        $customerId = $order->getCustomerId();

		if(!$customerId) {
			
			$customerEmail = $order->getCustomerEmail();			
			
			$history = $this->orderCollectionFactory->create()->addFieldToSelect('entity_id')
			->addFieldToFilter(
                'customer_email',
                $customerEmail
            )
			->setOrder(
                'created_at',
                'desc'
            );
			
		
		}
		else {
            $history = $this->orderCollectionFactory->create($customerId)->addFieldToSelect('*')
            ->addAttributeToFilter('entity_id', ['nin' => $order->getId()])
            ->addAttributeToFilter('created_at', ['lteq' => $order->getCreatedAt()])
			->setOrder(
                'created_at',
                'desc'
            );
		}
		
	
		return $history->getData();
	}
    
    /**
     * Get current order
     *
     * @return object
     */
     public function getCurrentOrder()
     {
         $currentOrderId = $this->getRequest()->getParam('order_id');
 
         return $this->getOrder($currentOrderId);
     }
     
    /**
     * @param object $previousOrder
     * @param object $currentOrder
     *
     * @return string
     */
	public function getDaysSinceLastOrder($previousOrder, $currentOrder)
	{
        $currentOrderDate = new \DateTime($currentOrder->getCreatedAt());
        $previousOrderDate = new \DateTime($previousOrder->getCreatedAt());
        $interval = $currentOrderDate->diff($previousOrderDate);

        return __('%1 days ago', $interval->days);
    }
}	