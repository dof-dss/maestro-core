<?php

namespace Maestro\Core;

use Maestro\Core\Filesystem\Filesystem;
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
   * @param \Maestro\Core\Filesystem\Filesystem $fs
   *   Filesystem instance.
   * @param \Maestro\Core\ProjectInterface $project
   *   Filesystem instance.
   */
  public function build(StyleInterface $io, Filesystem $fs, ProjectInterface $project);

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
