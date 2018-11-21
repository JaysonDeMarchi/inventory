<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventorySourceSelection\Model\DistanceProvider\Offline;

use Magento\Framework\Exception\LocalizedException;
use Magento\InventorySourceSelection\Model\DistanceProvider\GetLatLngRequestFromAddressInterface;
use Magento\InventorySourceSelectionApi\Model\Request\LatLngRequestInterface;
use Magento\InventorySourceSelectionApi\Model\Request\LatLngRequestInterfaceFactory;
use Magento\InventorySourceSelection\Model\ResourceModel\GetGeoNameDataByAddressRequest;
use Magento\InventorySourceSelectionApi\Api\Data\AddressRequestInterface;

/**
 * @inheritdoc
 */
class GetLatLngRequestFromAddress implements GetLatLngRequestFromAddressInterface
{
    private $latLngCache = [];

    /**
     * @var LatLngRequestInterfaceFactory
     */
    private $latLngRequestInterfaceFactory;

    /**
     * @var GetGeoNameDataByAddressRequest
     */
    private $getGeoNameDataByAddressRequest;

    /**
     * GetLatLngRequestFromAddress constructor.
     *
     * @param GetGeoNameDataByAddressRequest $getGeoNameDataByAddressRequest
     * @param LatLngRequestFactory $latLngRequestInterfaceFactory
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function __construct(
        GetGeoNameDataByAddressRequest $getGeoNameDataByAddressRequest,
        LatLngRequestInterfaceFactory $latLngRequestInterfaceFactory
    ) {
        $this->getGeoNameDataByAddressRequest = $getGeoNameDataByAddressRequest;
        $this->latLngRequestInterfaceFactory = $latLngRequestInterfaceFactory;
    }

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function execute(AddressRequestInterface $addressRequest): LatLngRequestInterface
    {
        $cacheKey = $addressRequest->getAsString();
        if (!isset($this->latLngCache[$cacheKey])) {
            $geoNameData = $this->getGeoNameDataByAddressRequest->execute($addressRequest);

            $this->latLngCache[$cacheKey] = $this->latLngRequestInterfaceFactory->create([
                'lat' => (float)$geoNameData['latitude'],
                'lng' => (float)$geoNameData['longitude'],
            ]);
        }

        return $this->latLngCache[$cacheKey];
    }
}
