<?php

namespace app\models;

class Test
{

    private string $name;
    private int $age;

    public function __construct(
        string $name,
        int $age
    )
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }



//    public string $name;
//    public int $age;

}