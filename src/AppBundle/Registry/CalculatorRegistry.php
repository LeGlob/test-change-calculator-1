<?php

declare(strict_types=1);
namespace AppBundle\Registry;

use AppBundle\Registry\CalculatorRegistryInterface;
use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Calculator\Mk1Calculator;
use AppBundle\Calculator\Mk2Calculator;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    /**
     * @param string $model Indicates the model of automaton
     *
     * @return CalculatorInterface|null The calculator, or null if no CalculatorInterface supports that model
     */
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        $className = ucfirst($model).'Calculator';
        $fullClassName = "\AppBundle\Calculator\\" .$className;
        
        $calculator = null;
        if(class_exists($fullClassName)){
            $calculator = new $fullClassName;
        }
        
        return $calculator;
    }
}
