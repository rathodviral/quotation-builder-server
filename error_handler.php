<?php
class ErrorHandler
{
  public function errorHandling($error)
  {
    http_response_code(200);
    if ($error === 'body') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. Body not found.")
      ));
    }
    if ($error === 'id') {
      die(json_encode(
        array("status" => false, "message" => "Opps.. Id not found.")
      ));
    }
  }
}
