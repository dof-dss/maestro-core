<?php

namespace Maestro\Core;

/**
 * Maestro utilities.
 */
class Utils {

  /**
   * Create a machine safe application ID.
   *
   * @param string $name
   *   Name of the project to create an ID for.
   *
   * @return string
   *   Machine safe application ID.
   */
  public static function createApplicationId($name) {
    return strtolower(str_replace(' ', '_', $name));
  }

  /**
   * Create a machine safe site ID.
   *
   * @param string $url
   *   Url to create a site ID for.
   *
   * @return string
   *   Machine safe site ID.
   */
  public static function createSiteId($url) {
    if ($url === 'https://info.library.nics.gov.uk') {
      $url = 'https://infolibrarynics.gov.uk';
    }
    else {
      $url = strtolower(str_replace('-', '', $url));
    }

    // Strip http, www and domain to leave site name.
    preg_match_all('/(http:\/\/)*(?:www\.)?([a-z0-9\-]+)(?:\.[a-z\.]+[\/]?).*/', $url, $matches, PREG_SET_ORDER, 0);
    return $matches[0][2];
  }

}
