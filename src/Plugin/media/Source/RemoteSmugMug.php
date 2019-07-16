<?php
namespace Drupal\media_entity_smugmug_remote\Plugin\media\Source;

use \Drupal\Core\Config\ConfigFactoryInterface;
use \Drupal\Core\Entity\EntityFieldManagerInterface;
use \Drupal\Core\Entity\EntityTypeManagerInterface;
use \Drupal\Core\Render\RendererInterface;
use \Drupal\media\MediaInterface;
use \Drupal\media\MediaSourceBase;
use \Drupal\media\MediaTypeInterface;
use \Drupal\media\MediaSourceFieldConstraintsInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Drupal\Core\Field\FieldTypePluginManagerInterface;

/**
 * Provides media type plugin for remote smugmug images
 *
 * @MediaSource(
 *  id = "remote_smugmug",
 *  label = @Translation("Remote Smugmug"),
 *  description = @Translation("Use remote smugmug images in as media source"),
 *  allowed_field_types = {"string", "string_long", "link"},
 *  default_thumbnail_filename = "RemoteImage.png"
 * )
 */
class RemoteSmugMug extends MediaSourceBase implements MediaSourceFieldConstraintsInterface {
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, EntityFieldManagerInterface $entity_field_manager, FieldTypePluginManagerInterface $field_type_manager, ConfigFactoryInterface $config_factory, RendererInterface $renderer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $entity_type_manager, $entity_field_manager, $field_type_manager, $config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('entity_field.manager'),
      $container->get('plugin.manager.field.field_type'),
      $container->get('config.factory'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getMetadataAttributes() {
    $fields = NULL;
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getSourceFieldConstraints() {
    return ['RemoteSmugMugUrl' => []];
  }

  /**
   * {@inheritdoc}
   */
  public function createSourceField(MediaTypeInterface $type) {
    return parent::createSourceField($type)->set('label', 'Remote SmugMug Url');
  }

  /**
   * {@inheritdoc}
   * Check if it is url, has smugmug domain and has image extension
   */
  public $validationRegexp = ['/^(https?)\:\/\/[a-zA-z0-9\.]*\.?[a-zA-Z0-9]+\.[a-z]+\/?[a-zA-Z0-9\.\?\&\=\!\/]*$/', '^(https)\:\/\/(api|www|photos|cdn)\.(smugmug)\.(com)\/[a-zA-Z0-9\.\?\&\=\!\/]*$', '^(https)\:\/\/(api|www|photos|cdn)\.(smugmug)\.(com)\/[a-zA-Z0-9\.\?\&\=\!\/]+\.(jpg|jpeg|png)$'];

}
