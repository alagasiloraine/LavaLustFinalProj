<?php

class Confirmation {

    /**
     * Generate a confirmation dialog for a given message and action.
     * 
     * @param string $message The confirmation message.
     * @param string $actionUrl The URL to proceed if confirmed.
     * @return string HTML and JavaScript for the confirmation dialog.
     */
    public static function generate($message, $actionUrl) {
        return "
            <script>
                function confirmAction(event) {
                    event.preventDefault();
                    const userConfirmed = confirm('$message');
                    if (userConfirmed) {
                        window.location.href = '$actionUrl';
                    }
                }
            </script>
        ";
    }

    /**
     * Render a button or link with confirmation.
     * 
     * @param string $label The label of the button or link.
     * @param string $message The confirmation message.
     * @param string $actionUrl The URL to proceed if confirmed.
     * @param string $class Additional classes for styling.
     * @return string HTML for the button or link with confirmation.
     */
    public static function renderButton($label, $message, $actionUrl, $class = 'btn btn-danger') {
        return "
            " . self::generate($message, $actionUrl) . "
            <button class='$class' onclick='confirmAction(event)'>$label</button>
        ";
    }

    /**
     * Render a link with confirmation.
     * 
     * @param string $label The label of the link.
     * @param string $message The confirmation message.
     * @param string $actionUrl The URL to proceed if confirmed.
     * @param string $class Additional classes for styling.
     * @return string HTML for the link with confirmation.
     */
    public static function renderLink($label, $message, $actionUrl, $class = 'text-danger') {
        return "
            " . self::generate($message, $actionUrl) . "
            <a href='#' class='$class' onclick='confirmAction(event)'>$label</a>
        ";
    }
}
