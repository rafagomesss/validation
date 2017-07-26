# Validator

O Validator é uma classe de validação baseada em PHP que permite validar quaisquer dados.

# Instalação

via composer.

```
$ composer require mammoth-php/validation
``` 

# Exemplo de Validação dos dados

`Dados`

``` php
$datas = [
   'nome'  => 'Mammoth',
   'email' => 'mammoth.support@web.com',
   'senha' => 'mammoth.web'
];
```

`Regras`

``` php
$rules = [
   'nome'  => 'required|regex:/^[a-zA-Z\s]+$/',
   'email' => 'required|email|max:50',
   'senha' => 'required|min:8|max:12'
];
 ```
 
 `Validando os dados de acordo com as regras`
 
 ``` php
   $validator = new Mammoth\Validation\Validator();

   $validator->set($datas, $rules);
   
   //Verificando a validação
   if(!$validator->getErros()){
        echo 'Dados válidados com sucesso!';
    } else {
        var_dump($validator->getErros());
    }
 ```
 
 # Usando
 
 ``` php
 <?php
 
    require 'vendor/autoload.php';
   
    $validator = new Mammoth\Validation\Validator();
    
    $datas = [
        'nome'  => 'Mammoth',
        'email' => 'mammoth.support@web.com',
        'senha' => 'mammoth.web'
    ];
    
    $validator->set($datas, [
        'nome'  => 'required|regex:/^[a-zA-Z\s]+$/, O campo nome só deve conter caracteres alfabéticos.',
        'email' => 'required|email|max:50',
        'senha' => 'required|min:8|max:12'
    ]);
    
    if(!$validator->getErros()){
        echo 'Dados válidados com sucesso!';
    } else {
        var_dump($validator->getErros());
    }
```

# Tipos de validação

* required:              ` Define o campo como obrigatório. `
* min:                   ` Define o tamanho mínimo do valor. `
* max:                   ` Define o tamanho máximo do valor. `
* bool:                  ` Valores do tipo lógico. ` `Ex: true ou false, 1 ou 0, yes ou no.`
* email:                 ` Verfica se é um email válido. `
* float:                 ` Define o valor como tipo flutuante(valor real). `
* int:                   ` Define o valor como tipo inteiro. `
* ip:                    ` Verifica se o valor é um endereço de IP válido. `
* mac:                   ` Verifica se o valor é um endereço de MAC válido. `
* regex:                 ` Define uma regra para o valor através de uma expressão regular. `
* url:                   ` Verifica se o valor é um endereço de URL válida. `

# Definindo mensagem personalizada

Após definir algumas de nossas regras aos dados você também pode adicionar uma mensagem personalizada usando o delimitador ',' em alguma regra específica ou usar a mensagem padrão.

`Exemplo:`

``` php 
<?php

    $validator->set($datas, [
        'nome'  => 'required, O campo nome não pode ser vazio.',
        'email' => 'email, O campo email esta incorreto.|max:50',
        'senha' => 'min:8, no mínimo 8 caracteres.|max:12, no máximo 12 caracteres.'
    ]);
```
Recomendamos o uso quando se define uma regra através de uma expressão regular. 

# Licença

O validator é uma aplicação open-source licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).
