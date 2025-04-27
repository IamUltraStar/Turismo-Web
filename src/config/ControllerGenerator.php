<?php
/**
 * @param string $directory Ruta base.
 * @param array $exclude Archivos o carpetas a excluir (opcional).
 */
function requireAllRecursive(string $directory, array $exclude = [])
{
    if (!is_dir($directory)) {
        throw new Exception("Directorio no encontrado: " . $directory);
    }

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        $filePath = $file->getPathname();

        // Si es un archivo PHP y no está excluido
        if ($file->isFile() && $file->getExtension() === 'php') {
            $fileName = $file->getFilename();
            if (!in_array($fileName, $exclude)) {
                require_once $filePath;
            }
        }
    }
}

requireAllRecursive(ROOT_PATH . '/controllers');