<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scenario A Form</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
<h1>Scenario A - Student Information Form</h1>

<form action="process.php" method="post">

<div class="form-group">
<label for="fullname">Full Name</label>
<input type="text" id="fullname" name="fullname" required>
</div>

<div class="form-group">
<label for="email">Email Address</label>
<input type="email" id="email" name="email" required>
</div>

<div class="form-group">
<label for="phone">Phone Number</label>
<input type="text" id="phone" name="phone" required>
</div>

<div class="form-group">
<label for="message">Message / Introduction</label>
<textarea id="message" name="message" rows="5" required></textarea>
</div>

<div class="form-group">
<label for="programme">Programme</label>
<select id="programme" name="programme" required>
<option value="">-- Select Programme --</option>
<option value="Computer Science">Computer Science</option>
<option value="Information Systems">Information Systems</option>
<option value="Software Engineering">Software Engineering</option>
</select>
</div>

<div class="form-group">
<label>Gender</label>
<input type="radio" id="male" name="gender" value="Male" required>
<label for="male">Male</label>

<input type="radio" id="female" name="gender" value="Female">
<label for="female">Female</label>
</div>

<div class="form-group">
<label>Interests</label>
<input type="checkbox" id="php" name="interests[]" value="PHP">
<label for="php">PHP</label>

<input type="checkbox" id="mysql" name="interests[]" value="MySQL">
<label for="mysql">MySQL</label>

<input type="checkbox" id="javascript" name="interests[]" value="JavaScript">
<label for="javascript">JavaScript</label>
</div>

<div class="form-group">
<button type="submit">Submit Form</button>
</div>

</form>
</div>

<footer>
CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
</footer>

</body>
</html>
