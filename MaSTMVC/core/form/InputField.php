<?php

namespace app\core\form;

require_once("core/Model.php");
require_once("BaseField.php");

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;
    public string $placeholder;
    public function __construct(Model $model, string $attribute, $placeholder)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
        $this->placeholder=$placeholder;
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }


    public function renderInput(): string
    {
        return sprintf(
            '<input type="%s" name="%s" value="%s" placeholder="%s" >',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->placeholder
        );
    }
}
