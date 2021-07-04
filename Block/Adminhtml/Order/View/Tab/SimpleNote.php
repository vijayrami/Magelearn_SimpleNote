<?php

namespace Magelearn\SimpleNote\Block\Adminhtml\Order\View\Tab;

class SimpleNote extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
   protected $_template = 'order/view/tab/simplenote.phtml';
   /**
    * @var \Magento\Framework\Registry
    */
   private $_coreRegistry;

   /**
    * View constructor.
    * @param \Magento\Backend\Block\Template\Context $context
    * @param \Magento\Framework\Registry $registry
    * @param array $data
    */
   public function __construct(
       \Magento\Backend\Block\Template\Context $context,
       \Magento\Framework\Registry $registry,
       array $data = []
   ) {
       $this->_coreRegistry = $registry;
       parent::__construct($context, $data);
   }

   /**
    * Retrieve order model instance
    * 
    * @return \Magento\Sales\Model\Order
    */
   public function getOrder()
   {
       return $this->_coreRegistry->registry('current_order');
   }
   /**
    * Retrieve order model instance
    *
    * @return int
    *Get current id order
    */
   public function getOrderId()
   {
       return $this->getOrder()->getEntityId();
   }

   /**
    * Retrieve order increment id
    *
    * @return string
    */
   public function getOrderIncrementId()
   {
       return $this->getOrder()->getIncrementId();
   }
   public function getSimpleNote()
   {
       if ($this->getOrder()->getData('simple_note')) {
            return $this->getOrder()->getData('simple_note');
        }
        return null;
   }
   /**
    * {@inheritdoc}
    */
   public function getTabLabel()
   {
       return __('Simple Note');
   }

   /**
    * {@inheritdoc}
    */
   public function getTabTitle()
   {
       return __('Simple Note');
   }

   /**
    * {@inheritdoc}
    */
   public function canShowTab()
   {
       return true;
   }

   /**
    * {@inheritdoc}
    */
   public function isHidden()
   {
       return false;
   }
   /**
     * Get Tab Class
     *
     * @return string
     */
    public function getTabClass()
    {
        return 'ajax only'; //load using ajax
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
        
        // tab url
        return $this->getUrl('simplenotetab/*/simplenotetab', ['_current' => true]);
    }
	/**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return true;
    }
}