<?php


namespace itstefoneException;

use Exception;

class ForbiddenException extends Exception {

  public $statusCode = 403;

}