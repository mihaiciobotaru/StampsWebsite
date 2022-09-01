<?php

namespace app\core;

require_once("core/db/DbModel.php");

use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function  getDisplayName(): string;
}
