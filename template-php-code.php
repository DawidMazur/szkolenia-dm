<?php
/**
 * Template Name: Przykładowy php kod
 * @package ws
 */

// tworzenie zmiennej
$variable = "Wartość";
$variable = 123;
$variable = 123.10;

// tablicy
$variable = [
    'array'
];
// w starszych wersjach
$variable = array();
$variable[] = 'array';

// funkcja w php
function example_function($parametr = "default" ) {
    return 'example_function <br>';
}


// tworzenie class w php
class ExampleClass {
    // zmienna obiektu klasy
    public $public_var;
    private $private_var;
    public static $static_var;

    // konstruktor
    public function __construct() {
        echo 'Wywołuję się podczas tworzenia obiektu <br>';

        $this->public_var = "Public";
        $this->private_var = "Private";
        ExampleClass::$static_var = "Static";
    }

    // metody klasy
    public function example_method() {
        return 'example_method <br>';
    }

    public static function static_method() {
        return 'static_method <br>';
    }

}

// Jak w każdym języku do statycznych rzeczy można się odwołać bez obiektu
echo ExampleClass::$static_var;
echo ExampleClass::static_method();

// Tworzenie obiektu klasy
$example_Class = new ExampleClass();
// wywołanie methody obiektu
echo $example_Class->example_method();


//! statyczne rzeczy przez :: sie wykonuja
//! metody przez ->



// Debugowanie zmiennych / obiektów
// najprostrze możliwe
print_r($variable);

// to samo ale czytelniej
echo '<pre>';
print_r($variable);
echo '</pre>';

// z pomocą biblioteki kint-php
d($variable);
// biblioteka pozwala także debugować klasy
d($example_Class);