<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 29.03.18
 * Time: 12:28
 */

namespace common\services\discounts;

use common\helpers\SessionHelper;
use common\models\Discounts;
use common\models\UsedDiscounts;
use common\services\interfaces\DiscountInterface;
use Yii;

/**
 * Class PromoDiscountService
 *
 * @package common\services\discounts
 */
class PromoDiscountService implements DiscountInterface
{
    /**
     * @var Discounts
     */
    private $_discount;

    /**
     * @var float|integer
     */
    private $totalPrice;


    /**
     * PromoDiscountService constructor.
     * @param Discounts $discount
     */
    public function __construct($discount)
    {
        $this->_discount = $discount;
    }

    /**
     * @param float|integer $price
     * @return float|int
     */
    public function getDiscountValue($price)
    {
        if ($this->_discount->discount_type == Discounts::TYPE_PERCENT) {
            return $price * $this->_discount->discount_size / 100;
        }

        return $this->_discount->discount_size;
    }

    /**
     * @return array|bool
     */
    public function setDiscountFromOrderForm()
    {
        $this->totalPrice = SessionHelper::getParams('cart.totalPrice')[0];

        if (is_array($result = $this->validateDiscount())) {
            return $result;
        }

        $oldPrice = $this->totalPrice;
        $this->setDiscountPrice($this->totalPrice);

        SessionHelper::setParamsInSession('cart.discount_id', [$this->_discount->id]);
        SessionHelper::setParamsInSession('cart.totalPrice', [$this->totalPrice]);
        SessionHelper::setParamsInSession('cart.oldPrice', [$oldPrice]);
        SessionHelper::setParamsInSession('cart.discountSize', [$this->getDiscountValue($oldPrice)]);

        return true;
    }

    /**
     * @param float|integer $price
     * @return bool
     */
    public function setDiscountPrice(&$price)
    {

        if (is_array($result = $this->validateDiscount())) {
            return false;
        }

        if ($this->_discount->discount_type == Discounts::TYPE_PERCENT) {
            $price -= $price * $this->_discount->discount_size / 100;

        } else {
            $price -= $this->_discount->discount_size;
        }

        return true;
    }

    /**
     * @return array|bool
     */
    private function validateDiscount()
    {
        if (UsedDiscounts::find()->where(['discount_id' => $this->_discount->id, 'user_id' => Yii::$app->user->id])->exists()) {
            Yii::$app->response->statusCode = 400;
            return [
                'message' => 'Ви вже використовували цей код',
                'status'  => 'Помилка',
                'class'   => 'error',
            ];
        }

        if (is_integer($this->_discount->limit) && $this->_discount->limit <= 0 || ($this->_discount->deadline && $this->_discount->deadline < time()) || SessionHelper::getParams('cart.discount_id')) {
            return [
                'message' => 'Використання цього коду неможливе',
                'status'  => 'Помилка',
                'class'   => 'error',
            ];
        }

        if ($this->_discount->min_price) {

            if ($this->$this->_discount > $this->totalPrice) {
                return [
                    'message' => 'Мінімальна вартість замовлення для використання коду - ' . $this->_discount->min_price . Yii::$app->config->getValue('currency'),
                    'status'  => 'Помилка',
                    'class'   => 'error',
                ];
            }
        }

        return true;
    }
}