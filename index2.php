<?php
 /* include the mysql connect file */
 require_once('connect.php');

// include required files form Facebook SDK
 
// added in v4.0.5
require_once( 'include/Facebook/FacebookHttpable.php' );
require_once( 'include/Facebook/FacebookCurl.php' );
require_once( 'include/Facebook/FacebookCurlHttpClient.php' );
 
// added in v4.0.0
require_once( 'include/Facebook/FacebookSession.php' );
require_once( 'include/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'include/Facebook/FacebookRequest.php' );
require_once( 'include/Facebook/FacebookResponse.php' );
require_once( 'include/Facebook/FacebookSDKException.php' );
require_once( 'include/Facebook/FacebookRequestException.php' );
require_once( 'include/Facebook/FacebookOtherException.php' );
require_once( 'include/Facebook/FacebookAuthorizationException.php' );
require_once( 'include/Facebook/GraphObject.php' );
require_once( 'include/Facebook/GraphSessionInfo.php' );
 
// added in v4.0.5
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;
 
// added in v4.0.0
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
 
// start session
session_start();
 
// init app with app id and secret
FacebookSession::setDefaultApplication( '563460800438057','36e24b9369287738867bc35e7cb54fdf' );
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( $facebook_path.'index.php' );
 
// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
  
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
    $session = null;
  }
  
} else {
  // no session exists
  
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    echo $ex->message;
  }
  
}
 
