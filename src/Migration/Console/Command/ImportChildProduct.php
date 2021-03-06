<?php

namespace Mimlab\PrestashopMigrationTool\Console\Command;

use Magento\Framework\ObjectManagerInterface;
use Mimlab\PrestashopMigrationTool\Model\ProductChild;
use Mimlab\PrestashopMigrationTool\Model\ProductChildFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportChildProduct
 *
 * @package Mimlab\PrestashopMigrationTool\Console\Command
 */
class ImportChildProduct extends ImportCommand
{
    /**
     * Type of migration
     */
    const TYPE_IMPORT = 'catalog_products_child';

    /**
     * @var ProductChildFactory
     */
    private $productChildFactory;

    /**
     * ImportChildProduct constructor.
     *
     * @param ProductChildFactory $productChildFactory
     * @param ObjectManagerInterface $objectManager
     * @param null $name
     */
    public function __construct(
        ProductChildFactory $productChildFactory,
        ObjectManagerInterface $objectManager, 
        $name = null
    ) {
        $this->productChildFactory = $productChildFactory;
        parent::__construct($objectManager, $name);
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProductChild $product */
        $product = $this->productChildFactory->create();
        if ($dirInputPath = $input->getOption(parent::INPUT_KEY_FLOW_DIR)) {
            $product->setFlowDir($dirInputPath);
        }
        $product->execute(self::TYPE_IMPORT, $output);
    }
}
