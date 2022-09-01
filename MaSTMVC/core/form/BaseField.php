<?php

namespace app\core\form;

require_once("core/Model.php");

use app\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString(): string
    {
        return sprintf(
            '
                %s
                <div class="row error-field">
                        <p style="color: red;">%s</p>
                </div>
        ',
//            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
