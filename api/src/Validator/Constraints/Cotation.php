<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 16/09/18
 * Time: 12:02
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * Class Cotation
 * @Annotation
 * @package App\Validator\Constraints
 */
class Cotation extends Constraint
{
    public $message = 'This value "{{ value }}" is not a valid cotation';

}