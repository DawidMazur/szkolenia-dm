if(document.getElementById('podstawowy_js')) {
    var global_var = "Zmienna globalna";

    function example_function() {
        return "Przykładowa funkcja";
    }
    
    // funkcje można przypisywać do zmiennych i wykonywać
    
    var ex_func = function () {
        console.log('Działa');
    }
    
    ex_func();
    
    // funkcja strzałkowa
    
    var arrow_func = (parr) => {
        console.log(parr);
    }
    
    arrow_func('Arrow też działa');

    class ExampleClass {
        constructor() {
            this.var = "Zmianna";
        }
        
        method($parr) {
            console.log('CLASS ' + $parr)
        }
    }

    let exmpleClass = new ExampleClass();
    exmpleClass.method('class_method');
}