// see if we have a session
if ( isset( $session ) ) {
  
  // save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
  
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();


  $db = new mysqli($hostname_mysqli,$username_mysqli,$password_mysqli,$database_mysqli);
  if($db->connect_error)
  {
    die("Connect error ({$db->connect_errno}) {$db->connect_error}");
  }
  $id = mysqli_escape_string($db,$graphObject["id"]);
  $result = $db->query("SELECT * FROM `userapps` WHERE `Facebook_ID` = $id;");

  /*Check whether the user is already registered in the database with that ID*/
  if($result->num_rows>0)
    { 
    // if user recognized set a session
    $_SESSION['usr_id']=$graphObject["id"];
    header("location: events.php");
    }
  else {
    header('Location: include/Facebook_SignUp.html');
  }


  
} 
else {
  // show login url
  $params = array(
    'scope' => 'email',
  );
  $loginUrl =  $helper->getLoginUrl($params);
  ?>

<!DOCTYPE html>
<html>

<head>
	<title>Pikelife</title>
  <link rel="stylesheet" href="css/pure-form.css" class="css">

<style>
body 
{
	background:url('images/Wall.jpg') no-repeat;	
	background-color: #c53334;
}
.top_banner{
	background-color: white;
	height:60px;
	width:100%;
	z-index: 3;
	position: fixed;
	top: 0px;
	left: 0px;
	right: 0px;
	border-bottom: 1px solid rgba(0,0,0,0.15);

}
img{
	position: relative;
	left: 100px;
	top: 10px;
}
.text_adver{
	background-color:rgba(0, 0, 0, 0.5);
	height:160px;
	width: 700px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 100px;
	left: 100px;
	color: white;
	padding: 0px 30px 20px 50px;
	border-radius: 40px 40px 40px 40px;
}
.face_book{
	text-align: center;
	background-color:rgba(0, 0, 0, 0.5);
	height:160px;
	width: 300px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 100px;
	left: 930px;
	color: white;
	padding: 15px 20px 5px 20px;
	border-radius: 40px 40px 40px 40px;
}
</style>

<link rel="stylesheet" href="css/auth-buttons.css">

    <!-- prettyify -->
    <link rel="stylesheet" href="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css">
    <script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>

</head>

<body>
	<div class='top_banner'>
  <img src="images/logo_home.png">
  <form style="margin-left: 820px; margin-top:5px" action="" class="pure-form pure-form-aligned">
  <fieldset>

    <input type="email" name="" id="" placeholder="Email">
    <input type="password" name="" id="" placeholder="Password">
    <button type="submit" class="pure-button pure-button-primary">Sign in</button>
  </fieldset>
  </form>
    </div>
	<div class="text_adver">
	      <h3>The best experiences of life, only happen once with friends.</h3>
	      PikeLife gives you the opportunity to create small activities, gather your friends, and have everyone share pictures, documents and feedbacks of your events.
	</div>
	<div class="face_book">
	      <h3>Start Now</h3>
        <form class="pure-form">
    <fieldset class="pure-group">
        <input type="text" class="pure-input-1-4" placeholder="First name" required>
        <input type="text" class="pure-input-1-4" placeholder="Last name" required>
        <input type="email" class="pure-input-1-4" placeholder="Email" required>
        <input type="password" class="pure-input-1-4" placeholder="Password" required>
    </fieldset>

    <fieldset class="pure-group">
      <div class="pure-u-1 pure-u-md-1-3">
                <select id="country" class="pure-input-1-4">
                      <option>Country :</option>
            <option value="" selected="selected">Select Country</option> 
            <option value="United States">United States</option> 
            <option value="United Kingdom">United Kingdom</option> 
            <option value="Afghanistan">Afghanistan</option> 
            <option value="Albania">Albania</option> 
            <option value="Algeria">Algeria</option> 
            <option value="American Samoa">American Samoa</option> 
            <option value="Andorra">Andorra</option> 
            <option value="Angola">Angola</option> 
            <option value="Anguilla">Anguilla</option> 
            <option value="Antarctica">Antarctica</option> 
            <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
            <option value="Argentina">Argentina</option> 
            <option value="Armenia">Armenia</option> 
            <option value="Aruba">Aruba</option> 
            <option value="Australia">Australia</option> 
            <option value="Austria">Austria</option> 
            <option value="Azerbaijan">Azerbaijan</option> 
            <option value="Bahamas">Bahamas</option> 
            <option value="Bahrain">Bahrain</option> 
            <option value="Bangladesh">Bangladesh</option> 
            <option value="Barbados">Barbados</option> 
            <option value="Belarus">Belarus</option> 
            <option value="Belgium">Belgium</option> 
            <option value="Belize">Belize</option> 
            <option value="Benin">Benin</option> 
            <option value="Bermuda">Bermuda</option> 
            <option value="Bhutan">Bhutan</option> 
            <option value="Bolivia">Bolivia</option> 
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
            <option value="Botswana">Botswana</option> 
            <option value="Bouvet Island">Bouvet Island</option> 
            <option value="Brazil">Brazil</option> 
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
            <option value="Brunei Darussalam">Brunei Darussalam</option> 
            <option value="Bulgaria">Bulgaria</option> 
            <option value="Burkina Faso">Burkina Faso</option> 
            <option value="Burundi">Burundi</option> 
            <option value="Cambodia">Cambodia</option> 
            <option value="Cameroon">Cameroon</option> 
            <option value="Canada">Canada</option> 
            <option value="Cape Verde">Cape Verde</option> 
            <option value="Cayman Islands">Cayman Islands</option> 
            <option value="Central African Republic">Central African Republic</option> 
            <option value="Chad">Chad</option> 
            <option value="Chile">Chile</option> 
            <option value="China">China</option> 
            <option value="Christmas Island">Christmas Island</option> 
            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
            <option value="Colombia">Colombia</option> 
            <option value="Comoros">Comoros</option> 
            <option value="Congo">Congo</option> 
            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
            <option value="Cook Islands">Cook Islands</option> 
            <option value="Costa Rica">Costa Rica</option> 
            <option value="Cote D'ivoire">Cote D'ivoire</option> 
            <option value="Croatia">Croatia</option> 
            <option value="Cuba">Cuba</option> 
            <option value="Cyprus">Cyprus</option> 
            <option value="Czech Republic">Czech Republic</option> 
            <option value="Denmark">Denmark</option> 
            <option value="Djibouti">Djibouti</option> 
            <option value="Dominica">Dominica</option> 
            <option value="Dominican Republic">Dominican Republic</option> 
            <option value="Ecuador">Ecuador</option> 
            <option value="Egypt">Egypt</option> 
            <option value="El Salvador">El Salvador</option> 
            <option value="Equatorial Guinea">Equatorial Guinea</option> 
            <option value="Eritrea">Eritrea</option> 
            <option value="Estonia">Estonia</option> 
            <option value="Ethiopia">Ethiopia</option> 
            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
            <option value="Faroe Islands">Faroe Islands</option> 
            <option value="Fiji">Fiji</option> 
            <option value="Finland">Finland</option> 
            <option value="France">France</option> 
            <option value="French Guiana">French Guiana</option> 
            <option value="French Polynesia">French Polynesia</option> 
            <option value="French Southern Territories">French Southern Territories</option> 
            <option value="Gabon">Gabon</option> 
            <option value="Gambia">Gambia</option> 
            <option value="Georgia">Georgia</option> 
            <option value="Germany">Germany</option> 
            <option value="Ghana">Ghana</option> 
            <option value="Gibraltar">Gibraltar</option> 
            <option value="Greece">Greece</option> 
            <option value="Greenland">Greenland</option> 
            <option value="Grenada">Grenada</option> 
            <option value="Guadeloupe">Guadeloupe</option> 
            <option value="Guam">Guam</option> 
            <option value="Guatemala">Guatemala</option> 
            <option value="Guinea">Guinea</option> 
            <option value="Guinea-bissau">Guinea-bissau</option> 
            <option value="Guyana">Guyana</option> 
            <option value="Haiti">Haiti</option> 
            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
            <option value="Honduras">Honduras</option> 
            <option value="Hong Kong">Hong Kong</option> 
            <option value="Hungary">Hungary</option> 
            <option value="Iceland">Iceland</option> 
            <option value="India">India</option> 
            <option value="Indonesia">Indonesia</option> 
            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
            <option value="Iraq">Iraq</option> 
            <option value="Ireland">Ireland</option> 
            <option value="Israel">Israel</option> 
            <option value="Italy">Italy</option> 
            <option value="Jamaica">Jamaica</option> 
            <option value="Japan">Japan</option> 
            <option value="Jordan">Jordan</option> 
            <option value="Kazakhstan">Kazakhstan</option> 
            <option value="Kenya">Kenya</option> 
            <option value="Kiribati">Kiribati</option> 
            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
            <option value="Korea, Republic of">Korea, Republic of</option> 
            <option value="Kuwait">Kuwait</option> 
            <option value="Kyrgyzstan">Kyrgyzstan</option> 
            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
            <option value="Latvia">Latvia</option> 
            <option value="Lebanon">Lebanon</option> 
            <option value="Lesotho">Lesotho</option> 
            <option value="Liberia">Liberia</option> 
            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
            <option value="Liechtenstein">Liechtenstein</option> 
            <option value="Lithuania">Lithuania</option> 
            <option value="Luxembourg">Luxembourg</option> 
            <option value="Macao">Macao</option> 
            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
            <option value="Madagascar">Madagascar</option> 
            <option value="Malawi">Malawi</option> 
            <option value="Malaysia">Malaysia</option> 
            <option value="Maldives">Maldives</option> 
            <option value="Mali">Mali</option> 
            <option value="Malta">Malta</option> 
            <option value="Marshall Islands">Marshall Islands</option> 
            <option value="Martinique">Martinique</option> 
            <option value="Mauritania">Mauritania</option> 
            <option value="Mauritius">Mauritius</option> 
            <option value="Mayotte">Mayotte</option> 
            <option value="Mexico">Mexico</option> 
            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
            <option value="Moldova, Republic of">Moldova, Republic of</option> 
            <option value="Monaco">Monaco</option> 
            <option value="Mongolia">Mongolia</option> 
            <option value="Montserrat">Montserrat</option> 
            <option value="Morocco">Morocco</option> 
            <option value="Mozambique">Mozambique</option> 
            <option value="Myanmar">Myanmar</option> 
            <option value="Namibia">Namibia</option> 
            <option value="Nauru">Nauru</option> 
            <option value="Nepal">Nepal</option> 
            <option value="Netherlands">Netherlands</option> 
            <option value="Netherlands Antilles">Netherlands Antilles</option> 
            <option value="New Caledonia">New Caledonia</option> 
            <option value="New Zealand">New Zealand</option> 
            <option value="Nicaragua">Nicaragua</option> 
            <option value="Niger">Niger</option> 
            <option value="Nigeria">Nigeria</option> 
            <option value="Niue">Niue</option> 
            <option value="Norfolk Island">Norfolk Island</option> 
            <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
            <option value="Norway">Norway</option> 
            <option value="Oman">Oman</option> 
            <option value="Pakistan">Pakistan</option> 
            <option value="Palau">Palau</option> 
            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
            <option value="Panama">Panama</option> 
            <option value="Papua New Guinea">Papua New Guinea</option> 
            <option value="Paraguay">Paraguay</option> 
            <option value="Peru">Peru</option> 
            <option value="Philippines">Philippines</option> 
            <option value="Pitcairn">Pitcairn</option> 
            <option value="Poland">Poland</option> 
            <option value="Portugal">Portugal</option> 
            <option value="Puerto Rico">Puerto Rico</option> 
            <option value="Qatar">Qatar</option> 
            <option value="Reunion">Reunion</option> 
            <option value="Romania">Romania</option> 
            <option value="Russian Federation">Russian Federation</option> 
            <option value="Rwanda">Rwanda</option> 
            <option value="Saint Helena">Saint Helena</option> 
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
            <option value="Saint Lucia">Saint Lucia</option> 
            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
            <option value="Samoa">Samoa</option> 
            <option value="San Marino">San Marino</option> 
            <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
            <option value="Saudi Arabia">Saudi Arabia</option> 
            <option value="Senegal">Senegal</option> 
            <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
            <option value="Seychelles">Seychelles</option> 
            <option value="Sierra Leone">Sierra Leone</option> 
            <option value="Singapore">Singapore</option> 
            <option value="Slovakia">Slovakia</option> 
            <option value="Slovenia">Slovenia</option> 
            <option value="Solomon Islands">Solomon Islands</option> 
            <option value="Somalia">Somalia</option> 
            <option value="South Africa">South Africa</option> 
            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
            <option value="Spain">Spain</option> 
            <option value="Sri Lanka">Sri Lanka</option> 
            <option value="Sudan">Sudan</option> 
            <option value="Suriname">Suriname</option> 
            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
            <option value="Swaziland">Swaziland</option> 
            <option value="Sweden">Sweden</option> 
            <option value="Switzerland">Switzerland</option> 
            <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
            <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
            <option value="Tajikistan">Tajikistan</option> 
            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
            <option value="Thailand">Thailand</option> 
            <option value="Timor-leste">Timor-leste</option> 
            <option value="Togo">Togo</option> 
            <option value="Tokelau">Tokelau</option> 
            <option value="Tonga">Tonga</option> 
            <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
            <option value="Tunisia">Tunisia</option> 
            <option value="Turkey">Turkey</option> 
            <option value="Turkmenistan">Turkmenistan</option> 
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
            <option value="Tuvalu">Tuvalu</option> 
            <option value="Uganda">Uganda</option> 
            <option value="Ukraine">Ukraine</option> 
            <option value="United Arab Emirates">United Arab Emirates</option> 
            <option value="United Kingdom">United Kingdom</option> 
            <option value="United States">United States</option> 
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
            <option value="Uruguay">Uruguay</option> 
            <option value="Uzbekistan">Uzbekistan</option> 
            <option value="Vanuatu">Vanuatu</option> 
            <option value="Venezuela">Venezuela</option> 
            <option value="Viet Nam">Viet Nam</option> 
            <option value="Virgin Islands, British">Virgin Islands, British</option> 
            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
            <option value="Wallis and Futuna">Wallis and Futuna</option> 
            <option value="Western Sahara">Western Sahara</option> 
            <option value="Yemen">Yemen</option> 
            <option value="Zambia">Zambia</option> 
            <option value="Zimbabwe">Zimbabwe</option>

                </select>
        </div>
        <input type="text" class="pure-input-1-4" placeholder="Hometown">
        <div class="pure-u-1 pure-u-md-1-3">
                <select id="gender" class="pure-input-1-4">
                    <option>Gender :</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
        </div>
    </fieldset>

    <button type="submit" class="pure-button pure-input-1-4 pure-button-primary">Sign up</button>
</form>
	      <p><a class="btn-auth btn-facebook large" href="<?= $helper->getLoginUrl($params) ?>">Sign in with <b>Facebook</b></a></p>
	      
	</div>
	<div id="fb-root"></div>

	

</body>

</html>
<?php
}
?>