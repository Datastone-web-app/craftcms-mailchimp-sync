# Craft CMS Mailchimp Sync

The Craft CMS Mailchimp Sync plugin allows you to send email addresses collected via a newsletter subscribe form on your Craft CMS website to your Mailchimp audience.

## Installation

1. Install the plugin through the Craft CMS control panel or via the command line:

   ```bash
   composer require datastone/craft-mailchimp-sync
   ```
   ```bash
   ./craft plugin/install datastone-mailchimp-sync
   ```
2. Configure the plugin by going to "Settings → Plugins → Datastone mailchimp sync" in the Craft CMS control panel.

   - Configuring the Mailchimp API Key:
     Before you can use the plugin, you need to configure your Mailchimp API Key:
     https://mailchimp.com/developer/marketing/guides/quick-start/

     make sure the api key ends with the mailchimp server eg: us3
     Enter your Mailchimp API Key in the provided field and save your settings.

   - Creating a Mailchimp Audience
     To collect email addresses and send them to Mailchimp, you need to create a Mailchimp audience (list) and configure the plugin to use it:
     https://mailchimp.com/help/find-audience-id/


4. Now you can add a newsletter subscribe form on your website that collects email addresses. When users submit their email addresses through this form, the plugin will send the email addresses to your configured Mailchimp audience.
````twig
<form method="post" target="_self">
    {{ actionInput('datastone-mailchimp-sync/news-letter/subscribe') }} 
    {{ csrfInput() }}
    <input type="email" name="email" placeholder="E-mailadres" required>
    <button type="submit">Subscribe</button>
</form>
````

For Craft Commerce you can also add a register-newsletter checkbox on the users/save-user form with the value 'checked'
To send the email to Mailchimp on user registration via the queue.

## Translations

You can translate the flash message by following these steps:

1. Add a translations directory to your Craft CMS root folder.

2. Inside your translations directory, create a file named `datastone-mailchimp-sync.php` in your desired language directory, for example, `translations/nl/` for Dutch translations.

Here's an example of the PHP translation file (`datastone-mailchimp-sync.php`):

```php
<?php

return [
   'subscription-error' => 'Aanmelden op de nieuwsbrief is niet gelukt of je bent al geregistreerd.',
   'subscription-success' => 'Succesvol aangemeld op de nieuwsbrief!',
];
```
In this file, you can customize the translations for the flash messages as needed for your specific language.

Now, Craft CMS will use these translations for the flash messages based on the user's language settings.

## Troubleshooting
Only the email will be sent to Mailchimp. Ensure that you have no other required fields set in Mailchimp, such as first and last name.

## Roadmap

- Posibility to add more fields to the form like first and lastname

- seperate server id, for custom api keys

- unsubscribe functions

## License
This plugin is licensed under the MIT License. See the LICENSE file for details.

## Credits
Craft CMS Mailchimp Sync is developed and maintained by Datastone.

## Support and Feedback

If you encounter any issues or have questions or feedback, please [create an issue](https://github.com/datastone-web-app/craftcms-mailchimp-sync/issues) on the GitHub repository.