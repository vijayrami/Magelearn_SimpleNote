<?php
namespace Magelearn\SimpleNote\Setup\SetupService;
use Magelearn\SimpleNote\Setup\SchemaInformation;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Quote\Setup\QuoteSetup;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetup;
use Magento\Sales\Setup\SalesSetupFactory;
/**
 * Class AddSimpleNoteFieldToQuoteAndOrderService
 *
 * @codeCoverageIgnore
 */
class AddSimpleNoteFieldToQuoteAndOrderService
{
    /**
     * @var QuoteSetupFactory
     */
    protected $quoteSetupFactory;
    /**
     * @var SalesSetupFactory
     */
    protected $salesSetupFactory;
    /**
     * AddSimpleNoteFieldToQuoteAndOrderService constructor.
     *
     * @param QuoteSetupFactory $quoteSetupFactory
     * @param SalesSetupFactory $salesSetupFactory
     */
    public function __construct(
        QuoteSetupFactory $quoteSetupFactory,
        SalesSetupFactory $salesSetupFactory
    ) {
        $this->quoteSetupFactory = $quoteSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;
    }
    /**
     * @param ModuleDataSetupInterface $dataSetup
     */
    public function execute(ModuleDataSetupInterface $dataSetup)
    {
        $attributeAttr = [
            'type' => Table::TYPE_TEXT,
            'comment' => 'Simple Note',
        ];
        $this->addAttributeToQuote(
            SchemaInformation::ATTRIBUTE_SIMPLE_NOTE,
            $attributeAttr,
            $dataSetup
        );
        $this->addAttributeToOrder(
            SchemaInformation::ATTRIBUTE_SIMPLE_NOTE,
            $attributeAttr,
            $dataSetup
        );
        $this->addAttributeToOrderGrid(
            SchemaInformation::ATTRIBUTE_SIMPLE_NOTE,
            $attributeAttr,
            $dataSetup
        );
    }
    /**
     * Add attribute to quote
     *
     * @param string $attributeCode
     * @param array $attributeAttr
     * @param ModuleDataSetupInterface $dataSetup
     */
    protected function addAttributeToQuote($attributeCode, $attributeAttr, $dataSetup)
    {
        /** @var QuoteSetup $quoteSetup */
        $quoteSetup = $this->quoteSetupFactory->create(
            [
                'resourceName' => 'quote_setup',
                'setup' => $dataSetup,
            ]
        );
        $quoteSetup->addAttribute('quote', $attributeCode, $attributeAttr);
    }
    /**
     * Add attribute to order
     *
     * @param string $attributeCode
     * @param array $attributeAttr
     * @param ModuleDataSetupInterface $dataSetup
     */
    protected function addAttributeToOrder($attributeCode, $attributeAttr, $dataSetup)
    {
        /** @var SalesSetup $salesSetup */
        $salesSetup = $this->salesSetupFactory->create(
            [
                'resourceName' => 'sales_setup',
                'setup' => $dataSetup,
            ]
        );
        $salesSetup->addAttribute('order', $attributeCode, $attributeAttr);
    }
    /**
     * Add attribute to order grid
     *
     * @param string $attributeCode
     * @param array $attributeAttr
     * @param ModuleDataSetupInterface $dataSetup
     */
    protected function addAttributeToOrderGrid($attributeCode, $attributeAttr, $dataSetup)
    {
        $dataSetup->getConnection()->addColumn(
            $dataSetup->getTable('sales_order_grid'),
            $attributeCode,
            $attributeAttr
        );
    }
}