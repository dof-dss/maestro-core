<?php

namespace Maestro\Core;

/**
 * Interface for Maestro Project definition.
 */
interface ProjectInterface {

  /**
   * Save the project.
   */
  public function save();

  /**
   * Add a site to the project.
   *
   * @param string $site_id
   *   Site identifier.
   * @param array $site_data
   *   Site configuration data.
   */
  public function addSite(string $site_id, array $site_data);

  /**
   * Update a site within the project.
   *
   * @param string $site_id
   *   Site identifier.
   * @param array $site_data
   *   Site configuration data.
   */
  public function updateSite(string $site_id, array $site_data);

  /**
   * Remove a site from the project.
   *
   * @param string $site_id
   *   Site identifier.
   */
  public function removeSite(string $site_id);

  /**
   * Project name.
   *
   * @return string|null
   *   The project name.
   */
  public function name();

  /**
   * Project ID.
   *
   * @return string|null
   *   The project ID.
   */
  public function id();

  /**
   * Project type.
   *
   * @return string|null
   *   The project type.
   */
  public function type();

  /**
   * Sites for the project.
   *
   * @return array
   *   Array of project sites.
   */
  public function sites();

  /**
   * Determine if a site exists in the Project.
   *
   * @return bool
   *   True if site exists, otherwise false.
   */
  public function siteExists($site_id);

}
