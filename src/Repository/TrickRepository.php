<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 21:07
 */

namespace App\Repository;


use App\Entity\Trick;
use Doctrine\ORM\EntityRepository;

class TrickRepository extends EntityRepository
{
    public function getTricks()
    {
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class);
    }

}