<?php


namespace Bda\Rdashk\Classes;


class Driver
{
    private $type;
    private $car_id;
    private $name;
    private $id;

    public function __construct($type = 'default', $name, $id)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->car_id = -1;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCarId()
    {
        return $this->car_id;
    }

    /**
     * @param mixed $car_id
     */
    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }


}