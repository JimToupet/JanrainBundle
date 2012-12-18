Documentation
-------------

Yet another implementation of EvarioJanrainBundle
Use at your own risc.

About
-----

JanrainBundle integrates Janrain into Symfony2 projects.

Requires FOSUserBundle and FOSJSRoutingBundle

Install bundle
--------------

Add this to composer.json:
~~~
"rodgermd/janrain-bundle": "dev-master"
~~~

Enable bundle in AppKernel.php

~~~
new Evario\JanrainBundle\EvarioJanrainBundle()
~~~

Configure
---------

paramters.yml:
~~~
  janrain_api_key  : paste_api_key_here
  janrain_app_id   : paste_app_id_here
  janrain_app_name : paste_app_name
~~~

config.yml:
~~~
evario_janrain:
  api_key: %janrain_api_key%
  request_url: nothing
~~~

Add twig global variable:

~~~
twig:
    ...
    globals:
      ...
      janrain_application_name: %janrain_app_name%
~~~

services.yml
~~~
services:
  evario.janrain.user:
    class: Evario\JanrainBundle\Security\User\Provider  # extend this class as you wish
    arguments:
      userManager: "@fos_user.user_manager"
      validator: "@validator"
      apiKey: %janrain_api_key%
      container: "@service_container"
~~~

Change login form in security.yml, that's the sample:

~~~
main:
    pattern: ^/
        form_login:
            provider: evario_janrain
            csrf_provider: form.csrf_provider
            login_path: /account/login
            check_path: /account/login_check
            use_referer: true
        evario_janrain:
            use_forward: false
            login_path: /account/login
            check_path: /account/janrain-check
            provider: evario_janrain
        logout:
            path:   /account/logout
            anonymous: true
~~~

Add Janrain controller into routes. Probably change the route prefix

routing.yml
~~~
janrain_security:
  resource: "@EvarioJanrainBundle/Controller"
  type    : annotation
  prefix  : /secure
~~~

Use in templates
----------------


Add javascript anywhere on the page. Janrain recoomends to do that in the <head> tag, but it works even if it will be placed at the bottom of <body>.

~~~
{% if not app.user %}
  <script type="text/javascript" src="{{ asset('bundles/evariojanrain/js/janrain_login.js') }}" application_name="{{ janrain_application_name }}"></script>
{% endif %}
~~~

Add html element with the class or id written below, that's important.
If your janrain application is configured to show as a popup, use:
~~~
<a class="janrainEngage" href="#">Sign-In</a>
~~~

if widget:

~~~~
<div id="janrainEngageEmbed"></div>
~~~~