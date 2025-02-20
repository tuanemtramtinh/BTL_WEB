<?php

class ExampleModel extends DB {
  public function getData() {
      // Here you could connect to a database and retrieve data
      return ['message' => 'Hello from the model!'];
  }
}