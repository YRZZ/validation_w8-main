<?php

class Archer extends Character
{
    private $double = false;
    private $quiver = 10;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->damage = 10;
    }

    public function turn($target)
    {
        $rand = rand(1, 10);
        if ($this->quiver == 0) {
            $status = $this->attack($target);
        } else if ($this->double) {
            $status = $this->doubleArrow($target);
            $status .= $this->simpleArrow($target);
            $this->double = false;
        } else if ($rand > 8) {
            $status = $this->doubleArrow($target);
        } else if ($rand > 6) {
            $status = $this->precisionArrow($target);
        } else if ($rand <= 6) {
            $status = $this->simpleArrow($target);
        }
        return $status;
    }

    public function simpleArrow($target) {
        if ($this->quiver > 0) {
            $arrowDamage = $this->damage;
            $this->quiver -= 1;
        }
        $target->setHealthPoints($arrowDamage);
        $status = "$this->name tire une flèche sur $target->name à qui il reste $target->healthPoints points de vie ! Il reste $this->quiver flèches dans le carquois de $this->name !";
        return $status;
    }

    public function doubleArrow($target) {
        $this->double = true;
        return "$this->name prépare plusieurs flèches!";
    }

    public function precisionArrow($target) {
        if ($this->quiver > 0) {
            $arrowDamage = $this->damage * (rand(15, 30)/10);
            $this->quiver -= 1;
        }
        $target->setHealthPoints($arrowDamage);
        $status = "$this->name tire une flèche très précise sur $target->name à qui il reste $target->healthPoints points de vie ! Il reste $this->quiver flèches dans le carquois de $this->name !";
        return $status;
    }

    public function setHealthPoints($damage) {
        $this->healthPoints -= round($damage);
        $this->double = false;
        $this->isAlive();
        return;
    }

    public function attack($target) {
        $target->setHealthPoints($this->damage/2);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
}