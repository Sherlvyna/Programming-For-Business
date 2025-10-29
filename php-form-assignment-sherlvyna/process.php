<?php
$errors = [];
$data = $_REQUEST;

if (empty($errors)) {
    $requiredFields = ['fullName', 'email', 'age', 'password', 'confirmPassword', 'phone', 'gender', 'country'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (!empty($data['age']) && !is_numeric($data['age'])) {
        $errors[] = 'Age must be a number.';
    }

    if (empty($data['hobby']) || !is_array($data['hobby'])) {
        $errors[] = 'At least one hobby must be selected.';
    }

    if (!empty($data['password']) && !empty($data['confirmPassword']) && $data['password'] !== $data['confirmPassword']) {
        $errors[] = 'Passwords do not match.';
    }
    
    if (!empty($data['phone']) && (!is_numeric($data['phone']) || strlen($data['phone']) < 10)) {
        $errors[] = 'Phone must be numeric and at least 10 digits.';
    }

    if (!empty($data['password']) && strlen($data['password']) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Process Form</title>
  <link rel="stylesheet" href="./validation-style.css">
</head>
<body>';

if (!empty($errors)) {
    echo '<h2>Validation Errors</h2>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
    echo '<a href="index.php">Back to Form</a>';
} else {
    echo '<h2>Submitted Data</h2>';
    echo '<table border="1" style="margin: auto; width: 50%;">';
    echo '<tr><th>Field</th><th>Value</th></tr>';
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
        echo '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
    }
    echo '</table>';
    echo '<br><a href="index.php">Back to Form</a>';
}

echo '<h2>Comparison of GET and POST Methods</h2>';
echo '<table border="1" style="margin: auto; width: 80%;">';
echo '<tr><th>Aspect</th><th>GET</th><th>POST</th></tr>';
echo '<tr><td>Data Visibility</td><td>Data is visible in URL</td><td>Data is not visible in URL</td></tr>';
echo '<tr><td>Data Length</td><td>Limited (URL length)</td><td>No limit</td></tr>';
echo '<tr><td>Security</td><td>Less secure (data in URL)</td><td>More secure</td></tr>';
echo '<tr><td>Use Case</td><td>Retrieving data</td><td>Sending data to server</td></tr>';
echo '<tr><td>Caching</td><td>Can be cached/bookmarked</td><td>Cannot be cached</td></tr>';
echo '</table>';

echo '<h3>All Received Data via $_REQUEST</h3>';
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

echo '</body></html>';
?>
