<?php


namespace Bda\Rdashk\Classes;


class Car
{
    private $brand;
    private $breakdown;
    private $id;

    /**
     * Car constructor.
     * @param string $brand
     * @param int $id
     * @param int $breakdown устанавливаем -1, для проверки на новый авто
     */
    public function __construct($brand = "Luda", $id = 0, $breakdown = -1)
    {
        $this->brand = $brand;
        $this->id = $id;
        $this->breakdown = $breakdown;
    }

    /**
     * @return mixed|string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed|string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|mixed
     */
    public function getBreakdown()
    {
        return $this->breakdown;
    }

    /**
     * @param int|mixed $breakdown
     */
    public function setBreakdown($breakdown)
    {
        $this->breakdown = $breakdown;
    }

}