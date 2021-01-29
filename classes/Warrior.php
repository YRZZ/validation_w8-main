<?php

class Warrior extends Character
{
    public $critic = false;

    public function turn($target) {
        $rand = rand(1, 10);
        if ($rand <= 2 && !$this->critic) {
            $status = $this->boost();
        } else {
            $status = $this->attack($target);
        }
        return $status;
    }

    public function attack($target) {
        if ($this->critic) {
            $rand = rand(15, 30)/10;
            $criticDamage = $this->damage * $rand;
            $target->setHealthPoints($criticDamage);
            $this->critic = false;
        } else {
            $target->setHealthPoints($this->damage);
        }
        $status = "$this->name donne un coup d'épée à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

    public function boost() {
        $this->critic = true;
        $status = "$this->name se prépare à donner un gros coup !";
        return $status;
    }
}


