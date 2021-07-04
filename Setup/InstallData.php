<?php
namespace Magelearn\SimpleNote\Setup;
use Magelearn\SimpleNote\Setup\SetupService\AddSimpleNoteFieldToQuoteAndOrderService;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
/**
 * Class InstallData
 *
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var AddSimpleNoteFieldToQuoteAndOrderService
     */
    protected $addSimpleNoteFieldToQuoteAndOrderService;
    /**
     * InstallData constructor.
     *
     * @param AddSimpleNoteFieldToQuoteAndOrderService $addSimpleNoteFieldToQuoteAndOrderService
     */
    public function __construct(AddSimpleNoteFieldToQuoteAndOrderService $addSimpleNoteFieldToQuoteAndOrderService)
    {
        $this->addSimpleNoteFieldToQuoteAndOrderService = $addSimpleNoteFieldToQuoteAndOrderService;
    }
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->addSimpleNoteFieldToQuoteAndOrderService->execute($setup);
        $setup->endSetup();
    }
}