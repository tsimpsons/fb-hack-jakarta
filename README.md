# Facebook Developer World HACK Indonesia sample application

Sample application presented by [Niall Kennedy](https://github.com/niallkennedy) in Jakarta, Indonesia on September 13, 2012. It is an example of how to create a simple Open Graph presentation.

I created a fake website named "Slides World" that may track slides around the world users could favorite or post to their timeline after completing a ride. This example is for a single slide: the [atmostfear slide at fX Mall](http://fxsudirman.com/tenant_detail.php?id_store=102) in Jakarta.

## Getting started

You will need a web server capable of interpreting PHP. The server must be accessible on the public Internet from Facebook's servers in the United States.

## Configuration

Define variables in `config.php` specific to your server and Facebook application. Retrieve application-specific information from the [Facebook Developers site's application browser](https://developers.facebook.com/apps/). Define the base URL where you uploaded these files; this base URL will be used to build absolute URLs in the sample PHP.

Select how your application integrates with Facebook in your application's basic settings. This example is a Website with Facebook Login.

Define Open Graph noun and verb pairs for your application.
https://developers.facebook.com/apps/{your_app_id}/opengraph/getting-started

* "ride" a "slide" where ride is the verb and slide is the noun. Slide inherits from Place and defines a [GeoPoint](https://developers.facebook.com/docs/opengraph/complextypes/#geopoint). You may also define an optional "length" property with an integer value.
* "favorite" a "slide" where favorite is the verb and slide is the noun. Favorite inherits from [Like](https://developers.facebook.com/docs/opengraph/actions/builtin/likes/).

Populate the App Details section of your application profile. These values will appear in your login permissions dialog.

## Helpful debug links

Something broke! Facebook has some useful web tools to help you explore problems and debug your application or website.

* [W3C Validator](http://validator.w3.org/) checks your webpage HTML for conformance against a known HTML type. Lots of errors on your page could cause errors in parsing.
* [Open Graph URL debugger](https://developers.facebook.com/tools/debug) parses your webpage URL and displays extracted data. Fix errors and warnings.
* [Graph API Explorer](https://developers.facebook.com/tools/explorer) helps you test data retrieval as a specific application or from a temporary Graph API Explorer session.
* The app roles page in your application dashboard can create test users and add extra developers for an application.
* Your Facebook account's [application settings page](https://www.facebook.com/settings?tab=applications) lists all applications associated with your account. Delete an application relationship and all data to start fresh when testing.