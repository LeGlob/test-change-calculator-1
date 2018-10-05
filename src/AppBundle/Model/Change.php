<?php

declare(strict_types=1);

namespace AppBundle\Model;

class Change
{
    /**
     * @var int
     */
    public $bill10 = 0;

    /**
     * @var int
     */
    public $bill5 = 0;

    /**
     * @var int
     */
    public $coin2 = 0;

    /**
     * @var int
     */
    public $coin1 = 0;

    /**
     * Hydrate from an array with numeric keys.
     *
     * @param type $array [ 10 => 3, 5 => 0, 2 => 1]
     */
    public function fromArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 10:
                    $this->bill10 = $value;
                    break;

                case 5:
                    $this->bill5 = $value;
                    break;

                case 2:
                    $this->coin2 = $value;
                    break;

                case 1:
                    $this->coin1 = $value;
                    break;
            }
        }
    }
}
