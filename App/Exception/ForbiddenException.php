<?php


namespace App\Exception;

use Exception;

class ForbiddenException extends Exception {

  public $statusCode = 403;

}