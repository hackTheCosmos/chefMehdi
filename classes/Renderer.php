<?php

class Renderer {
    public static function render($view, $data = [], $template="views/template.phtml") {
        require_once $template;
    }
}