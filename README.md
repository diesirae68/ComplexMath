# ComplexMath
Class for complex numbers.

# Usage


```php

declare(strict_types=1);

require_once __DIR__ . '/src/Complex.php';

use RB\Math\Complex;

try {

    // Two random complex numbers
    $complex1 = new Complex(mt_rand(-1000, 1000), mt_rand(-1000, 1000));
    $complex2 = new Complex(mt_rand(-1000, 1000), mt_rand(-1000, 1000));

    // Addition
    $complex = $complex1->add($complex2);
    printf("%s + %s = %s;\n", $complex1, $complex2, $complex);

    // Subtraction
    $complex = $complex1->sub($complex2);
    printf("%s - %s = %s;\n", $complex1, $complex2, $complex);

    // Multiplication
    $complex = $complex1->mul($complex2);
    printf("%s * %s = %s;\n", $complex1, $complex2, $complex);

    // Division
    $complex = $complex1->div($complex2);
    printf("%s / %s = %s;\n", $complex1, $complex2, $complex);

} catch (\Throwable $e) {
    printf("Exception \"%s\" with message \"%s\" in %s on line %u", get_class($e), $e->getMessage(), $e->getFile(), $e->getLine());
} // end try
```
