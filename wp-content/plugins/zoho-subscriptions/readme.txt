=== Zoho Subscriptions - Embed Payment Form  ===
Contributors:Zoho Subscriptions
Tags: recurring payments, one-time payments, PCI complaint, online payments, checkout forms, zoho.
Tested up to: 4.9.1
Stable tag: 1.0
License: BSD
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An easy and hassle-free plugin to add checkout page in your website

== Description ==

= Zoho Subscriptions for WordPress =

Accept recurring payments & one time payments on your website by embedding the Zoho Subscriptions checkout page in few clicks.

= What is Zoho Subscriptions? =

Zoho Subscriptions is your one stop recurring billing and subscription management software.
You need to create an account with Zoho Subscriptions to use this plugin. If you do not have an account yet, you can [sign up](https://www.zoho.com/subscriptions/signup/)

== Installation ==

= Installing the Zoho Subscriptions plugin =
1. In your WordPress admin panel, go to **Plugins > Add New**.
2. Search for **Zoho Subscriptions** plugin in WordPress.
3. Click the **Install Now** button.
4. Now, activate the plugin.


== Integration/Authentication Setup ==

Once you install the Zoho Subscriptions plugin on WordPress, you need to integrate your Zoho Subscriptions account with WordPress using authtoken.

1. Go to **Zoho Subscriptions** Plugin
2. Enter the following information
      1. **Authtoken**  - An authentication code unique to your Zoho Subscriptions account (For generating the    authtoken, copy paste the following link in the browser,
          https://accounts.zoho.com/apiauthtoken/create?SCOPE=ZohoSubscriptions/subscriptionsapi),
      2. **Organization**  - After you provide your authtoken, the organization list will be populated in the **CHOOSE THE  ORGANIZATION** field. The organization mode (TEST, LIVE) will be displayed in brackets. You can
          select your organization.
3. Click the **Save** button

== Embedding the Checkout page ==

Once you have saved your authtoken and organization of your Zoho Subscriptions account, you can see the Zoho Subscriptions icon in the editor while creating a new page/post.

1. Click the **Zoho Subscriptions** icon
2. The plans in your account will be populated.
3. Select the plan for which you need to embed the checkout page.
4. Click OK to embed the checkout page
5. The iframe along with the script to auto adjust the height of the iframe will be included in your page/post.
6. Save your page/post.


= Where do I go for help with any issues? =

In case, you are not sure on how to proceed with the Zoho Subscriptions plugin, feel free to contact support@zohosubscriptions.com.

== Screenshots ==

1. Zoho Subscriptions plugin - search result
2. Zoho Subscriptions plugin download
3. Zoho Subscriptions plugin displayed in the WordPress plugins list
4. Zoho Subscriptions plugin account details page
5. Fetching organizations from the Zoho Subscriptions account for the entered authtoken
6. Zoho Subscriptions account details page with an organization
7. Text editor with Zoho Subscriptions icon
8. Zoho Subscriptions plan selection page
9. Text editor with the embedded code
10. Zoho Subscriptions checkout page in the WordPress site


== Changelog ==

= 1.1.1 =
*Release Date - 11 Jan 2017*

*Replaces short open tag with the original tag

= 1.1 =
*Release Date - 20 Dec 2016*

* Adding support for Europe users. (https://zoho.eu).

= 1.0.1 =
*Release Date - 15 Dec 2016*

* Fixed a bug that could trigger fetch organzation list API although the authtoken is not changed.


= 1.0 =
* Plugin release
