# Armonia PDF

A library to convert html to pdf

---

## Add to Project
In your project's directory run in cli:

`composer require armonia-tech/armonia-pdf:dev-master`

---

## Development

Go up 1 level from your project's directory,  run in cli:

`git clone https://github.com/armonia-tech/armonia-pdf.git`

In your project's composer.json, add the following:
```json
"repositories": [
    {
        "type": "path",
        "url":  "../armonia-pdf"
    }
]
```
then run in cli:

`composer require armonia-tech/armonia-pdf:dev-master`

---

## Usage
### Basic:
```php
use ArmoniaPDF\PDF;

$dompdf = new PDF;

$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml('<div>Hello</div>');
$dompdf->stream('download.pdf');

```

### Methods:

Methods | Arguments | Return | Description
---|---|---|---
`__construct($options)`|`Dompdf\Options $options`| `void` | Initialize pdf instance with options, refer to [dompdf/dompdf](https://github.com/dompdf/dompdf) for available options
`loadHtml($html)`|`string $html`|`void`|Insert the html content into pdf
`setTitle($title)`|`string $title`|`void`|Set the title of pdf when downloading 
`addStyleSheet($stylesheet)`|`string $stylesheet`|`void`|append stylesheet into the pdf 
`outputHtml()`|`none`|`string`|Return the html generated by dom pdf
`setPaper($size)`|`string $size = 'A4'`, `string $orientation = 'portrait'`|`void`|Set the paper size and orientation
`stream($file_name, $options)`|`string $file_name, $options`|`stream`|Start downloading the pdf

### Reference:
1) [Dompdf\Dompdf](https://github.com/dompdf/dompdf)