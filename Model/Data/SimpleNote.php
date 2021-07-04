<?php
namespace Magelearn\SimpleNote\Model\Data;
use Magelearn\SimpleNote\Api\Data\SimpleNoteInterface;
use Magelearn\SimpleNote\Setup\SchemaInformation;
use Magento\Framework\Api\AbstractSimpleObject;
/**
 * Class SimpleNote
 */
class SimpleNote extends AbstractSimpleObject implements SimpleNoteInterface
{
    /**
     * @inheritdoc
     */
    public function getSimpleNote()
    {
        return $this->_get(SchemaInformation::ATTRIBUTE_SIMPLE_NOTE);
    }
    /**
     * @inheritdoc
     */
    public function setSimpleNote($simpleNote)
    {
        return $this->setData(SchemaInformation::ATTRIBUTE_SIMPLE_NOTE, $simpleNote);
    }
}