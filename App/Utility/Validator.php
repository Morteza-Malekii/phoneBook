<?php
namespace App\Utility;

class Validator
{
    private $data;
    private $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function required($field)
    {
        if (empty($this->data[$field])) {
            $this->errors[$field][] = "$field is required.";
        }
        return $this;
    }

    public function email($field)
    {
        if (!filter_var($this->data[$field] ?? '', FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "$field must be a valid email.";
        }
        return $this;
    }

    public function digits($field, $min = 10, $max = 14)
    {
        $value = $this->data[$field] ?? '';
        if (!preg_match("/^\d{{$min},{$max}}$/", $value)) {
            $this->errors[$field][] = "$field must be between $min and $max digits.";
        }
        return $this;
    }

    public function alpha($field)
    {
        if (!preg_match("/^[a-zA-Z\s]+$/", $this->data[$field] ?? '')) {
            $this->errors[$field][] = "$field must only contain letters.";
        }
        return $this;
    }

    public function fails()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
