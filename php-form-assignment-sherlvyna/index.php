<?php
$errors = [];
$success = '';
$fullName = $email = $age = $password = $confirmPassword = $phone = $gender = $country = '';
$hobbies = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $country = $_POST['country'] ?? '';
    $hobbies = $_POST['hobby'] ?? [];

    if ($fullName === '') {
        $errors['nameError'] = 'Full name cannot be empty.';
    }

    $emailPattern = '/^[^@\s]+@[^@\s]+\.[^@\s]+$/';
    if (!preg_match($emailPattern, $email)) {
        $errors['emailError'] = 'Enter a valid email address.';
    }

    if ($age === '' || !is_numeric($age)) {
        $errors['ageError'] = 'Age must be a valid number.';
    }

    if (strlen($password) < 6) {
        $errors['passwordError'] = 'Password must be at least 6 characters.';
    }

    if ($confirmPassword !== $password || $confirmPassword === '') {
        $errors['confirmError'] = 'Passwords do not match.';
    }

    $phonePattern = '/^[0-9]{10,}$/';
    if (!preg_match($phonePattern, $phone)) {
        $errors['phoneError'] = 'Phone must be numeric and at least 10 digits.';
    }

    if (!$gender) {
        $errors['genderError'] = 'Please select a gender.';
    }

    if (count($hobbies) === 0) {
        $errors['hobbyError'] = 'Select at least one hobby.';
    }

    if ($country === '') {
        $errors['countryError'] = 'Please select a country.';
    }

    if (empty($errors)) {
        $success = 'Form submitted successfully!';
        $fullName = $email = $age = $password = $confirmPassword = $phone = $gender = $country = '';
        $hobbies = [];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="./validation-style.css">
</head>
<body>
  <?php if ($success): ?>
    <div style="color: green; text-align: center; margin-bottom: 20px;"><?php echo $success; ?></div>
  <?php endif; ?>
  <form id="registrationForm" method="post" action="">
    <h2>Registration Form</h2>

    <label>Full Name:</label>
    <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php echo htmlspecialchars($fullName); ?>">
    <div class="error" id="nameError"><?php echo $errors['nameError'] ?? ''; ?></div>

    <label>Email Address:</label>
    <input type="email" id="email" name="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($email); ?>">
    <div class="error" id="emailError"><?php echo $errors['emailError'] ?? ''; ?></div>

    <label>Age:</label>
    <input type="number" id="age" name="age" placeholder="Enter your age" value="<?php echo htmlspecialchars($age); ?>">
    <div class="error" id="ageError"><?php echo $errors['ageError'] ?? ''; ?></div>

    <label>Password:</label>
    <input type="password" id="password" name="password" placeholder="Minimum 6 characters" value="<?php echo htmlspecialchars($password); ?>">
    <div class="error" id="passwordError"><?php echo $errors['passwordError'] ?? ''; ?></div>

    <label>Confirm Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" value="<?php echo htmlspecialchars($confirmPassword); ?>">
    <div class="error" id="confirmError"><?php echo $errors['confirmError'] ?? ''; ?></div>

    <label>Phone Number:</label>
    <input type="text" id="phone" name="phone" placeholder="10-digit number" value="<?php echo htmlspecialchars($phone); ?>">
    <div class="error" id="phoneError"><?php echo $errors['phoneError'] ?? ''; ?></div>

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?>> Male
    <input type="radio" name="gender" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?>> Female
    <div class="error" id="genderError"><?php echo $errors['genderError'] ?? ''; ?></div>

    <label>Hobbies/Interests:</label>
    <input type="checkbox" name="hobby[]" value="Reading" <?php echo in_array('Reading', $hobbies) ? 'checked' : ''; ?>> Reading
    <input type="checkbox" name="hobby[]" value="Music" <?php echo in_array('Music', $hobbies) ? 'checked' : ''; ?>> Music
    <input type="checkbox" name="hobby[]" value="Sports" <?php echo in_array('Sports', $hobbies) ? 'checked' : ''; ?>> Sports
    <input type="checkbox" name="hobby[]" value="Traveling" <?php echo in_array('Traveling', $hobbies) ? 'checked' : ''; ?>> Traveling
    <input type="checkbox" name="hobby[]" value="Other" <?php echo in_array('Other', $hobbies) ? 'checked' : ''; ?>> Other
    <div class="error" id="hobbyError"><?php echo $errors['hobbyError'] ?? ''; ?></div>

    <label>Country:</label>
    <select id="country" name="country">
      <option value="">-- Select Country --</option>
      <option value="Indonesia" <?php echo ($country === 'Indonesia') ? 'selected' : ''; ?>>Indonesia</option>
      <option value="China" <?php echo ($country === 'China') ? 'selected' : ''; ?>>China</option>
      <option value="USA" <?php echo ($country === 'USA') ? 'selected' : ''; ?>>USA</option>
      <option value="Japan" <?php echo ($country === 'Japan') ? 'selected' : ''; ?>>Japan</option>
      <option value="South Korea" <?php echo ($country === 'South Korea') ? 'selected' : ''; ?>>South Korea</option>
      <option value="India" <?php echo ($country === 'India') ? 'selected' : ''; ?>>India</option>
      <option value="Singapore" <?php echo ($country === 'Singapore') ? 'selected' : ''; ?>>Singapore</option>
      <option value="German" <?php echo ($country === 'German') ? 'selected' : ''; ?>>German</option>
      <option value="Other" <?php echo ($country === 'Other') ? 'selected' : ''; ?>>Other</option>
    </select>
    <div class="error" id="countryError"><?php echo $errors['countryError'] ?? ''; ?></div>

    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>
