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
    public $message = 'Désolé une des videos selectionées n\'existe pas';

}