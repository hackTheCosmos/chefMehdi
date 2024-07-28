<?php

class Sanitize {
    public function sanitize($inputValue): string {
        return trim(strip_tags($inputValue));
    }
}