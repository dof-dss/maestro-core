<?php

namespace Maestro\Core\Filesystem;

use Symfony\Component\Yaml\Yaml;

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
    $path = $this->fullPath($path);

    if (!$this->fs->exists($path)) {
      return NULL;
    }

    switch (pathinfo($path, PATHINFO_EXTENSION)) {
      case 'yaml':
      case 'yml':
        return Yaml::parseFile($path);

      case 'env':
        return parse_ini_file($path);

      default:
        return file_get_contents($path);

    }
  }

  /**
   * Write content to a file.
   *
   * @param string $path
   *   The path to the file.
   * @param mixed $content
   *   The contents to write to the file.
   */
  public function write($path, $content) {
    $path = $this->fullPath($path);

    if (str_ends_with($path, '.env')) {
      $content = self::arrayToIni($content);
    }

    if (str_ends_with($path, '.yml') || str_ends_with($path, '.yaml')) {
      $content = Yaml::dump($content, 6);
    }

    $this->fs->dumpFile($path, $content);
  }

  /**
   * Delete a file or directory.
   *
   * @param string $path
   *   The path to the file or directory.
   */
  public function delete($path) {
    $this->fs->remove($this->fullPath($path));
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
    $path = $this->fullPath($path);
    $destination = $this->fullPath($destination);

    if ($this->isDir($path)) {
      $this->fs->mirror($path, $destination);
    } else {
      $this->fs->copy($path, $destination);
    }
  }

  /**
   * Create a directory.
   *
   * @param string $path
   *   The path of the directory.
   */
  public function createDirectory($path) {
    $this->fs->mkdir($this->fullPath($path));
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
    $this->fs->symlink($this->fullPath($source), $this->fullPath($link));
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
    // If the path starts with a double slash do not prepend the rootPath.
    if (str_starts_with($path, '//')) {
      return substr($path, 1, strlen($path));
    }

    return $this->rootPath . $path;
  }

  /**
   * Convert arrays to ini file format.
   *
   * @param array $data
   *   Array of data to be written.
   * @param int $i
   *   Ini file index.
   *
   * @return string
   *   string of ini format data.
   */
  protected static function arrayToIni(array $data, $i = 0) {
    $str = "";
    foreach ($data as $key => $val) {
      if (is_array($val)) {
        $str .= str_repeat(" ", $i * 2) . "[$key]" . PHP_EOL;
        $str .= self::arrayToIni($val, $i + 1);
      }
      else {
        $str .= str_repeat(" ", $i * 2) . "$key = $val" . PHP_EOL;
      }
    }
    return $str;
  }

}