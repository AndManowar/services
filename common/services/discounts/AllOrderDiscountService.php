<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 29.03.18
 * Time: 12:29
 */

namespace common\services\discounts;

use common\services\interfaces\DiscountInterface;

/**
 * Class AllOrderDiscount
 *
 * @package common\services\discounts
 */
class AllOrderDiscountService implements DiscountInterface
{

    /**
     * @var integer
     */
    private $discountPercent;

    /**
     * AllOrderDiscountService constructor.
     * @param integer $discountPercent
     */
    public function __construct($discountPercent)
    {
        $this->discountPercent = $discountPercent;
    }

    /**
     * @param float|int $price
     * @return bool
     */
    public function setDiscountPrice(&$price)
    {
        if (!$this->validateDiscount()) {
            return false;
        }

        $price -= $this->getDiscountValue($price);

        return true;
    }

    /**
     * @param float|int $price
     * @return float|int
     */
    public function getDiscountValue($price)
    {
        return $price * $this->discountPercent / 100;
    }

    /**
     * @return array|bool
     */
    private function validateDiscount()
    {
        if ((int)$this->discountPercent <= 0 || (int)$this->discountPercent >= 100) {
            return false;
        }

        return true;
    }
}