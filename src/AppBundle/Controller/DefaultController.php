<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * Send change details for a given amount.
     *
     * @param string $automaton automaton name (mk1|mk2|..)
     * @param int    $change    amount to change
     *
     * @return Response Json format if success
     */
    public function changeAction(string $automaton, int $amount)
    {
        $calculatorRegistry = $this->get('app.calculator.registry');

        $calculator = $calculatorRegistry->getCalculatorFor($automaton);
        if ($calculator === null) {
            return new Response(null, 404);
        }

        $resultChange = $calculator->getChange($amount);

        if ($resultChange !== null) {
            $json = json_encode($resultChange);
            $response = new Response($json);
        } else {
            // Failed
            $response = new Response(null, 204);
        }

        return $response;
    }
}
