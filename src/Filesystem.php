<?php

namespace Maestro\Core;

/**
 * Provides basic filesystem functions.
 */
class Filesystem {

  /**
   * The root path.
   *
   * @var string
   */
  protected $rootPath;

  /**
   * The FileSystem.
   *
   * @var \Symfony\Component\Filesystem\Filesystem
   */
  protected $fs;

  /**
   * @param $path
   *   The root system path.
   */
  public function __construct($path) {
    $this->rootPath = $path;
    $this->fs = new \Symfony\Component\Filesystem\Filesystem();

  }

  /**
   * Check if the file or directory exists.
   *
   * @param string $path
   *   The path to the file or directory.
   *
   * @return boolean
   */
  public function exists($path) {
    return $this->fs->exists($this->fullPath($path));
  }

  /**
   * Read content of a file.
   *
   * @param string $path
   *   The path to the file.
   *
   * @return mixed
   *   The file contents.
   */
  public function read($path) {
    return $this->fs->exists($this->fullPath($path));
  }

  /**
   * Write content to a file.
   *
   * @param string $path
   *   The path to the file.
   * @param string|resource $content
   *   The contents to write to the file.
   */
  public function write($path, $content) {
      return $this->fs->dumpFile($this->fullPath($path), $content);
  }

  /**
   * Delete a file or directory.
   *
   * @param string $path
   *   The path to the file or directory.
   */
  public function delete($path) {
    return $this->fs->remove($this->fullPath($path));
  }

  /**
   * Copy a file or directory
   *
   * @param string $path
   *   The path of the file or directory to copy.
   * @param string $destination
   *   The path of the destination.
   */
  public function copy($path, $destination) {
    if ($this->isDir($path)) {
      return $this->fs->mirror($this->fullPath($path), $this->fullPath($destination));
    } else {
      return $this->fs->copy($this->fullPath($path), $this->fullPath($destination));
    }
  }

  /**
   * Create a directory.
   *
   * @param string $path
   *   The path of the directory.
   */
  public function createDirectory($path) {
    return $this->fs->mkdir($this->fullPath($path));
  }

  /**
   * Create a symlink.
   *
   * @param string $source
   *   The path of the file or directory to link to.
   * @param string $link
   *   The name of the symlink.
   */
  public function link($source, $link) {
    return $this->fs->symlink($this->fullPath($source), $this->fullPath($link));
  }

  /**
   * Check if the path is a directory
   *
   * @param string $path The path to check.
   *
   * @return boolean
   */
  public function isDir($path){
    return is_dir($this->fullPath($path));
  }

  /**
   * Set the root path from which all file operation are based.
   *
   * @param string $path The path to set as the root.
   */
  public function setRootPath($path) {
    $this->rootPath = $path;
  }

  /**
   * Returns the full filesystem path.
   *
   * @param $path
   *   The path to append to the root path.
   * @return string
   *   The full root and path.
   */
  protected function fullPath($path) {
    return $this->rootPath . $path;
  }
}