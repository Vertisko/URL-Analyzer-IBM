<?php


namespace App\Services\DTO;

abstract class BaseDTO
{

    /**
     * BaseDTO constructor.
     *
     * @param array $values DTO values
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $name => $value) {
            if (method_exists($this, $method = "set" . ucfirst($name))) {
                $this->$method($value);
            }
        }
    }

    public function toArray(): array
    {
        return (get_object_vars($this));
    }
}
