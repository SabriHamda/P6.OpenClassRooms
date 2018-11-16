<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Entity;

use App\Domain\Entity\Interfaces\CategoryInterface;
use Ramsey\Uuid\Uuid;

class Category implements CategoryInterface
{
    /**
     * @var
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @return Uuid
     */
    public function getId() : Uuid
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @throws \Exception
     */
    public function create($name)
    {
        $this->name = $name;
        $this->id = Uuid::uuid4();
    }

}