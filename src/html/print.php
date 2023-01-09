<?php
use ArmoniaPDF\PDF;

return function ($title, $extra_css, $content) {
    /**
     * Include the font in PDF, so that PDF will process the file and embed into pdf output
     * You can put an absolute path to your font file in your system or use external font file via http://
     */
    $font_path = PDF::FONTS_DIR . '/migu-1p-bold.ttf';
    $font_path_1 = PDF::FONTS_DIR . '/migu-1p-regular.ttf';

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{$title}</title>

    <style>
    /**
     * Global styling for pdf, additional styling can be added by extra_css in your blade view
     */
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }

    @font-face {
        font-family: 'MIGU-1p-Bold';
        font-style: normal;
        font-weight: bold;
        line-height: .9;
        letter-spacing: 0;
        src: url('{$font_path}') format('truetype');
    }
    @font-face {
        font-family: 'MIGU-1p-Regular';
        font-style: normal;
        font-weight: 400;
        line-height: .9;
        letter-spacing: 0;
        src: url('{$font_path_1}') format('truetype');
    }
    body {
        font-family: 'MIGU-1p-Regular', sans-serif;
    }

    small {
        font-size: 10px;
    }

    h1, h2, h3, h4, h5, h6 {
        margin: 0;
        padding: 0;
        font-family: 'MIGU-1p-Regular', sans-serif;
        font-weight: normal;
    }

    h1 {
        font-size: 2.57143rem;
    }

    h2 {
        font-size: 2.14286rem;
    }

    h3 {
        font-size: 1.85714rem;
    }

    h4 {
        font-size: 1.57143rem;
    }

    h5 {
        font-size: 1.28571rem;
    }

    h6 {
        font-size: 1rem;
    }

    strong, b, em,
    table th {
        font-family: 'MIGU-1p-Bold', sans-serif;
        font-weight: bold;
    }

    table {
        table-layout: fixed;
    }

    table td {
        word-wrap:break-word;
    }

    .border {
        border-width: 0;
        border-style: solid;
        border-color: black;
    }

    .border-left {
        border-left-width: 1px;
    }

    .border-right {
        border-right-width: 1px;
    }

    .border-top {
        border-top-width: 1px;
    }

    .border-bottom {
        border-bottom-width: 1px;
    }

    .border-full {
        border-width: 1px;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .clear {
        clear: both;
    }

    .text-center {
        text-align: center;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .page-break {
        page-break-after: always;
    }
    </style>
    {$extra_css}
</head>
<body>
    {$content}
    <script>
        window.print();
    </script>
</body>
</html>
HTML;
};
