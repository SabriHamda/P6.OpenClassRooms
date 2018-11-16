<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class VideoExistPDOConstraintValidator extends ConstraintValidator
{



    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        $url = 'https://www.dailymotion.com/video/x6x7ceuw';
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        // get the http response status
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        //if the status is not equal to 200, trow error message
        if ($httpCode != 200 ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}