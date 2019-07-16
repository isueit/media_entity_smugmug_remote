<?php
namespace Drupal\media_entity_smugmug_remote\Plugin\Validation\Constraint;

use \Symfony\Component\Validator\Constraint;

/**
 * Check for valid smugmug image url
 *
 * @constraint(
 *  id = "RemoteSmugMugUrl",
 *  label = @Translation("Remote SmugMug image Url", context = "Validation"),
 *  type = { "link", "string", "string_long" }
 * )
 */
class RemoteSmugMugUrlConstraint extends Constraint {
  /**
   * Default violation message
   */
  public $message = 'Not valid smugmug image url.';
}
