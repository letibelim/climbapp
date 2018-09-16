<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 02/09/18
 * Time: 20:16
 */

namespace App\Tool;

use Doctrine\Common\Comparable;

class Cotation implements Comparable
{
    const pattern = '/([1-9])([abcABC])(\+*)/';
    /**
     * @var string
     */
    private $label;

    public function __construct($label)
    {
        $valid = preg_match(self::pattern, $label, $composition);
        if(!$valid){
            throw new \Exception($label . ' is not a valid grade');
        }

        $lowerCaselabel = preg_replace_callback('/[ABC]/', function($letter){ return strtolower($letter[0]);}, $label);
        $this->setLabel($lowerCaselabel);
    }

    /**
     * @param string $label
     *
     * @return Cotation
     */
    public function setLabel(string $label): Cotation
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Compares the current object to the passed $other.
     *
     * Returns 0 if they are semantically equal, 1 if the other object
     * is less than the current one, or -1 if its more than the current one.
     *
     * This method should not check for identity using ===, only for semantical equality for example
     * when two different DateTime instances point to the exact same Date + TZ.
     *
     * @param Cotation $other
     *
     * @return int
     */
    public function compareTo($other)
    {
        if ($this->labelToNumber() > $other->labelToNumber()) return 1;
        if($this->labelToNumber() == $other->labelToNumber()) return 0;
        if($this->labelToNumber() < $other->labelToNumber()) return -1;
    }

    public static function isValid($label)
    {
        return preg_match(self::pattern, $label);
    }

    public function labelToNumber()
    {
        $letters = ['a','b','c'];
        preg_match(self::pattern, $this->label, $composition);
        $degree = $composition[1];
        $letter = strtolower($composition[2]);
        $composition[3] === '+'? $plus = 1 : $plus = 0;

        return $degree * 10**2 + array_search($letter, $letters) * 10 +  $plus;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}