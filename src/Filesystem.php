<?php

namespace Maestro\Core;

class Filesystem {

  protected $rootPath;

  public function __construct($path) {
    $this->rootPath = $path;
  }

  public function exists($path) {

  }

  public function read($path) {

  }

  public function write($path, $content) {

  }

  public function delete($path) {

  }

  public function copy() {

  }

  public function createDirectory($path) {

  }

  public function link($source, $link) {

  }

  protected function fullPath($path) {
    return $this->rootPath . $path;
  }
}