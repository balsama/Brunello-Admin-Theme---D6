<?php

/**
 * Override or insert variables into the page template.
 */
function brunello_admin_preprocess_page(&$vars) {
  $vars['primary_local_tasks'] = menu_primary_local_tasks();
  $vars['secondary_local_tasks'] = menu_secondary_local_tasks();
}

/**
 * Display the list of available node types for node creation.
 */
function brunello_admin_node_add_list($content) {
  $output = '';
  if ($content) {
    $output = '<ul class="node-type-list">';
    foreach ($content as $item) {
      $output .= '<li class="clearfix">';
      $output .= '<span class="label">' . l($item['title'], $item['href'], $item['localized_options']) . '</span>';
      $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Override of theme_admin_block_content().
 *
 * Use unordered list markup in both compact and extended move.
 */
function brunello_admin_admin_block_content($content) {
  $output = '';
  if (!empty($content)) {
    $output = system_admin_compact_mode() ? '<ul class="admin-list compact">' : '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="leaf">';
      $output .= l($item['title'], $item['href'], $item['localized_options']);
      if (!system_admin_compact_mode()) {
        $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Override of theme_tablesort_indicator().
 *
 * Use our own image versions, so they show up as black and not gray on gray.
 */
function brunello_admin_tablesort_indicator($style) {
  $theme_path = drupal_get_path('theme', 'brunello_admin');
  if ($style == 'asc') {
    return theme('image', $theme_path . '/images/arrow-asc.png');
  } else {
    return theme('image', $theme_path . '/images/arrow-desc.png');
  }
}

/**
 * Override of theme_fieldset().
 *
 * Add span to legend tag, so we can style it to be inside the fieldset.
 */
function brunello_admin_fieldset($element) {
  if (!empty($element['#collapsible'])) {
    drupal_add_js('misc/collapse.js');

    if (!isset($element['#attributes']['class'])) {
      $element['#attributes']['class'] = '';
    }

    $element['#attributes']['class'] .= ' collapsible';
    if (!empty($element['#collapsed'])) {
      $element['#attributes']['class'] .= ' collapsed';
    }
  }

  $output = '<fieldset' . drupal_attributes($element['#attributes']) . '>';
  if (!empty($element['#title'])) {
    // Always wrap fieldset legends in a SPAN for CSS positioning.
    $output .= '<legend><span class="fieldset-legend">' . $element['#title'] . '</span></legend>';
  }
  // Add a wrapper if this fieldset is not collapsible.
  // theme_fieldset() in D7 adds a wrapper to all fieldsets, however in D6 this
  // wrapper is added by Drupal.behaviors.collapse(), but only to collapsible
  // fieldsets. So to ensure the wrapper is consistantly added here we add the
  // wrapper to the markup, but only for non collapsible fieldsets.
  if (empty($element['#collapsible'])) {
    $output .= '<div class="fieldset-wrapper">';
  }
  if (!empty($element['#description'])) {
    $output .= '<div class="description">' . $element['#description'] . '</div>';
  }
  if (isset($element['#children'])) {
    $output .= $element['#children'];
  }
  if (isset($element['#value'])) {
    $output .= $element['#value'];
  }
  if (empty($element['#collapsible'])) {
    $output .= '</div>';
  }
  $output .= "</fieldset>\n";
  return $output;
}

/**
 * Theme override for theme_content_multigroup_node_form().
 * Add class wrappers.
 *
 * Incrdibly useful function for admin themes, this adds unique classes per field to
 * wrapper divs in multigroup. Note that this does not work with AHAH, so be aware
 * that the new classes won't be added immediately when you press "Add More Values".
 *
 * See: http://drupal.org/node/832340#comment-3572596 for more info.
 */
function brunello_admin_content_multigroup_node_form($element) {
  $groups = array(
    'group_sites',
   // Add your group names here...
  );

  foreach ($groups as $group) {
    if (!empty($element['#group_name']) && $element['#group_name'] == $group) {

      // Wrap the elements in group fields.
      foreach (element_children($element) as $delta) {
        if (is_int($delta)) {
          foreach ($element['#group_fields'] as $field_name => $value) {
            $element[$delta][$field_name]['#prefix'] = '<div class="'. str_replace('_', '-', $group) . '-' .  str_replace('_', '-', $field_name) . '">';
            $element[$delta][$field_name]['#suffix'] = '</div>';
          }
        }
      }
    }
  }
  return theme_content_multigroup_node_form($element);
}