# Google Address Autocomplete for the Hyvä checkout 

[![Coding Standard](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml/badge.svg)](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml)

[Hyvä checkout](https://www.hyva.io/hyva-checkout.html) compatibility module for [vendic/magento2-google-address-autocomplete](https://github.com/Vendic/magento2-google-address-autocomplete).



https://github.com/Vendic/hyva-checkout-google-address-autocomplete/assets/14849044/52a1d20a-88e3-4953-a06e-c0dac096478d





## Installation
**This extension currently only supports PHP 8.1**, while the Hyvä checkout is also compatible with PHP 7.4. Feel free to create a pull request if you want PHP 7.4 support.
```bash
composer require vendic/hyva-checkout-google-address-autocomplete
```

## Configuration
First, create your Google Maps API key. You can find instructions on how to do this [here](https://developers.google.com/maps/get-started#create-project).
Also make sure you have valid billing information added to your Google account. 

Set your Google Maps API key in the Magento admin panel under `Stores > Configuration > Vendic > Google Address Autocomplete`.

Or - even better - via the CLI:
```bash
 n98-magerun2 config:set --lock-env google_autocomplete/general/api_key $your_api_key
```

There is no disable/enable configuration. To disable the module, simply remove the API key from the configuration.

## Features
- [x] Autocomplete for billing address in the Hyvä checkout
- [x] Autocomplete for shipping address in the Hyvä checkout
- [ ] Autocomplete for adding a new address as a logged in user (see [#5](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/issues/5))
- [x] Works on the company field and street 0. To add additonal fields, check `\Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel\AutoCompleteSelectors`
- [x] Housenumber validation to check if the housenumber contains digits. 
- [x] Reload autocomplete JS by triggering a browser event named `re-init-google-autocomplete`. This can be useful when you are removing/adding fields dynamically.

## Customizations
### Field mapping
The field mapping (google address response mapped to Hyvä checkout form inputs) can be modified using di.xml.
See `etc/frontend/di.xml` for the default mapping, which you can change edit in [your own di.xml](https://devdocs.mage-os.org/docs/main/di_xml#content-syntax).

### Input selectors
The input selectors (the fields that trigger the autocomplete dropdown ) can be modified using di.xml.
By default, the autocomplete is triggered for street 0 and company.
