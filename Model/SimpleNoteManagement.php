<?php
namespace Magelearn\SimpleNote\Model;
use Magelearn\SimpleNote\Api\Data\SimpleNoteInterface;
use Magelearn\SimpleNote\Api\SimpleNoteManagementInterface;
use Magelearn\SimpleNote\Setup\SchemaInformation;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
/**
 * Class SimpleNoteManagement
 */
class SimpleNoteManagement implements SimpleNoteManagementInterface
{
    /**
     * Quote repository.
     *
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;
    /**
     * SimpleNoteManagement constructor.
     *
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(CartRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }
    /**
     * Save simple note number in the quote
     *
     * @param int $cartId
     * @param SimpleNoteInterface $simpleNote
     *
     * @return null|string
     *
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveSimpleNote(
        $cartId,
        SimpleNoteInterface $simpleNote
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $sn = $simpleNote->getSimpleNote();
        try {
            $quote->setData(SchemaInformation::ATTRIBUTE_SIMPLE_NOTE, strip_tags($sn));
            $this->quoteRepository->save($quote);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__('The simple note # number could not be saved'));
        }
        return $sn;
    }
}