# Mailchimp sync
This is a simple craftcms plugin to have a newsletter subscribe form and registers new members to mailchimp.

## Instalation
````
composer require datastone/craft-mailchimp-sync
````

In the plugin config you will need to set the Api key and Audience id

make sure the api key ends with the mailchimp server eg: us3

And you can add a form to your twig template like this

````twig
<form method="post" target="_self">
    {{ actionInput('datastone-mailchimp-sync/news-letter/subscribe') }} 
    {{ csrfInput() }}
    <input type="email" name="email" placeholder="E-mailadres" required>
    <button type="submit">Subscribe</button>
</form>
````

Only the email will be send to mailchimp, you have to make sure you have no other required fields in mailchimp.

# Roadmap

- Posibility to add more fields to the form like first and lastname

- serperate server id, for custom api keys

- unsubscribe functions
