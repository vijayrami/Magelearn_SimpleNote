<?php
 
namespace Magelearn\SimpleNote\Block\Order;
use Magento\Sales\Block\Order\Info as SalesInfo;

class Info extends SalesInfo
{
    /**
     * @var string
     */
    protected $_template = 'Magelearn_SimpleNote::order/info.phtml';
}