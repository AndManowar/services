<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 29.03.18
 * Time: 12:36
 */

namespace common\services;

use common\models\Orders;
use common\services\discounts\AllOrderDiscountService;
use common\services\discounts\PromoDiscountService;

/**
 * Class Discount
 *
 * @package common\services
 */
class Discount
{

    /**
     * @var Orders
     */
    private $order;

    /**
     * @var float|integer
     */
    private $totalPrice;

    /**
     * Discount constructor.
     * @param Orders $order
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->totalPrice = $this->order->old_price;
    }

    /**
     * @return bool
     */
    public function calculateDiscount()
    {
        /** @var AllOrderDiscountService|PromoDiscountService $discountType */
        foreach ($this->order->discountTypes as $discountType) {

            if (!$discountType->setDiscountPrice($this->totalPrice)) {

                return false;
            }
        }

        $this->order->total_price = $this->totalPrice;
        $this->order->total_discount = $this->order->old_price - $this->order->total_price;

        return $this->order->save();
    }
}