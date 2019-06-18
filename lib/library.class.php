<?php
error_reporting(0);
class connectionAPI{
    var $server = "";
    var $user =  "";
    var $password = "";
    var $db = "";
    var $conn = NULL;
    var $connectionHandle = NULL;
    var $affectedrows = 0;
  // Connection constructor function
  public function connectionAPI($server,$user,$password,$db){
    $this->server = $server;
    $this->user =  $user;
    $this->password =  $password;
    $this->db = $db;
    $this->conn =  mysqli_connect($this->server,$this->user,$this->password,$this->db);
    if($this->conn->connect_error){
      return false;
    }else{
      return true;
    }
  }
  // Query execution function
  public function executeQuery($query){
    if($this->conn){
       $result =  $this->conn->query($query);
       $this->affectedrows =  mysqli_num_rows($this->conn->query($query));
       if($result){
         return $result;
       }else{
         return NULL;
       }
    }else{
      return NULL;
    }
  }
  // Query checking function
  public function checkQuery($query){
    if($this->conn){
       $result =  $this->conn->query($query);
       $this->affectedrows =  mysqli_num_rows($this->conn->query($query));
       if($result){
         return true;
       }else{
         return false;
       }
    }else{
      return false;
    }
  }
  // function to display to amount of affected rows
 public function showAffectedRows(){
     return $this->affectedrows;
 }
/*Database connection property setting methods*/
public function setServer($server){
  $this->server =  $server;
}
public function setUser($user){
  $this->user =  $user;
}
public function setPassword($password){
  $this->password =  $password;
}
public function setDb($db){
  $this->db =  $db;
}
public function showConnectionStatus(){
  echo ($this->conn)?"Connected":"Disconnected";
  //echo $set;
}

}

