#  Next Value Predictor

![Unit tests](https://github.com/esplora/next-value-predictor/workflows/Unit%20tests/badge.svg)

The Next Value Predictor is a PHP package that predicts the next value based on the previous values for a given data set. 
It considers the previous values and calculates the probability of the next value. 
The package is intended for use in applications that require predictive analysis capabilities.

## Installation

To use the package, run the following command in the command line:

```php
$ composer require esplora/next-value-predictor
```

## Usage

To use the package, instantiate the `Predictor` class, passing an array of previously recorded values as the parameter, and then call the `predict()` method to predict the next value.

```php
use Esplora\Predictor\Predictor;

$predictor = new Predictor([1, 3, 1, 4, 2, 4, 3, 1, 4, 1, 4, 2, 1, 4, 5]);

$predictor->predict(); // 3.004
```

Weights are optional and enable you to set weighting parameters for different categories of data to help balance unbalanced sets.
To use weights, pass in the desired weight as an argument for `predict()`.

```php
$predictor = new Predictor([1, 3, 1, 4, 2, 4, 3, 1, 4, 1, 4, 2, 1, 4, 5]);

$predictor->predict(0.0); // 5.0
$predictor->predict(0.5); // 1.789,
```


You can also use the `probabilityGreaterThan()` method to get the probability of the next value rate being greater than a certain number.

```php
$predictor->probabilityGreaterThan(5); // 0.0
$predictor->probabilityGreaterThan(0); // 1.0
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
