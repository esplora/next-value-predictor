<?php

namespace Esplora\Predictor\Tests;

use Esplora\Predictor\Predictor;
use PHPUnit\Framework\TestCase;

class PredictorTest extends TestCase
{
    /**
     * @return void
     */
    public function testPredictorForOneValue(): void
    {
        $predictor = new Predictor([10]);

        $this->assertEquals(10.0, $predictor->predict());
        $this->assertEquals(0.5, $predictor->probabilityGreaterThan(10));
    }

    /**
     * Note: the probability is not 100% because the predictor is not perfect
     *
     * @return void
     */
    public function testPredictorSets(): void
    {
        $predictor = new Predictor([1, 3, 1, 4, 2, 4, 3, 1, 4, 1, 4, 2, 1, 4, 5]);

        $this->assertEqualsWithDelta(3.004, $predictor->predict(), 0.001);

        // Edge cases
        $this->assertEquals(0.0, $predictor->probabilityGreaterThan(5));
        $this->assertEquals(1.0, $predictor->probabilityGreaterThan(0));

        // Likely
        $this->assertEquals(0.99, $predictor->probabilityGreaterThan(1));
        $this->assertEquals(0.37, $predictor->probabilityGreaterThan(2));
        $this->assertEquals(0.1, $predictor->probabilityGreaterThan(3));
        $this->assertEquals(0.03, $predictor->probabilityGreaterThan(4));
    }

    /**
     * Weights are an optional set of weighting parameters
     * for the different classes, to help account for unbalanced training sets.
     *
     * @return void
     */
    public function testPredictorWeights(): void
    {
        $predictor = new Predictor([1, 3, 1, 4, 2, 4, 3, 1, 4, 1, 4, 2, 1, 4, 5]);

        $this->assertEquals(5.0, $predictor->predict(0.0));
        $this->assertEqualsWithDelta(1.789, $predictor->predict(0.5), 0.001);
        $this->assertEqualsWithDelta(1, $predictor->predict(1), 0.001);
    }
}
