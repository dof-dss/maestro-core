<?php

namespace Maestro\Core;

class Filesystem {

  protected $rootPath;
  protected $fs;

  public function __construct($path) {
    $this->rootPath = $path;
    $this->fs = new \Symfony\Component\Filesystem\Filesystem();

  }

  public function exists($path) {
    return $this->fs->exists($this->fullPath($path));
  }

  public function read($path) {
    return $this->fs->exists($this->fullPath($path));
  }

  public function write($path, $content) {
      return $this->fs->dumpFile($this->fullPath($path), $content);
  }

  public function delete($path) {
    return $this->fs->remove($this->fullPath($path));
  }

  public function copy($path, $destination) {
    if ($this->isDir($path)) {
      return $this->fs->mirror($this->fullPath($path), $this->fullPath($destination));
    } else {
      return $this->fs->copy($this->fullPath($path), $this->fullPath($destination));
    }
  }

  public function createDirectory($path) {
    return $this->fs->mkdir($this->fullPath($path));
  }

  public function link($source, $link) {
    return $this->fs->symlink($this->fullPath($source), $this->fullPath($link));
  }

  public function isDir($path){
    return is_dir($this->fullPath($path));
  }

  protected function fullPath($path) {
    return $this->rootPath . $path;
  }
}