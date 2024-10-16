<?php

function conn()
{

  $dbname     = "tmp1";
  $dbhost     = "127.0.0.1";
  $dbusername = "newuser";
  $dbpassword = 'p4$$w0rd!_!';
  
  $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
  
  return $conn;
}

function add_files($FILES, $alias)
{  
    $target_dir = "/var/www/html/cms/images/";
    
    // Check if file was uploaded without errors
    if(isset($FILES["fileToUpload"]) && 
        $FILES["fileToUpload"]["error"] == 0) {
        $allowed_ext = array("jpg" => "image/jpg",
                            "jpeg" => "image/jpeg",
                            "gif" => "image/gif",
                            "png" => "image/png");
        $file_name = basename($FILES["fileToUpload"]["name"]);
        $file_type = $FILES["fileToUpload"]["type"];
        $file_size = $FILES["fileToUpload"]["size"];
        $target_file = $target_dir . "$alias." . substr($file_type, 6, );
        $t = "$alias." . substr($file_type, 6, );
        
        // Verify file extension
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
  
        if (!array_key_exists($ext, $allowed_ext)) {
            return 0;
        }    
        
        // Verify file size - 2MB max
        $maxsize = 2 * 1024 * 1024;
          
        if ($file_size > $maxsize) {
            return 0;
        }
      
        // Verify MYME type of the file
        if (in_array($file_type, $allowed_ext))
        {  
            // Check whether file exists before uploading it
           //  if (file_exists("/var/www/html/cms/images/" . $FILES["fileToUpload"]["name"])) {
            if (file_exists($target_file)) {
                return 0;
            }
            else {
                if (move_uploaded_file($FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    return $t;
                } 
                else {
                    return 0;
                }
            }
        }
        else {
            return 0;
        }
    }
    else {
        return 0;
    }
    return 1;
}

function make_prod($alias, $descr, $price, $count)
{
  
  $conn = conn();
  $sql = "select path from products where alias='$alias';";
  try
  {
    $result = $conn -> query($sql);
    $row = $result -> fetch_array();
    $path = $row['path'];
  } catch (Exception $e) {
    return 0;
  }
  $conn -> close();
  
  
  $q = "
<head>
  <meta charset='UTF-8'>
  <title>Home page</title>

  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css'>
  <link href='/cms/styles/style_prod.css' rel='stylesheet'>
</head>
  
<body>
  ". '<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"> 
  <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
  <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="shop.php"><h5>Shop</h5></a>
  </nav>
  <a class="p-2 text-dark" href="cart.php"><h5>Корзина</h5></a>
  </div>
    
  <div class="container">
    <div class="row">
      <div class="col-md-12">
                
        <div class="image"> '. "
          <img src='../images/$path'>
        </div>
    		
	<div class='name'>
            <h4>$alias</h4>
        </div>
                
        <div class='price'>
	    <h5>$price</h5>
	</div>
    		
	<div class='much'>
	    <h5>$count</h5>
	</div>
    		
	<div class='descr' id='descr' value='$descr'>
	    <p>Desription: $descr</p>
	</div>
    		
	<form action='' method='POST'>
    		  
	  <input type='hidden' name='name' class='form-control' value='$alias' required />
	  
	  <div class='form-group'>
            <label><h4>count</h4></label>
            <input type='number' name='cb' class='form-control' min='0' max='$count' required />
          </div>
	  " . '
	  <div class="cont">
	    <div class="center">
  	      <input type="submit" value="Add to cart" name="submit" class="btn btn-primary" id="submit" />
	    </div>
	  </div>
	</form>
	
      </div>
    </div>
  </div>   
</body>
  ';
  
  return $q;
}

function tget($url, $id)
{
  $doc = new DomDocument;

  $doc->validateOnParse = true;
  $doc->loadHTMLFile($url);
  
  $el = $doc->getElementById($id);
  return $el->getAttribute('value');
}

?>