/*Database query sanitization class to avoid sql injection attacks*/
class sanitizer{
  public function sanitize($haystack){
    if (get_magic_quotes_gpc()) $haystack = stripslashes($haystack);
    return mysql_real_escape_string($haystack);
  }
  public function validate($string){
    if(!empty($string) && $string !="" && isset($string)){
      return true;
    }else{
      return false;
    }
  }
  /*Hard redirection*/
    public static function location($url){
        if(!empty($url)){
            $script = "<script type='text/javascript'>window.location='{$url}'</script>";
            //$script = "<meta content='1,{$url}' http-equiv='refresh' >";
            echo $script;
        }
    }
 public function transform($haystack){
   if($this->validate($haystack)){
      return strtolower(trim($haystack));
   }else{
     return NULL;
   }
 }
}
/*user management class and class method*/
class user{
  public $username;
  public $password;
  public $email;
  public $phone;
  public $question;
  public $response;
  public $usertype;
  // public function user($username,$password,$email,$usertype,$phone){
  //   $this->username =  $username;
  //   $this->password =  hash('ripemd128',$password);
  //   $this->email =  $email;
  //   $this->usertype =  $usertype;
  //   $this->phone =  $phone;
  // }
 public function checkuser($username,$conn){
   $query = "SELECT * FROM user WHERE  username='$username'";
   //$result 	= $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row 	= mysqli_num_rows($conn->query($query));

   if ($num_row > 0)
     {
         return false;
     }
     else {
       return true;
     }
 }
 /*user Login checking function*/
 public function login($username,$password,$conn){
   $password =  hash('ripemd128',$password);
   $query = "SELECT * FROM user WHERE  username='$username' AND password='$password'";
   //$result 	= $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row 	= mysqli_num_rows($conn->query($query));

   if ($num_row ==1)
     {
         return true;
     }
     else {
       return false;
     }
 }
 public function addUser($username,$password,$email,$usertype,$phone,$question,$response,$conn){
   $this->username =  $username;
   $this->password =  hash('ripemd128',$password);
   $this->email =  $email;
   $this->usertype =  $usertype;
   $this->phone =  $phone;
   $this->question = $question;
   $this->response = $response;
   $query =  "INSERT INTO user(username,password,email,user_type,phone,questionID,response) VALUES('$this->username','$this->password','$this->email','$this->usertype','$this->phone','$this->question','$this->response')";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public function getUserType($username,$conn){
   $query =  "SELECT user_type FROM user WHERE username='$username'";
   if($conn->query($query)){
     $result =  $conn->query($query);
      $affectedRows =  (mysqli_num_rows($result));
      $row =  ($affectedRows>0)?mysqli_fetch_array($result):NULL;
      return $row[0];
   }
 }
 public function getQuestionID($username,$conn){
   $query =  "SELECT questionID FROM user WHERE username='$username'";
   if($conn->query($query)){
     $result =  $conn->query($query);
      $affectedRows =  (mysqli_num_rows($result));
      $row =  ($affectedRows>0)?mysqli_fetch_array($result):NULL;
      return $row[0];
   }
 }
 public function getResponse($username,$conn){
   $query =  "SELECT response FROM user WHERE username='$username'";
   if($conn->query($query)){
     $result =  $conn->query($query);
      $affectedRows =  (mysqli_num_rows($result));
      $row =  ($affectedRows>0)?mysqli_fetch_array($result):NULL;
      return $row[0];
   }
 }
 public function getSecurityQuestion($questionID,$conn){
   $query =  "SELECT question FROM security WHERE id='$questionID'";
   if($conn->query($query)){
     $result =  $conn->query($query);
      $affectedRows =  (mysqli_num_rows($result));
      $row =  ($affectedRows>0)?mysqli_fetch_array($result):NULL;
      return $row[0];
   }
 }

 public function resetPassword($username,$newPassKey,$conn){
   $password =  hash('ripemd128',$newPassKey);
   $query =  "UPDATE user SET password ='{$password}' WHERE username='{$username}'";
   if($conn->query($query)){
    return true;
   }else{
     return false;
   }
 }
}

/*abstract class*/
class abstract_user{
  public static function uploadImage($file){
    $upload_errors = array(
         // http://www.php.net/manual/en/features.file-upload.errors.php
         UPLOAD_ERR_OK                 => "No errors.",
         UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize.",
         UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE.",
         UPLOAD_ERR_PARTIAL        => "Partial upload.",
         UPLOAD_ERR_NO_FILE        => "No file.",
         UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
         UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
         UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
         );
     $name = $file['profile']['name'];
     $size = $file['profile']['size'];
     switch($file['profile']['type']){
         case 'image/jpeg': $ext = 'jpg';
         break;
         case 'image/gif': $ext = 'gif';
         break;
         case 'image/png': $ext = 'png';
         break;
         case 'image/tiff': $ext = 'tif';
         break;
         default: $ext = '';
         break;
     }
     if($ext ==""){
       return "File type not supported";
     }else{
         $temp = explode(".", $file["profile"]["name"]);
         $rndstr = round(microtime(true))."data";
         $newfilename = hash('ripemd128',$rndstr) . '.' . end($temp);
        if(move_uploaded_file($file["profile"]["tmp_name"], "../upload/" . $newfilename)){
              $result = array();
              $result[0] = "File uploaded successfully";
              $result[1] = $newfilename;
              return $result;
        }else{
            $error = $file['profile']['error'];
            $message = $upload_errors[$error];
            return $message;
        }
     }
  }//End of File Upload Code

