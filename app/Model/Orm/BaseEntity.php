<?php

namespace App\Model;


use Nette\Utils\ArrayHash;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Entity\IEntity;

class BaseEntity extends Entity
{
    /**
     * Set values
     * @param array|ArrayHash $values
     * @return BaseEntity
     */
    public function setValues(array|ArrayHash $values): self
    {
        foreach ($values as $key => $value)
        {
            $this->setValue($key, $value);
        }
        return $this;
    }

    /**
     * @param array|ArrayHash $values
     * @return IEntity
     */
    public function setValuesAndPersist(array|ArrayHash $values): IEntity
    {
        $entity = $this->setValues($values);
        return $this->getRepository()->persistAndFlush($entity);
    }
}