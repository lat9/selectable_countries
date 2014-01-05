<?php
/*-----
** Return an indicator (true/false) as to whether the supplied countries_id is "active"
*/
function is_country_active( $countries_id ) {
  global $db;
  $country_active = false;
  if (zen_not_null($countries_id)) {
    $countries = "SELECT countries_active
                  FROM " . TABLE_COUNTRIES . "
                  WHERE countries_id = '" . (int)$countries_id . "'";
                      
    $countries_values = $db->Execute($countries);
    if (!$countries_values->EOF) {
      $country_active = ($countries_values->fields['countries_active'] == '0') ? false : true;
    }
  }
  return $country_active;
}

/*-----
** Return the country name, regardless of its active status.
*/
function get_country_name ($countries_id) {
  global $db;
  $country_name = '';
  if (zen_not_null($countries_id)) {
    $countries = "SELECT countries_name
                  FROM " . TABLE_COUNTRIES . "
                  WHERE countries_id = '" . (int)$countries_id . "'";
                      
    $countries_values = $db->Execute($countries);
    if (!$countries_values->EOF) {
      $country_name = $countries_values->fields['countries_name'];
    }
  }
  return $country_name;
}