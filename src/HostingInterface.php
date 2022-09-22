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

  /**
   * Service name.
   *
   * @return string
   *   Human-readable name of the service.
   */
  public function name(): array;

  /**
   * Service instructions.
   *
   * @return array
   *   Array of additional instructions.
   */
  public function instructions(): array;

}
