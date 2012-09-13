<!DOCTYPE html>
<html lang="en"><?php
require_once(dirname(__FILE__).'/config.php');

$prefix_attribute = '';
if ( !empty($curie_prefix_mappings) ) {
  foreach( $curie_prefix_mappings as $prefix => $curie ) {
    $prefix_attribute .= $prefix . ': ' . $curie . ' ';
  }
  $prefix_attribute = rtrim($prefix_attribute);
}

?><head<?php
if ( $prefix_attribute ) {
  echo ' prefix="' . $prefix_attribute . '"';
} ?>>
  <meta charset="utf-8">
  <title>Atmostfear | Slide World</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="http://ogp.me/ns/fb#app_id" content="<?php echo $app_id; ?>">

  <!-- Define the language of the page in Facebook locales -->
  <meta property="og:locale" content="en_US">
  <meta property="og:locale:alternate" content="id_ID">

  <meta property="og:title" content="Atmostfear">
  <meta property="og:site_name" content="Slide World">
  <meta property="og:determiner" content="the">
  <meta property="og:description" content="Atmostfear is the longest dry slider in the world. Drop 20 meters over 8 seconds while sliding between four floors.">

  <!-- collapse all references to the page into single references -->
  <meta property="og:url" content="<?php echo $base_url; ?>">
  <link rel="canonical" href="<?php echo $base_url; ?>">

  <meta property="og:image" content="<?php echo $base_url . 'atmostfear-2x.jpg'; ?>">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="934">
  <meta property="og:image:height" content="700">

  <meta property="og:type" content="<?php echo $app_namespace; ?>:slide">
  <meta property="<?php echo $app_namespace; ?>:length" content="72">
  <meta property="place:location:latitude"  content="-6.22489">
  <meta property="place:location:longitude" content="106.80388">
  <link rel="icon" type="image/png" href="/icon.png" sizes="16x16">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <style type="text/css">
body {
  padding-top: 60px; /* 60px to make the Bootstrap container go all the way to the bottom of the topbar */
}
  </style>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- using jQuery Sizzle selectors, DOM builders, and event handlers -->
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript">jQuery.ajaxSetup({cache:true});</script>
</head>
<body><?php
require_once(dirname(__FILE__).'/sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId' => $app_id,
  'secret' => $app_secret
));
?>

<header><div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Slide World \_</a>
      <div id="account" class="pull-right"><?php
$user_id = $facebook->getUser();
if ($user_id) { // logged in
  // request just the fields we need
  $me = $facebook->api('/me?fields=link,name','GET');
?><img alt="<?php echo $user_id . ' profile photo'; ?>" src="<?php

// specify pattern. Facebook will redirect
// @link 
echo "https://graph.facebook.com/{$user_id}/picture?type=small";

?>" width="50" height="50"><a class="fn navbar-text" href="<?php echo htmlspecialchars($me['link']); ?>"><?php echo $me['name'] ?></a>
        <a class="fb-logout-button btn btn-primary" rel="nofollow" href="<?php echo htmlspecialchars($facebook->getLogoutUrl()); ?>">Log out</a><?php
} else { ?>
        <a rel="nofollow" class="fb-login-button btn btn-primary" href="<?php echo htmlspecialchars( $facebook->getLoginUrl( array('scope'=>$scope) ) ); ?>">Log in</a>
<?php } ?></div>
    </div>
  </div>
</div></header>

<div class="container">
  <div class="row">
  <div class="span6" style="text-align:center"><img class="img-rounded" alt="Atmostfear" src="atmostfear.jpg" width="467" height="350"></div>
  <div class="span6">
  <p>Welcome to Atmostfear.</p>

  <?php
  if ($user_id) {

    if ( array_key_exists('ride',$_POST) && $_POST['ride']==='slide' ) {
      try {
        $activity = $facebook->api('/me/' . $app_namespace . ':ride', 'post', array('slide'=>$base_url,'fb:explicitly_shared'=>'true'));
        if ($activity && array_key_exists('id',$activity)){
          ?><p class="alert alert-success">Activity <?php echo '<a href="' . $me['link'] . '/activity/' . $activity['id'] . '" target="_blank">' . $activity['id'] . '</a>'; ?> created.</p><?php
        }
      } catch (FacebookApiException $e) {
        ?><div class="alert alert-error"><?php var_dump($e); ?></div><?php
      }
    } else if( array_key_exists('like',$_POST) && $_POST['like']==='favorite' ) {
      try {
        $activity = $facebook->api('/me/' . $app_namespace . ':favorite', 'post', array('slide'=>$base_url,'fb:explicitly_shared'=>'true'));
        if ($activity && array_key_exists('id',$activity)){
          ?><p class="alert alert-success">You are our favorite too! Love note: <a target="_blank" href="<?php echo $me['link'] . '/activity/' . $activity['id']; ?>"><?php echo $activity['id']; ?></a></p><?php
        }
      } catch (FacebookApiException $e) {
        ?><div class="alert alert-error"><?php var_dump($e); ?></div><?php
      }
    } else {
      ?>
      <form action="/" method="post"><input type="hidden" name="ride" value="slide"><button class="btn btn-large" type="submit">I rode the slide!</button></form>
      <form action="/" method="post"><input type="hidden" name="like" value="favorite"><button class="btn btn-large" type="submit" style="color:red;font-size:150%">&#9829;</button></form>
      <?php
    }
  } else {
    ?><p>We hope you will ride the slide at the fX Sudirman.</p><?php
  } ?></div>
  </div>
</div>

  <div id="fb-root"></div>
  <script type="text/javascript">
    jQuery.getScript(document.location.protocol + "//connect.facebook.net/en_US/all.js",function(){
      FB.init({
        appId      : <?php echo json_encode($app_id); ?>, // App ID
        channelUrl : <?php echo json_encode($base_url.'/channel.html'); ?>, // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true
      });

      var account_el = jQuery("#account");
    <?php if ($user_id) { ?>
      account_el.find(".fb-logout-button").remove();
      account_el.append( jQuery("<button />").addClass("fb-logout-button btn btn-primary").attr("type","button").text("Log out").click(function(){FB.logout();}) );
    <?php } else { ?>
      account_el.empty();
      account_el.append( jQuery("<button />").addClass("fb-login-button btn btn-primary").attr("type","button").text("Log in").click( function(){
        FB.login(function(response) {
          if (response.authResponse) {
            // successful login. reload with new cookies
            document.location.reload();
          }
        }, {scope:<?php echo json_encode($scope); ?>});
      }) );
    <?php } ?>
    });
  </script>
</body>
</html>