  public static function getUserID($username,$conn){
  $query =  "SELECT id FROM user WHERE username='$username'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

 /* public static function get_total_post($conn){
  $query =  "SELECT * FROM property";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }*/
}/*End of abstract class*/
class admin extends abstract_user{
  public static function checkuser($username,$conn){
   $query = "SELECT * FROM superuser WHERE  username='$username'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         return false;
     }else {
       return true;
     }
 }
  public static function add_admin_user($username,$password,$firstName,$middleName="",$lastName,$email,$profilePicture,$conn){
   $password =  hash('ripemd128',$password);
   $query =  "INSERT INTO superuser(username,password,firstName,middleName,lastName,email,profilePicture) VALUES('$username','$password','$firstName','$middleName','$lastName','$email','$profilePicture')";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function get_total_requestor($conn){
  $query =  "SELECT * FROM user WHERE user_type=1";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }
  public static function get_total_railtor($conn){
  $query =  "SELECT * FROM user WHERE user_type=2";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }
  /*public static function get_total_post($conn){
  $query =  "SELECT * FROM property";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }*/
  public static function get_total_transaction($conn){
  $query =  "SELECT * FROM transaction";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }
  public static function delete_admin($id,$conn){
    $query = "SELECT * FROM superuser WHERE  id='$id'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         $query = "DELETE FROM superuser WHERE  id='$id'";
         $result   = $conn->query($query);
         return ($result)?true:false;
     }else {
       return false;
     }
  }
  public static function delete_user($id,$conn){
    $query = "SELECT * FROM user WHERE  id='$id'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         $query = "DELETE FROM user WHERE  id='$id'";
         $result   = $conn->query($query);
         return ($result)?true:false;
     }else {
       return false;
     }

  }
  /*user Login checking function*/
 public static function login($username,$password,$conn){
   $password =  hash('ripemd128',$password);
   $query = "SELECT * FROM superuser WHERE  username='$username' AND password='$password'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   return ($num_row==1)?true:false;
 }
 public static function retrieve_record($username,$conn){
  $query =  "SELECT id,profilePicture FROM superuser WHERE username='$username'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
  public static function retrieve_profile($id,$conn){
  $query =  "SELECT username,CONCAT(firstName,' ',middleName,' ',lastName) as fullname,join_date,email FROM superuser WHERE id='$id'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
}
class requestor extends abstract_user{
  public static function checkuser($userid,$conn){
   $query = "SELECT * FROM requestor WHERE  userID='$userid'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         return false;
     }else {
       return true;
     }
 }
 public static function get_requestor_id($userid,$conn){
  $query =  "SELECT id FROM requestor WHERE userID='$userid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

 public static function add_profile($firstName,$middleName="",$lastName,$tel,$address,$userID,$profilePicture,$regionID,$districtID,$cityID,$conn){
   $query =  "INSERT INTO requestor(firstName,middleName,lastName,tel,address,userID,profilePicture,regionID,districtID,cityID) VALUES('$firstName','$middleName','$lastName','$tel','$address','$userID','$profilePicture','$regionID','$districtID','$cityID')";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function update_profile($firstName,$middleName="",$lastName,$tel,$address,$regionID,$districtID,$cityID,$id,$conn){
   $query =  "UPDATE requestor SET firstName='$firstName',middleName='$middleName',lastName='$lastName',tel='$tel',address='$address',regionID='$regionID',districtID='$districtID',cityID='$cityID' WHERE userID='$id'";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function retrieve_profile_display($id,$conn){
  $query =  "SELECT * FROM requestor AS r WHERE r.userid = '$id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
   public static function retrieve_profile($id,$conn){
  $query =  "SELECT u.username,CONCAT(r.firstName,' ',r.middleName,' ',r.lastName) as fullname,u.join_date,u.email,r.tel,r.address,c.name AS city,re.name AS region,d.name AS district FROM user AS u LEFT JOIN requestor AS r ON u.id=r.userid LEFT JOIN city as c ON r.cityid=c.id LEFT JOIN district as d ON d.id=r.districtid LEFT JOIN region as re ON re.id =r.regionid WHERE r.userid = '$id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
  public static function check_transaction($requestor_id,$property_id,$railtor_id,$conn){
    $query = "SELECT * FROM transaction WHERE  railtor_id='$railtor_id' AND requestor_id='$requestor_id' AND property_id='$property_id'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         return false;
     }else {
       return true;
     }
  }
  public static function send_request($requestor_id,$property_id,$railtor_id,$conn){
    $query = "INSERT INTO transaction(requestor_id,property_id,railtor_id) VALUES('$requestor_id','$property_id','$railtor_id')";
     if($conn->query($query)){
        return true;
     }else{
       return false;
     }
  }
  public static function delete_request($requestor_id,$transaction_id,$conn){
   $query =  "UPDATE transaction SET trashed=0 WHERE id='$transaction_id' AND requestor_id='$requestor_id'";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function get_total_request($requestor_id,$conn){
  $query =  "SELECT * FROM transaction  WHERE requestor_id= '$requestor_id' AND trashed=1;";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }
  public static function get_profile_url($userid,$conn){
  $query =  "SELECT profilePicture FROM requestor WHERE userID='$userid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

  public static function retrieve_request($id,$conn){
  $query =  "SELECT t.railtor_id AS railtorid,t.logged_date AS loggeddate,t.id AS transactionid,t.requestor_id AS requestorid,t.property_id AS propertyid,CONCAT(r.firstName,' ',r.middleName,' ',r.lastName) AS fullname FROM transaction AS t LEFT JOIN railtor AS r ON t.railtor_id=r.id WHERE t.requestor_id='$id'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
}

/*Railtor class*/
class railtor extends abstract_user{
  public static function checkuser($userid,$conn){
   $query = "SELECT * FROM railtor WHERE  userID='$userid'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         return false;
     }else {
       return true;
     }
 }
 public static function get_railtor_id($userid,$conn){
  $query =  "SELECT id FROM railtor WHERE userID='$userid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

 public static function add_profile($firstName,$middleName="",$lastName,$tel,$address,$userID,$profilePicture,$regionID,$districtID,$cityID,$conn){
   $query =  "INSERT INTO railtor(firstName,middleName,lastName,tel,address,userID,profilePicture,regionID,districtID,cityID) VALUES('$firstName','$middleName','$lastName','$tel','$address','$userID','$profilePicture','$regionID','$districtID','$cityID')";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function update_profile($firstName,$middleName="",$lastName,$tel,$address,$regionID,$districtID,$cityID,$id,$conn){
   $query =  "UPDATE railtor SET firstName='$firstName',middleName='$middleName',lastName='$lastName',tel='$tel',address='$address',regionID='$regionID',districtID='$districtID',cityID='$cityID' WHERE userID='$id'";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function retrieve_profile_display($id,$conn){
  $query =  "SELECT * FROM railtor AS r WHERE r.userid = '$id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
   public static function retrieve_profile($id,$conn){
    $query =  "SELECT u.username,CONCAT(r.firstName,' ',r.middleName,' ',r.lastName) as fullname,u.join_date,u.email,r.tel,r.address,c.name AS city,re.name AS region,d.name AS district FROM user AS u LEFT JOIN railtor AS r ON u.id=r.userid LEFT JOIN city as c ON r.cityid=c.id LEFT JOIN district as d ON d.id=r.districtid LEFT JOIN region as re ON re.id =r.regionid WHERE r.userid = '$id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
  public static function delete_request($railtor_id,$transaction_id,$conn){
   $query =  "UPDATE transaction SET active=0 WHERE id='$transaction_id' AND railtor_id='$railtor_id'";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
  public static function get_profile_url($userid,$conn){
  $query =  "SELECT profilePicture FROM railtor WHERE userID='$userid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

  public static function retrieve_requestor_profile($id,$conn){
  $query =  "SELECT u.username,r.profilePicture,CONCAT(r.firstName,' ',r.middleName,' ',r.lastName) as fullname,u.join_date,u.email,r.tel,r.address,c.name AS city,re.name AS region,d.name AS district FROM user AS u LEFT JOIN requestor AS r ON u.id=r.userid LEFT JOIN city as c ON r.cityid=c.id LEFT JOIN district as d ON d.id=r.districtid LEFT JOIN region as re ON re.id =r.regionid WHERE r.id = '$id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
public static function get_total_post($railtor_id,$conn){
  $query =  "SELECT * FROM property  WHERE railtorID= '$railtor_id';";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
        return mysqli_num_rows($result_handle);
      }
    }
  }
public static function get_total_request($railtor_id,$conn){
  $query =  "SELECT * FROM transaction  WHERE railtor_id= '$railtor_id' AND active=1";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>=0){
         return mysqli_num_rows($result_handle);
      }
    }
  }
  public static function retrieve_request($id,$conn){
  $query =  "SELECT t.railtor_id AS railtorid,t.logged_date AS loggeddate,t.id AS transactionid,t.requestor_id AS requestorid,t.property_id AS propertyid,CONCAT(r.firstName,' ',r.middleName,' ',r.lastName) AS fullname FROM transaction AS t LEFT JOIN railtor AS r ON t.railtor_id=r.id WHERE t.requestor_id='$id'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
}
abstract class property extends abstract_user{
  public static function delete_property($railtor_id,$property_id,$conn){
    $query = "SELECT * FROM property WHERE  id='$property_id' AND railtorID='$railtor_id'";
   //$result  = $con->query("SELECT * FROM user WHERE  username='$username'");
   $num_row   = mysqli_num_rows($conn->query($query));
   if ($num_row > 0){
         $query = "DELETE FROM property WHERE  id='$property_id' AND railtorID='$railtor_id'";
         $result   = $conn->query($query);
         return ($result)?true:false;
     }else {
       return false;
     }
  }
public static function add_property($description,$railtorID,$propertyPhoto,$area="",$bath="",$room="",$bed="",$parking="",$cost="",$propertyStatus,$propertyType,$regionID,$districtID,$cityID,$conn){
   $query =  "INSERT INTO property(description,railtorID,propertyPhoto,area,bath,room,bed,parking,cost,propertyStatus,propertyType,regionID,districtID,cityID) VALUES('$description','$railtorID','$propertyPhoto','$area','$bath','$room','$bed','$parking','$cost','$propertyStatus','$propertyType','$regionID','$districtID','$cityID')";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
 public static function update_property($description,$railtorID,$area="",$bath="",$room="",$bed="",$parking="",$cost="",$propertyStatus,$propertyType,$regionID,$districtID,$cityID,$propertyid,$conn){
   $query =  "UPDATE property SET description='$description',area='$area',bath='$bath',room='$room',bed='$bed',parking='$parking',cost='$cost',propertyStatus='$propertyStatus',propertyType='$propertyType',regionID='$regionID',districtID='$districtID',cityID='$cityID' WHERE railtorID='$railtorID' AND id='$propertyid'";
   if($conn->query($query)){
     return true;
   }else{
     return false;
   }
 }
public static function retrieve_property_display($propertyid,$railtorid,$conn){
    $query =  "SELECT p.description,p.propertyPhoto,p.area,p.bath,p.room,p.bed,p.parking,p.cost,ps.name AS propertystatus,pt.name AS propertytype,p.post_date,r.name AS region,d.name AS district,c.name AS city,CONCAT(ra.firstName,' ',ra.middleName,' ',ra.lastName) AS fullname,u.email,ra.tel FROM property AS p left JOIN region AS r ON r.id=p.regionID LEFT JOIN district AS d ON d.id=p.districtID LEFT JOIN city AS c ON c.id = p.cityID LEFT JOIN railtor AS ra ON ra.id = p.railtorID LEFT JOIN estate.user AS u ON u.id =ra.userID LEFT JOIN propertyStatus AS ps ON p.propertyStatus=ps.id LEFT JOIN propertytype AS pt ON pt.id = p.propertytype WHERE p.id='$propertyid' AND p.railtorID='$railtorid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }
  public static function retrieve_property($propertyid,$railtorid,$conn){
    $query =  "SELECT * FROM property AS p WHERE p.id='$propertyid' AND p.railtorID='$railtorid'";
    $resultset = array();
    $result_handle =  $conn->query($query);
    if($result_handle){
      if(mysqli_num_rows($result_handle)>0){
        $resultset = mysqli_fetch_array($result_handle);
        return $resultset;
      }
    }
  }

}
class estate_property extends property{
  public static function dance(){
    echo "<script>alert(\"Hello world\");</script>";
  }
}
/*initialization of connectionAPI class*/
$db['server']='localhost';
$db['user']='root';
$db['pass']='';
$db['db']='estate';
$conn =  new connectionAPI($db['server'],$db['user'],$db['pass'],$db['db']);

?>
