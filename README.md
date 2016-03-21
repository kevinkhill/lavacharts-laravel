# Laravel Integration for Lavacharts 3.0

## Package Features
- Service provider for retrieving the Lavacharts instance from the container.
- Facade for using the ```Lava``` alias throughout the framework.
- Blade template extensions for easy rendering in views

#### This extension is included automatically with [Lavacharts](https://github.com/kevinkhill/lavacharts)

---

## Installing

### Laravel 5.x
Register Lavacharts in your app by adding this line to the end of the providers array in ```config/app.php```:
```php
<?php
// config/app.php

// ...
'providers' => [
    ...

    Khill\Lavacharts\Laravel\LavachartsServiceProvider::class,
],
```

### Laravel 4.x
Register Lavacharts in your app by adding this line to the end of the providers array in ```app/config/app.php```:

```php
<?php
// app/config/app.php

// ...
'providers' => array(
    // ...

    "Khill\Lavacharts\Laravel\LavachartsServiceProvider",
),
```
The ```Lava``` alias will be registered automatically via the service provider so you can use ```\Lava::method()``` throughout the framework.


# Usage
The creation of charts is separated into two parts:
First, within a route or controller, you define the chart, the data table, and the customization of the output.

Second, within a view, you use one line and the library will output all the necessary javascript code for you.

## Basic Example
Here is an example of the simplest chart you can create: A line chart with one dataset and a title, no configuration.

### Controller
```php
    $data = \Lava::DataTable();
    $data->addDateColumn('Day of Month')
                ->addNumberColumn('Projected')
                ->addNumberColumn('Official');

    // Random Data For Example
    for ($a = 1; $a < 30; $a++)
    {
        $rowData = [
          "2014-8-$a", rand(800,1000), rand(800,1000)
        ];

        $data->addRow($rowData);
    }

    \Lava::LineChart('Stocks', $data, [
      'title' => 'Stock Market Trends'
    ]);
```

## View
First, pick where the charts will be rendered, into div's with specific IDs
```html
<div id="stocks-div"></div>
```

With the Blade templating engine, you can use the extensions for a cleaner view
```php
@linechart('Stocks', 'stocks-div')
```

# Changelog
 - 3.0.0
  - Initial Package
