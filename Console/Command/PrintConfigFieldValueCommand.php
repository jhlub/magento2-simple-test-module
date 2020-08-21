<?php

declare(strict_types=1);

namespace TestTask\SimpleTest\Console\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PrintConfigFieldValueCommand
 * HOW TO USE:
 * - WITHOUT PARAM: bin/magento simpletest:get
 * - PROVIDE PARAM --store-id (eg. 1): bin/magento simpletest:get --store-id ID
 */
class PrintConfigFieldValueCommand extends Command
{
    const STORE_ID = 'store-id';

    protected $_storeManager;

    /**
     * Construct.
     * 
     * @param StoreManagerInterface $storeManager
     * {@inheritDoc}
     */
    public function __construct(StoreManagerInterface $storeManager, ...$args)
    {
        $this->_storeManager = $storeManager;
        parent::__construct(...$args);
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName('simpletest:get');
        $this->setDescription('Get standard config values of provided store.');
        $this->addOption(
            self::STORE_ID,
            null,
            InputOption::VALUE_REQUIRED,
            'Store ID',
            0
        );

        parent::configure();
    }

    /**
     * Print information about the store with provided ID (default ID is 0).
     * 
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $storeId = $input->getOption(self::STORE_ID);
        
        try {
            $storeInfo = $this->_storeManager->getStore($storeId);
            $storeInfoTag = 'info';
            $storeInfoString = 'Store ID: ' . $storeInfo->getId() . "\n";
            $storeInfoString .= 'Store Code: ' . $storeInfo->getCode() . "\n";
            $storeInfoString .= 'Website ID: ' . $storeInfo->getWebsiteId() . "\n";
            $storeInfoString .= 'Store Name: ' . $storeInfo->getName() . "\n";
            $storeInfoString .= 'Store active: ' . $storeInfo->getIsActive() . "\n";
        } catch (NoSuchEntityException $e) {
            $storeInfoTag = 'error';
            $storeInfoString = 'There is no any store with given ID!';
        }
        
        $output->writeln("<{$storeInfoTag}>{$storeInfoString}</{$storeInfoTag}>");

        return null;
    }
}
