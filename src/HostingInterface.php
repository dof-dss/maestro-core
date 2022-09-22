<?php

namespace Maestro\Core;

use League\Flysystem\FilesystemAdapter;
use Symfony\Component\Console\Style\StyleInterface;

/**
 * Interface for hosting services.
 */
interface HostingInterface {

  /**
   * Generates the hosting setup and configuration.
   *
   * @param \Symfony\Component\Console\Style\StyleInterface $io
   *   Symfony style instance.
   * @param \League\Flysystem\FilesystemAdapter $fs
   *   Filesystem instance.
   */
  public function build(StyleInterface $io, FilesystemAdapter $fs, ProjectInterface $project);
}
