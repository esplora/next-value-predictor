#  Next Value Predictor

![Unit tests](https://github.com/esplora/next-value-predictor/workflows/Unit%20tests/badge.svg)

Predict the next value rate based on the previous rates.

## Installation

Run this at the command line:

```php
$ composer require esplora/next-value-predictor
```

## Usage


```php
$predictor = new Predictor([1, 3, 1, 4, 2, 4, 3, 1, 4, 1, 4, 2, 1, 4, 5]);


$predictor->predict(); // 3.004
```


```php
$predictor->probabilityGreaterThan(5); // 0.0
$predictor->probabilityGreaterThan(0); // 1.0
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
