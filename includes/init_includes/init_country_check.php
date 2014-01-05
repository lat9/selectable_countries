<?php
/*-----
** Add flag, either 'true' or 'false' to indicate whether or not a country is included for the store's customer addresses.
*/
if (!defined('ACCOUNT_COUNTRY')) define('ACCOUNT_COUNTRY', 'true');

/*-----
** If a customer is logged in, check to see that the customers' address(es) still contain valid countries.
** If not, redirect to the address-book page for changes.
*/
if (ACCOUNT_COUNTRY == 'true' && $_SESSION['customer_id'] && $_GET['main_page'] != FILENAME_ADDRESS_BOOK_PROCESS && $_GET['main_page'] != FILENAME_LOGOFF) {
  $addresses_query = "SELECT address_book_id, entry_country_id as country_id, entry_firstname as firstname, entry_lastname as lastname
                      FROM   " . TABLE_ADDRESS_BOOK . "
                      WHERE  customers_id = :customersID
                      ORDER BY firstname, lastname";

  $addresses_query = $db->bindVars($addresses_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $addresses = $db->Execute($addresses_query);
  
  while (!$addresses->EOF) {
    if (!is_country_active ($addresses->fields['country_id'])) {
      $messageStack->add_session('addressbook', sprintf(SELECTABLE_COUNTRIES_UPDATE, get_country_name($addresses->fields['country_id'])), 'error');
      zen_redirect (zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses->fields['address_book_id'], 'SSL'));
    }
    $addresses->MoveNext();
  }
}
?>
