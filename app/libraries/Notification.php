<?php

class Notification {

    // Method to set a success message
    public static function success($message) {
        $_SESSION['toastr'][] = ['type' => 'success', 'message' => $message];
    }

    // Method to set a failure message
    public static function error($message) {
        $_SESSION['toastr'][] = ['type' => 'error', 'message' => $message];
    }

    // Method to render the Toastr notifications
    public static function render() {
        if (!empty($_SESSION['toastr'])) {
            echo '<script>';
            foreach ($_SESSION['toastr'] as $toast) {
                echo "toastr.{$toast['type']}('{$toast['message']}');";
            }
            echo '</script>';
            // Clear the notifications after rendering
            unset($_SESSION['toastr']);
        }
    }
}
?>
