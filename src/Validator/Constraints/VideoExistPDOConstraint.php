<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class VideoExistPDOConstraint extends Constraint
{
    /**
     * @var string
     */
    public $message = 'L\'url de cette video n\'existe pas';

}