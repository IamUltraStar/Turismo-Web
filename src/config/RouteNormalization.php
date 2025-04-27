<?php
/**
 * Normaliza y modifica la URL base del proyecto para combinarla con una ruta adicional.
 * @param string $path Ruta adicional.
 */
function base_url(string $path = ""): string
{
    static $baseUrl = APP_URL;

    if ($baseUrl === null) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];

        // Obtener la ruta base del proyecto (ajusta según tu estructura)
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        $baseUrl = rtrim($protocol . $host . $scriptPath, '/');
    }

    if (empty($path)) {
        return APP_URL;
    }

    // Normalizar el path (manejar ../ y ./)    
    $partsBaseUrl = explode('/', $baseUrl);
    $parts = explode('/', str_replace('\\', '/', $path));

    foreach ($parts as $part) {
        if ($part === '..') {
            if (count($partsBaseUrl) > 3) { // Evita retroceder más allá del protocolo+dominio
                array_pop($partsBaseUrl);
            }
        } elseif ($part !== '.' && $part !== '') {
            $partsBaseUrl[] = $part;
        }
    }

    return implode('/', $partsBaseUrl);
}
