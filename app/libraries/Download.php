<?php

require_once __DIR__ . '/../../vendor/autoload.php'; 



class Download {
    /**
     * Downloads a file from the server.
     * 
     * @param string $filePath Full path to the file on the server.
     * @param string|null $fileName Optional custom name for the downloaded file.
     * @throws Exception If the file does not exist or cannot be accessed.
     * @return void
     */
    public static function file($filePath, $fileName = null) {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: $filePath");
        }

        // Determine the file name for the download
        $downloadName = $fileName ?: basename($filePath);

        // Get the MIME type of the file
        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

        // Set headers to initiate file download
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $downloadName . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Pragma: public');

        // Clear output buffer and stream the file
        flush();
        readfile($filePath);
        exit;
    }
}
