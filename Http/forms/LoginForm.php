<?php

namespace http\forms;

use core\Validator;
use core\ValidationException;

class LoginForm 
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if(! Validator::string($attributes['username'])) {
            $this->errors['username'] = 'Please provide a valid username';
        }

        if(! Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password';
        }

    }

    public static function validate($attributes)
    {   
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
        
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);

    }

    public function failed()
    {
        return count($this->errors());
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