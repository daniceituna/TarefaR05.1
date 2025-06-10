<?php
const URL_BASE = "http://127.0.0.1:8000/api/pedido";

function mostrar_json($content){
    echo "<pre>";
    echo json_encode($content, JSON_PRETTY_PRINT);
    echo "</pre>";
}