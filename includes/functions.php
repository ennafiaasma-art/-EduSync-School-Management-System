<?php

function cleanInput($data) {
    return htmlspecialchars(trim($data));
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}