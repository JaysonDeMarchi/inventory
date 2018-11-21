<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventorySourceSelection\Model\DistanceProvider;

use Magento\InventorySourceSelectionApi\Model\Request\LatLngRequestInterface;

/**
 * Get distance between two LatLngRequest points
 */
interface GetDistanceInterface
{
    /**
     * Get distance between two points
     *
     * @param LatLngRequestInterface $source
     * @param LatLngRequestInterface $destination
     * @return float
     */
    public function execute(LatLngRequestInterface $source, LatLngRequestInterface $destination): float;
}
