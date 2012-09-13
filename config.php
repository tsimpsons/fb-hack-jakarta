<?php
/**
 * Add information specific to your hosting domain and Facebook application
 */

// where did you upload this code?
// note: should be accessible to Facebook servers requesting the page from the public Internet (no localhost, 127.0.0.1, etc.)
// used to build absolute URIs on the page
$base_url = 'https://example.com/';

// information specific to your application on Facebook
// https://developers.facebook.com/apps
$app_id = 'YOUR_APP_ID';
$app_secret = 'YOUR_APP_SECRET';
$app_namespace = 'YOUR_APP_NAMESPACE';

// ask for specific permissions from Facebook users
// https://developers.facebook.com/docs/authentication/permissions/
$scope = implode(',',array(
  'user_location',
  'publish_actions'
));

$curie_prefix_mappings = array(
  'og' => 'http://ogp.me/ns#' // Open Graph protocol global properties
);

// add our custom namespace prefix and CURIE
$curie_prefix_mappings[$app_namespace] = 'http://ogp.me/ns/fb/' . $app_namespace . '#';

// did you create an object that is a subclass of place?
// comment out the next line if your object is not a place
$curie_prefix_mappings['place'] = 'http://ogp.me/ns/fb/place#';
?>