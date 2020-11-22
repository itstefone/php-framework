<?php


namespace itstefone\Exception;

use Exception;

class ForbiddenException extends Exception {

  public $statusCode = 403;

}