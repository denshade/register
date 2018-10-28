<?php

class ErrorView
{
    public static function showError(Exception $e)
    {
        echo '<html><head>';
        include "headerbootstrap.php";
        echo '</head><body>';
        echo '<div class="alert alert-danger">
                    <strong>A problem has occurred.</strong> ' . $e->getMessage() . '
              </div>';
        echo '<button onclick="goBack()">Go Back</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>';

    }
}