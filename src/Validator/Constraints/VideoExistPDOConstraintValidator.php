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

        $url = $value;

        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($handle);
        // get the http response status
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        //if the status is not equal to 200, trow violation message
        if ($httpCode != 200 ) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}