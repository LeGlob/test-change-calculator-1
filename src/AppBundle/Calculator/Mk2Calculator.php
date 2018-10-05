<?php

declare(strict_types = 1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk2Calculator implements CalculatorInterface
{

    protected $supportedModel = 'mk2';
    // change values available
    protected $supportedChange = [10, 5, 2];

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
        $result = $this->processChange($amount, $this->supportedChange);

        if ($result !== null) {
            $change = new Change();
            $change->fromArray($result);
        } else {
            $change = null;
        }

        return $change;
    }

    /**
     * Calculate the change with given change values
     * @param int $amount Amount to change
     * @param array $changeValues change values available
     * @param array $result
     * @return array|null
     */
    private function processChange(int $amount, array $changeValues, $result = array())
{
        if ($amount === 0) {
            // Succes, Change process done
            return $result
        }

        $changeValue = array_shift($changeValues);
        if ($changeValue === null) {
            // Failed, no more change value to check
            return null;
        }

        // We keep the original amount and result for later
        $amountOrigin = $amount;
        $resultOrigin = $result;

        // Convertion
        $result[$changeValue] = 0;
        while ($amount >= $changeValue) {
            $amount -= $changeValue;
            $result[$changeValue] ++;
        }

        // Keep going with the rest of change values
        $result = $this->processChange($amount, $changeValues, $result);
        if ($result !== null) {
            // Success
            return $result;
        } else {
            // Failed so we try with the original amount
            return $this->processChange($amountOrigin, $changeValues, $resultOrigin);
        }
    }

}
