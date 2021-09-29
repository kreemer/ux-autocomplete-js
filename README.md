# UX autoComplete.js

![demo](https://lethani.ch/wp-content/uploads/2021/09/ezgif-2-9fc1658d935d.gif)


UX autoComplete.js is a Symfony bundle integrating the [autoComplete.js](https://tarekraafat.github.io/autoComplete.js/#/) library in Symfony applications. It is part of [the Symfony UX initiative](https://symfony.com/ux).

## Installation

UX autoComplete.js requires PHP 7.4+ and Symfony 4.4+.

Install this bundle using Composer and Symfony Flex:

```sh
composer require kreemer/ux-autocomplete-js

# Don't forget to install the JavaScript dependencies as well and compile
yarn install --force
yarn encore dev
```

Also make sure you have at least version 2.0 of [@symfony/stimulus-bridge](https://github.com/symfony/stimulus-bridge) in your `package.json` file.

## Usage

To use this UX Package, inject the `AutoCompleteBuilderInterface` service and create an autoComplete model in PHP:

```php
// ...
use Kreemer\UX\AutoCompleteJS\Builder\AutoCompleteBuilderInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(AutoCompleteBuilderInterface $autoCompleteBuilder): Response
    {
        $autoComplete = $autoCompleteBuilder->createAutocomplete();
        $autoComplete->getDataModel()->setSrc([ 'here', 'are', 'the', 'options']);

        return $this->render('index/index.html.twig', [
            'autoComplete' => $autoComplete,
        ]);
    }
}
```

All options and data are provided as-is to autoComplete.js. You can read [autoComplete.js documentation](https://tarekraafat.github.io/autoComplete.js/#/) to discover them all.

Once created in PHP, a autoComplete model can be displayed using Twig:

```twig
{{ render_autocomplete(autoComplete) }}

{# You can pass HTML attributes as a second argument to add them on the <div> tag #}
{{ render_autocomplete(autoComplete, {'class': 'my-class'}) }}
```

### Form type

The bundle provides a custom form type which can be used like an EntityType.

```php
$form = $this->createFormBuilder($array)
    ->add('user', AutoCompleteType::class, [
        'class' => User::class,
        'choice_label' => 'name',
    ])
    ->add('save', SubmitType::class, ['label' => 'Submit'])
    ->getForm();
```

The form itself will be rendered automatically with an input box which the entity class can be selected.

### Extend the default behavior

The controller allows you to extend its default behavior using a custom Stimulus controller:

```js
// custom_controller.js

import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        this.element.addEventListener('autocomplete:pre-connect', this._onPreConnect);
        this.element.addEventListener('autocomplete:connect', this._onConnect);
        this.element.addEventListener('autocomplete:bound', this._onBound);
    }

    disconnect() {
        // You should always remove listeners when the controller is disconnected to avoid side effects
        this.element.removeEventListener('autocomplete:pre-connect', this._onPreConnect);
        this.element.removeEventListener('autocomplete:connect', this._onConnect);
        this.element.removeEventListener('autocomplete:bound', this._onBound);
    }

    _onPreConnect(event) {
        console.log(event.detail.config);
    }

    _onConnect(event) {
        console.log(event.detail.autoCompleteJS); // You can access the instance here
    }
    
    _onBound(event) {
        console.log(event.detail.dataTarget); // You can access data holder here
    }
}
```

Then in your render call, add your controller as an HTML attribute:

```twig
{{ render_autocomplete(autoComplete, {'data-controller': 'custom'}) }}
```

This is the preferred method to extend the default functionality. Note that with the preConnect event it is possible to attach handlers and callback functions.

## Run tests

### PHP tests

```sh
php vendor/bin/phpunit
```

### JavaScript tests

```sh
cd Resources/assets
yarn test
```
