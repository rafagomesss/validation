<?php

namespace Mammoth\Validation;


class Validator {
    
    
    /**
     * @var type 
     */
    
    
    private $erros = FALSE;

    
    /**
     * -------------------------------------------------------------------------
     * Setando/Definindo regras para determinados dados.
     * -------------------------------------------------------------------------
     * 
     * @param array $datas
     * @param array $rules
     */
    
    
    public function set(array $datas, array $rules) {
        foreach($rules as $ruleKey => $ruleValue){
            if(isset($datas[$ruleKey])){
                $this->rules($datas[$ruleKey], $ruleKey, $ruleValue);
            }
        }
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Definindo mais de uma regra para um determinado dado.
     * -------------------------------------------------------------------------
     * 
     * @param type $data
     * @param type $ruleKey
     * @param type $ruleValue
     */
    
    
    private function rules($data, $ruleKey, $ruleValue) {
        $conditions = explode('|', $ruleValue);
        
        foreach($conditions as $condition){
            if(!isset($this->erros[$ruleKey])):
                $this->validate($condition, $data, $ruleKey);
            endif;
            
        }
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * Regras de validação para os dados.
     * ------------------------------------------------------------------------- 
     * 
     * @param type $condition
     * @param type $data
     * @param type $ruleKey
     */
    
    
    private function validate($condition, $data, $ruleKey) {
        $message = explode('@', $condition);
        $item    = explode(':', $message[0]);
        
        switch($item[0]):
            case 'required':
                if(empty($data) || $data == '' || $data == ' '){
                    $this->erros["$ruleKey"] = $message[1] ?? "O campo $ruleKey é obrigatório.";
                }
            break;
            case 'max':
                if(strlen($data) > $item[1]){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey precisa conter no máximo $item[1] caracteres.";
                }
            break;
            case 'min':
                if(strlen($data) < $item[1]){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey precisa conter no mínimo $item[1] caracteres.";
                }
            break;
            case 'bool':
                if(!filter_var($data, FILTER_VALIDATE_BOOLEAN)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey só pode conter valores lógicos. (true|false, 1|0, yes|no).";
                }
            break;
            case 'email':
                if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey é necessário que seja um email válido.";
                }
            break;
            case 'float':
                if(!filter_var($data, FILTER_VALIDATE_FLOAT)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey deve ser do tipo real.";
                }
            break;
            case 'int':
                if(!filter_var($data, FILTER_VALIDATE_INT)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey deve ser do tipo inteiro.";
                }
            break;
            case 'ip':
                if(!filter_var($data, FILTER_VALIDATE_IP)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey deve ser um IP válido.";
                }
            break;
             case 'mac':
                if(!filter_var($data, FILTER_VALIDATE_MAC)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey deve ser um MAC válido.";
                }
            break;
            case 'regex':
                if(!preg_match($item[1], $data) !== FALSE){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey deve corresponder com as expecificações requisitadas.";
                }
            break;
            case 'url':
                if(!filter_var($data, FILTER_VALIDATE_URL)){
                    $this->erros["$ruleKey"] = $message[1] ??  "O campo $ruleKey é necessário que seja uma URL válida.";
                }
            break;
        endswitch;
    }


    /**
     * -------------------------------------------------------------------------
     * Retorna todos os erros possíveis.
     * -------------------------------------------------------------------------
     * 
     * @return type
     */
    
    
    public function getErros() {
        return $this->erros;
    }
    
} 

