<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Payment\Gateway\Data\Order;

use Magento\Payment\Gateway\Data\AddressAdapterInterface;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Magento\Sales\Api\Data\OrderInterface;

class OrderAdapter implements OrderAdapterInterface
{
    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @var AddressAdapter
     */
    private $addressAdapterFactory;

    /**
     * @param OrderInterface $order
     * @param AddressAdapterFactory $addressAdapterFactory
     */
    public function __construct(
        OrderInterface $order,
        AddressAdapterFactory $addressAdapterFactory
    ) {
        $this->order = $order;
        $this->addressAdapterFactory = $addressAdapterFactory;
    }

    /**
     * Returns currency code
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->order->getBaseCurrencyCode();
    }

    /**
     * Returns order increment id
     *
     * @return string
     */
    public function getOrderIncrementId()
    {
        return $this->order->getIncrementId();
    }

    /**
     * Returns customer ID
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->order->getCustomerId();
    }

    /**
     * Returns billing address
     *
     * @return AddressAdapterInterface
     */
    public function getBillingAddress()
    {
        return $this->addressAdapterFactory->create(
            ['address' => $this->order->getBillingAddress()]
        );
    }

    /**
     * Returns shipping address
     *
     * @return AddressAdapterInterface
     */
    public function getShippingAddress()
    {
        return $this->addressAdapterFactory->create(
            ['address' => $this->order->getShippingAddress()]
        );
    }
}
