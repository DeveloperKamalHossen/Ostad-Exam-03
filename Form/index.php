

<!-- PHP Function Starts -->
<?php

function senitize($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    return $data;
}

$allowedGenders = ["male", "female", "others"];
$allowedSkills = ["html", "css", "php", "js"];
$countries = ['Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, North', 'Korea, South', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'];

//Form Validation Starts

if(isset($_POST['signup'])){
$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPhone = $_POST['userPhone'] ?? null;
$gender = $_POST['gender'] ?? null;
$skills = $_POST['skills'] ?? [];
$country = $_POST['country']; 
$pass = $_POST['pass'];


//Name Validation Starts

if(empty($userName)){
    $errName = "<span style='color: red'>Please Enter Your Name</span>";
}elseif(!preg_match("/^[a-zA-Z.\-' ]*$/", $userName)){
    $errName = "<span style='color: red'>Only letters and white space allowed</span>";     //Preg_match is a PHP function that matches a string against a regular expression pattern.
}elseif(strlen($userName) < 3){
    $errName = "<span style='color: red'>Name must be at least 3 characters</span>";   //Strlen is a PHP function that returns the length of a string.
}else{
    $crrName = senitize($userName);  
   }

//Email Validation Starts

   if(empty($userEmail)){
    $errEmail = "<span style='color: red'>Please Enter Your Email</span>";
}elseif(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
    $errEmail = "<span style='color: red'>Invalid Email Format</span>";
}else{
    $crrEmail = senitize($userEmail);

}


//Phone Number Validation Starts

if(empty($errPhone)){
    // $errPhone = "<span style='color: red'>Please Enter Your Phone Number</span>";
}elseif(!preg_match("/^[0-9]*$/", $userPhone)){
    $errPhone = "<span style='color: red'>Only numbers are allowed</span>";
}else{
    $crrPhone = senitize($userPhone);
}


//Gender Validation Starts

if(empty($gender)){
    $errGender = "<span style='color: red'>Please Select your Gender</span>";
}elseif(!in_array($gender, $allowedGenders)){
    $errGender = "<span style='color: red'>Invalid Gender</span>";
}else{
    $crrGender = senitize($gender);
}

//Skills Validation Starts

if(count($skills) == 0){
    // $errSkills = "<span style='color: red'>Please Select at least one skill</span>";
}else{
    foreach($skills as $skill){
        if(!in_array($skill, $allowedSkills)){
            $errSkills = "<span style='color: red'>Invalid Skill</span>";
            $crrSkills = [];
            break;
        }else{
            $crrSkills[] = senitize($skill);
        }
    }
}

//Country Validation Starts

if(empty($country)){
    $errCountry = "<span style='color: red'>Please Select Your Country</span>";
}elseif(!in_array($country, $countries)){
    $errCountry = "<span style='color: red'>Invalid Country</span>";
}else{
    $crrCountry = senitize($country);     
}

//Password Validation Starts

if(empty($pass)){
    // $errPass = "<span style='color: red'>Please Enter Your Password</span>";
}elseif(strlen($pass) < 8){
    $errPass = "<span style='color: red'>Password must be at least 8 characters</span>";
}else{
    $crrPass = senitize($pass);
}

//Data Show Starts

if(isset($crrName) && isset($crrEmail) && isset($crrGender) && isset($crrCountry) && isset($crrPass)){
    $showData = "Name: $crrName <br> Email: $crrEmail
    <br> Gender: $crrGender  <br> Country: $crrCountry <br> Password: $crrPass";
}

}

?>

<!-- PHP Function Ends -->


<!-- CSS Code Starts -->

<style>

    body {
        margin: 0;
        padding: 0;
        font-family: 'Times New Roman', Times, serif, sans-serif;
        /* background-color: grayient(135deg, #667eea 0%, #764ba2 100%); */
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: greenyellow;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: left;
    }
    .form{
        margin: 0 auto;
        width: 600px;
        height: 720px;
        /* height: auto; */
        padding: 20px;
        border: 1px solid #000000;
        border-radius: 10px;
        /* background-color: #f2f2f2; */
        color: #333;
        box-shadow: 0 0 10px rgba(107, 90, 90, 0.47);
        text-align: center;
        background: transparent;
    }

    h1{
        color: #000000ff;
        font-size: 30px;
        margin-bottom: 20px;
    }
    input{
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 5px;
        /* border: 1px solid #667eea; */
        border: 1px solid #000000;
        background-color: transparent;
        color: #000000ff;
    }


    input:focus{
        outline: none;
        border: 1px solid #764ba2;
        box-shadow: 0 0 5px #000000ff;
    }

    button:focus{
        outline: none;
    }
    button:active{
        transform: scale(0.9);
    }
    button:disabled{
        background-color: #ccc;
        color: #333;
        cursor: not-allowed;
    }

    .btn {
    display: inline-block;
    background: transparent;
    color: #000000ff;
    padding: 10px 30px;
    margin: 20px 0;
    border-radius: 7px;
    border: 1px solid #000000ff;
    transition: background 0.5s;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
}

.btn:hover {
    background: #000000ff;
    color: #fff;
    /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
}

.gender{
    display: flex;
    margin: 5px 0;
    padding-right: 200px;
    padding-left: 20px;
    justify-content: center;
    align-items: center;
    color: #000000ff;
}

.skills{
    display: flex;
    margin: 5px 0;
    padding-right: 120px;
    padding-left: 20px;
    justify-content: center;
    align-items: center;
    color: #000000ff;
}

.country{
    display: flex;
    margin: 5px 0;
    padding-right: 120px;
    padding-left: 20px;
    justify-content: left;
    align-items: center;
    color: #000000ff;
    gap: 10px;
}
.country select{
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #000000ff;
    background-color: transparent;
    color: #000000ff;
}

.password{
    display: flex;
    margin: 30px 0;
    padding-right: 120px;
    padding-left: 20px;
    justify-content: center;
    align-items: center;
    color: #000000ff;
}

p{
    color:rgb(138, 115, 0);
    font-size: 13px;
    margin-top: 120px;
    text-align: center;
    font-style: italic;
}

label {
    font-weight: bold;
    display: block;
    /* margin-bottom: 3px; */
    text-align: left;
    font-size: 16px;
    color: #000000ff;
}

</style>

<!-- CSS Code Ends -->


<!-- Digital Form Starts -->
<div class="form">
<h1>Registration Form</h1>
<form action="" method="post">
    <label for="">Your Name :</label>
    <input type="text" placeholder="Your Name" name="userName" value="<?= $userName ?? null; ?>">
    <?= $errName ?? null; ?>
    <br><br>
    <label for="">Your Email :</label>
    <input type="text" placeholder="Your Email" name="userEmail" value="<?= $userEmail ?? null; ?>">
    <?= $errEmail ?? null; ?>
    <br><br>
    <label for="">Your Phone Number :</label>
    <input type="text" placeholder="Your Number" name="userPhone" value="<?= $userPhone ?? null; ?>">
    <?= $errPhone ?? null; ?>
    <br><br>
   <div class="gender">
   Gender: 
    <input type="radio" value="male" name="gender" <?= isset($gender) && $gender == "male" ? "checked":null; ?> /> Male
    <input type="radio" value="female" name="gender" <?= isset($gender) && $gender == "female" ? "checked":null; ?> /> Female
    <input type="radio" value="others" name="gender" <?= isset($gender) && $gender == "others" ? "checked":null; ?>/> Others
    <?= $errGender ?? null; ?>
    <br><br>
   </div>
   <div class="skills">
   Skills:
    <input type="checkbox" value="html" name="skills[]" /> HTML
    <input type="checkbox" value="css" name="skills[]" /> CSS
    <input type="checkbox" value="php" name="skills[]" /> PHP
    <input type="checkbox" value="js" name="skills[]" /> JS
    <?= $errSkills ?? null; ?>
    <br><br>
   </div>
    <div class="country">
    <select name="country">
        <option value="">Select Country</option>
        <?php foreach($countries as $ctr){ ?>
            <option value="<?= $ctr; ?>" <?= isset($country) && $country == $ctr ? "selected":null; ?>><?= $ctr; ?></option>
        <?php } ?>
        </select>
    <?= $errCountry ?? null; ?>
    <br><br>
    </div>
    <input type="password" class="password" name="pass" placeholder="Your your Password">
    <?= $errPass ?? null; ?>
    <br><br>
    <button type="submit" class="btn" name="signup">Sign Up</button>
</form>
<!-- <p>Developer Kamal Hossen</p> -->
</div>
<!-- Digital Form Ends -->

<?= $showData ?? null; ?>