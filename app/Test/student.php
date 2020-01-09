<?php
/**
 * Created by PhpStorm.
 * User: netwons
 * Date: 10/9/19
 * Time: 4:12 PM
 */

namespace App\Test;


class student
{
    private $name;
    private $family;
    public function setName(string $name)
    {
        $this->name=strtolower($name);
    }

    public function getName()
    {
       return $this->name;
    }

    public function setfamily(string $family)
    {
        $this->family=$family;
    }

    public function getfamily()
    {
        return $this->family;
    }

    public function fullname()
    {
        return $this->getName().' '.$this->getfamily();
    }
}