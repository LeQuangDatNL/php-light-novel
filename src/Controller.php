<?php
namespace App;
class Controller {
    protected function render($view_name, $data = []) {
        extract($data);
        include __DIR__ . "\Views\\$view_name.php";
    }
    protected function renderNoData($view_name) {
        include __DIR__ . "\Views\\$view_name.php";
    }
}