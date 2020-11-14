<?php

namespace Esplora\Predictor;

class Predictor
{
    /**
     * @var array
     */
    private $previousRates;

    /**
     * Predictor constructor.
     *
     * @param array $previousRates
     */
    public function __construct(array $previousRates)
    {
        $this->previousRates = $previousRates;
    }

    /**
     * Predict the next exchange rate based on the previous rates.
     *
     * @param float $alpha The alpha parameter (which determines the weight given to the most recent data)
     *
     * @return float
     */
    public function predict(float $alpha = 0.1): float
    {
        $n = count($this->previousRates);

        $prediction = $this->previousRates[$n - 1];

        for ($i = $n - 2; $i >= 0; $i--) {
            $prediction = $prediction + $alpha * ($this->previousRates[$i] - $prediction);
        }

        return abs($prediction);
    }

    /**
     * Calculate the probability that the next prediction will be greater than the given value.
     *
     * @param float $value
     *
     * @return float
     */
    public function probabilityGreaterThan(float $value): float
    {
        if (count($this->previousRates) < 2) {
            return 0.5;
        }

        $predictions = $this->getPredictions();

        $countGreaterThan = 0;
        $total = count($predictions);

        foreach ($predictions as $prediction) {
            if ($prediction > $value) {
                $countGreaterThan++;
            }
        }

        return $countGreaterThan / $total;
    }

    /**
     * Generate an array of predictions.
     *
     * @param int $count
     *
     * @return array
     */
    private function getPredictions(): array
    {
        $predictions = [];

        foreach (range(0.01, 1, 0.01) as $i) {
            $predictions[] = $this->predict($i);
        }

        return $predictions;
    }
}
