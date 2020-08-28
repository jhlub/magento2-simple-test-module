<?php

namespace TestTask\SimpleTest\Api\Data;

/**
 * Custom Store interface
 */
interface CustomStoreInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * Get Store Id.
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set Store Id.
     *
     * @param int $id
     * @return $this
     */
    public function setStoreId($id);

    /**
     * Get Store Code.
     *
     * @return string
     */
    public function getStoreCode();

    /**
     * Set Store Code.
     *
     * @param string $code
     * @return $this
     */
    public function setStoreCode($code);

    /**
     * Get Value.
     *
     * @return string
     */
    public function getValue();

    /**
     * Set Value.
     *
     * @param string $name
     * @return $this
     */
    public function setValue($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Magento\Store\Api\Data\StoreExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Magento\Store\Api\Data\StoreExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Magento\Store\Api\Data\StoreExtensionInterface $extensionAttributes
    );
}
