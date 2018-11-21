<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventorySourceSelectionApi\Model\Request;

/**
 * DTO for latitude and longitude request
 *
 * @api
 */
interface LatLngRequestInterface
{
    /**
     * Get latitude
     *
     * @return float
     */
    public function getLat(): float;

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLng(): float;

    /**
     * Get as string
     *
     * @return string
     */
    public function getAsString(): string;
}
