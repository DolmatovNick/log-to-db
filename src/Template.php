<?php


class Template {

    protected $data;

    public static function render($file, $data): self
    {
        return (new static($file, $data));
    }

    protected function __construct($file, $data)
    {
        $this->data = $data;
        include $file;
    }

}