<?php

namespace Http\forms;

use core\Response;
use core\ValidationException;


class Validation 
{
    protected $errors = [];
    
    public function __construct(public array $data, array $fields, array $messages = [])
    {
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));
        $rule_messages = array_filter($messages, fn($message) => is_string($message));
        $validation_errors = array_merge(Response::DEFAULT_VALIDATION_ERRORS, $rule_messages);
    
        foreach ($fields as $field => $option) {
    
            $rules = $split($option, '|');
    
            foreach ($rules as $rule) {

                $params = [];

                if (strpos($rule, ':')) {
                    [$rule_name, $param_str] = $split($rule, ':');
                    $params = $split($param_str, ',');

                } else {
                    $rule_name = trim($rule);
                }

                $fn = 'is_' . $rule_name;
                
                if (method_exists(Validation::class, $fn)) {
                    $pass = static::$fn($data, $field, ...$params);

                    if (!$pass) {

                        $this->errors[$field] = sprintf(
                            $messages[$field][$rule_name] ?? $validation_errors[$rule_name],
                            $field,
                            ...$params
                        );

                    }
                }
            }
        }
    }

    public static function validate($data, $fields, $messages = [])
    {
        $instance = new static($data, $fields, $messages = []);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        return ValidationException::throw($this->errors(), $this->data);

    }

    public function failed()
    {
        return count($this->errors());
    }


    public static function is_required(array $data, string $field): bool
    {
        return isset($data[$field]) && trim($data[$field]) !== '';
    }


    public static function is_email(array $data, string $field): bool
    {
        if (empty($data[$field])) {
            return true;
        }
    
        return filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }
    

    public static function is_min(array $data, string $field, int $min): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
    
        return mb_strlen($data[$field]) >= $min;
    }
    

    public static function max(array $data, string $field, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
    
        return mb_strlen($data[$field]) <= $max;
    }
    

    public static function is_between(array $data, string $field, int $min, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
    
        $len = mb_strlen($data[$field]);
        return $len >= $min && $len <= $max;
    }


    public static function is_same(array $data, string $field, string $other): bool
    {
        if (isset($data[$field], $data[$other])) {
            return $data[$field] === $data[$other];
        }
    
        if (!isset($data[$field]) && !isset($data[$other])) {
            return true;
        }
    
        return false;
    }


    public static function is_alphanumeric(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
    
        return ctype_alnum($data[$field]);
    }
    


    public static function is_secure(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return false;
        }
    
        $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
        return preg_match($pattern, $data[$field]);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}