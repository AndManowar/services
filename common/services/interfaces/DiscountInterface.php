<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 29.03.18
 * Time: 12:25
 */

namespace common\services\interfaces;

/**
 * Interface DiscountInterface
 *
 * @package common\services\interfaces
 */
interface DiscountInterface
{
    /**
     * @param float|integer $price
     * @return bool
     */
    public function setDiscountPrice(&$price);

    /**
     * @param float|integer $price
     * @return float|integer
     */
    public function getDiscountValue($price);

}