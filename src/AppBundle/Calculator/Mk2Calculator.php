<?php

declare(strict_types=1);
namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk2Calculator implements CalculatorInterface 
{
    
    protected $supportedModel = 'mk2';
    // change details available
    protected $supportedChange = [
        'bill10' => 10,
        'bill5' => 5,
        'coin2' => 2];
    
    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string 
    {
        return $this->supportedModel;
    }

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {
        $change = new Change();
        
        // change detail process
        while($amount >= 2){
            foreach($this->supportedChange as $key => $value){
                if($amount >= $value){
                    $amount -= $value;
                    $change->{$key}++;
                    break 1; // only for the foreach
                }
            }
        }
        
        // Failed to change the whole amount
        if($amount > 0){
            $change = null;
        }
        
        return $change;
    }
}
