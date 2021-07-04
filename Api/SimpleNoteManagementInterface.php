<?php
namespace Magelearn\SimpleNote\Api;
/**
 * Interface for saving the checkout note to the quote for orders
 *
 * @api
 */
interface SimpleNoteManagementInterface
{
    /**
     * @param int $cartId
     * @param \Magelearn\SimpleNote\Api\Data\SimpleNoteInterface $simpleNote
     *
     * @return string
     */
    public function saveSimpleNote(
        $cartId,
        \Magelearn\SimpleNote\Api\Data\SimpleNoteInterface $simpleNote
    );
}