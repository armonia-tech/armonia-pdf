<?php
namespace ArmoniaPDF;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    const BASE_DIR = __DIR__;
    const BASE_HTML = self::BASE_DIR . '/html/print.php';
    const FONTS_DIR = self::BASE_DIR . '/fonts';
    const FONT_CACHE_DIR = self::BASE_DIR . '/pdf/cache';

    protected $dompdf;
    protected $title;
    protected $extra_css;

    public function __construct(Options $options = null)
    {
        if ($options == null) {
            if (!file_exists(self::FONT_CACHE_DIR)) {
                mkdir(self::FONT_CACHE_DIR, 0755, true);
            }

            $options = new Options;
            $options->setFontDir(self::FONT_CACHE_DIR);
            $options->setFontCache(self::FONT_CACHE_DIR);
        }

        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml(string $html)
    {
        $title = $this->title ?? 'New Document';
        $extra_css = implode('', $this->extra_css ?? []);
        $content = $html;

        $base_html_callback = require self::BASE_HTML;
        $base_html = $base_html_callback($title, $extra_css, $content);

        $this->dompdf->loadHtml($base_html);
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function addStyleSheet(string $stylesheet)
    {
        $this->extra_css[] = $stylesheet;
    }

    public function outputHtml()
    {
        return $this->dompdf->outputHtml();
    }

    public function setPaper($size = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        return $this->dompdf->render();
    }

    public function stream($file_name, $options)
    {
        return $this->dompdf->stream($file_name, $options);
    }
}
