<?php
namespace Magelearn\SimpleNote\Observer;
use Magelearn\SimpleNote\Setup\SchemaInformation;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;
/**
 * Class AddSimpleNoteToOrderObserver
 */
class AddSimpleNoteToOrderObserver implements ObserverInterface
{
    /**
     * Transfer the Simple Note from the quote to the order
     * event sales_model_service_quote_submit_before
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        /* @var $order Order */
        $order = $observer->getEvent()->getOrder();
        /** @var $quote Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        /** @var string $simpleNote */
        $simpleNote = $quote->getData(SchemaInformation::ATTRIBUTE_SIMPLE_NOTE);
        $order->setData(SchemaInformation::ATTRIBUTE_SIMPLE_NOTE, $simpleNote);
    }
}