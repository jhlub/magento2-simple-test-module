<?php

declare(strict_types=1);

namespace TestTask\SimpleTest\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ResourceModel\Store\CollectionFactory;
use TestTask\SimpleTest\Api\SimpleTestApiInterface;

/**
 * Class SimpleTestApiModel
 */
class SimpleTestApiModel implements SimpleTestApiInterface {

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var CollectionFactory
     */
    private $_storeCollectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * @var string[]
     */
    protected $_configPaths = [
        //'general/store_information/name',
        //'general/store_information/phone',
        //'general/store_information/hours',
        //'general/store_information/country_id',
        //'general/store_information/region_id',
        //'general/store_information/postcode',
        //'general/store_information/city',
        //'general/store_information/street_line1',
        //'general/store_information/street_line2',
        //'general/store_information/merchant_vat_number',
        'general/store_information/simple_test_description',
    ];

    public function __construct(
        CollectionFactory $storeCollectionFactory,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        $this->_storeCollectionFactory = $storeCollectionFactory;
    }

    /**
     * GET json for SimpleTestAPI.
     * URL: /rest/V1/simpletest/json
     * Return json string.
     * 
     * @return string
     */
    public function getJson(): string
    {
        // HACKISH just for test!
        $storeConfigs = $this->getStoreConfigs();
        $storeConfigsAsObjects = [];

        foreach ($storeConfigs as $item) {
            $storeConfigsAsObjects[] = (object) $item;
        }

        return json_encode($storeConfigsAsObjects);
    }

    /**
     * GET array for SimpleTestAPI.
     * URL: /rest/V1/simpletest/array-of-arrays
     *
     * Return array of arrays.
     * 
     * @return array
     */
    public function getArrayOfArrays(): array
    {
        return $this->getStoreConfigs();
    }

    /**
     * TODO!
     * GET array for SimpleTestAPI.
     * URL: /rest/V1/simpletest/array-of-objects
     *
     * Return array of objects.
     * 
     * @return object
     */
    public function getArrayOfObjects(): array
    {
      // HACKISH just for test!
      $storeConfigs = $this->getStoreConfigs();
      $storeConfigsAsObjects = [];

      foreach($storeConfigs as $item) {
        $storeConfigsAsObjects[] = (object) $item;
      }

      // TODO! PROPER ARRAY OF OBJECTS!

      return $storeConfigsAsObjects;
    }

    /**
     * Get store config for simple API response.
     * 
     * @return array
     */
    protected function getStoreConfigs(): array
    {
        $storeConfigs = [];
        $storeCollection = $this->_storeCollectionFactory->create();
        foreach ($storeCollection->load() as $item) {
            $storeConfigs[] = $this->storeInfomation($item);
        }

        return $storeConfigs;
    }

    /**
     * Collect store information
     * 
     * @param StoreInterface $store
     * @return array
     */
    protected function storeInfomation(StoreInterface $store): array
    {
        $storeConfigFinalData = [];
        $storeConfigFinalData['store_id'] = $store->getId();
        $storeConfigFinalData['store_code'] = $store->getCode();
        //$storeConfigFinalData['website_id'] = $store->getWebsiteId();
        foreach ($this->_configPaths as $configPath) {

            // JUST FOR BETTER VIEW IN TEST!
            // Changed 'general/store_information/simple_test_description' to 'simple_store_description'
            $namesToFix = [
                'general/store_information/simple_test_description' => 'simple_store_description'
            ];

            $configPathFixedName = $configPath;
            if (in_array($configPathFixedName, array_keys($namesToFix), true)) {
                $configPathFixedName = $namesToFix[$configPathFixedName];
            }

            $storeConfigFinalData[$configPathFixedName] = $this->_scopeConfig
                ->getValue(
                    $configPath,
                    ScopeInterface::SCOPE_STORES,
                    $store->getCode()
                );
        }

        return $storeConfigFinalData;
    }
}
