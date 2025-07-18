<?php

namespace inc;

class config_file
{
    private string $cssFolder = '/assets/css';
    private string $jsFolder = '/assets/js';
    private string $cssHandlePrefix = 'theme-style-';
    private string $jsHandlePrefix = 'theme-script-';
    private array $conditions = [];

    public function __construct(array $conditions = [])
    {
        $this->conditions = $conditions;
        add_action('wp_enqueue_scripts' , [$this , 'enqueueAssets']);
    }

    private function shouldLoadFile(string $filename): bool
    {
        if (isset($this->conditions[$filename]) && is_callable($this->conditions[$filename])) {
            return call_user_func($this->conditions[$filename]);
        }
        return true; // پیش‌فرض: فایل لود شود
    }

    private function enqueueFromFolder(string $folderPath , string $urlPrefix , string $handlePrefix , string $type): void
    {
        $absPath = get_template_directory() . $folderPath;
        $urlPath = get_template_directory_uri() . $folderPath;

        if (!is_dir($absPath)) return;

        $files = scandir($absPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $ext = pathinfo($file , PATHINFO_EXTENSION);
            if (($type === 'css' && $ext !== 'css') || ($type === 'js' && $ext !== 'js')) continue;

            if (!$this->shouldLoadFile($file)) continue;

            $filePath = $absPath . '/' . $file;
            $fileUrl = $urlPath . '/' . $file;

            $version = filemtime($filePath);
            $handle = $handlePrefix . str_replace(['.' , '_'] , '-' , pathinfo($file , PATHINFO_FILENAME));

            if ($type === 'css') {
                wp_enqueue_style($handle , $fileUrl , [] , $version);
            } else {
                wp_enqueue_script($handle , $fileUrl , [] , $version , true);
            }
        }
    }

    public function enqueueAssets(): void
    {
        $this->enqueueFromFolder($this->cssFolder , $this->cssFolder , $this->cssHandlePrefix , 'css');
        $this->enqueueFromFolder($this->jsFolder , $this->jsFolder , $this->jsHandlePrefix , 'js');
    }
}
