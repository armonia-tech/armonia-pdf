<?php
namespace ArmoniaPDF;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    const BASE_DIR = __DIR__;
    const BASE_HTML = self::BASE_DIR . '/html/print.php';
    const FONTS_DIR = self::BASE_DIR . '/fonts';

    protected $dompdf;
    protected $title;
    protected $extra_css;

    public function __construct(Options $options = null)
    {
        if ($options == null) {
            $font_cache_dir = (getenv('FONT_CACHE_DIR') ?: '/storage/cache/pdf');
            $font_cache_dir = trim($font_cache_dir, '/');
            $font_cache_dir = APP_PATH . '/' . $font_cache_dir;

            if (!file_exists($font_cache_dir)) {
                mkdir($font_cache_dir, 0755, true);
            }

            $options = new Options;
            $options->setFontDir($font_cache_dir);
            $options->setFontCache($font_cache_dir);
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

    public function stream($file_name, $options)
    {
        $this->dompdf->render();

        return $this->dompdf->stream($file_name, $options);
    }
}
