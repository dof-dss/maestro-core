<?php

namespace Maestro\Core;

/**
 * Interface for filesystem services.
 */
interface FilesystemInterface {

  /**
   * Check if the file or directory exists.
   *
   * @param string $path
   *   The path to the file or directory.
   *
   * @return boolean
   */
  public function exists($path);

  /**
   * Read content of a file.
   *
   * @param string $path
   *   The path to the file.
   *
   * @return mixed
   *   The file contents.
   */
  public function read($path);


  /**
   * Write content to a file.
   *
   * @param string $path
   *   The path to the file.
   * @param mixed $content
   *   The contents to write to the file.
   */
  public function write($path, $content);

  /**
   * Delete a file or directory.
   *
   * @param string $path
   *   The path to the file or directory.
   */
  public function delete($path);

  /**
   * Copy a file.
   *
   * @param string $path
   *   The path of the file to copy.
   * @param string $destination
   *   The path of the destination.
   */
  public function copy($path, $destination);

  /**
   * Copy a file.
   *
   * @param string $path
   *   The path of the file to copy.
   * @param string $destination
   *   The path of the destination.
   */
  public function copyDirectory($path, $destination);

  /**
   * Create a directory.
   *
   * @param string $path
   *   The path of the directory.
   */
  public function createDirectory($path);

  /**
   * Return the contents of a path.
   *
   * @param string $path
   *   The path to retrieve a list of contents.
   */
  public function pathContents($path);

  /**
   * Create a symlink.
   *
   * @param string $source
   *   The path of the file or directory to link to.
   * @param string $link
   *   The name of the symlink.
   */
  public function link($source, $link);

}
