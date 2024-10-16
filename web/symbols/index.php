<?php
if (isset($_FILES['file']))
{
	if ($_FILES['file']['error'] > 0) {
		echo 'Error uploading file';
	} else {
		$filename = $_FILES['file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		if ($extension == 'zip') {
		    // Unzip the archive
		    $unzipCommand = "unzip -o {$_FILES['file']['tmp_name']} -d ./uploads";
		    exec($unzipCommand);

		    // Call the Python script
		    $pythonScript = "./../script.py";
		    $pythonCommand = "python3 $pythonScript";
		    $output = array();
		    exec($pythonCommand, $output);

		    $json_data = file_get_contents('../data.json');
		    $data = json_decode($json_data, true);

		} elseif ($extension == 'txt') {
		    // Save the text file to ./uploads directory with a unique filename
		    $uploadDir = './uploads/';
		    $uniqueFilename = uniqid() . '.' . $extension;
		    $uploadFile = $uploadDir . $uniqueFilename;
		    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
		    # echo "Text file uploaded successfully to $uploadFile\n";

		    // Call the Python script
		    $pythonScript = "./../script.py";
		    $pythonCommand = "python3 $pythonScript";
		    $output = array();
		    exec($pythonCommand, $output);

		    // Read the JSON data from the file
		    $json_data = file_get_contents('../data.json');
		    $data = json_decode($json_data, true);

		} else {
		    echo 'Invalid file type';
		}
	}
}
?>


<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Случайная Карта Таро</title>

    <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.1/jquery.fullPage.min.css" />-->
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.1/vendors/jquery.easings.min.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.7/jquery.slimscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.1/jquery.fullPage.min.js"></script>

</head>
<body>
	<div id="fullpage">

		<div data-anchor="firstPage" class="section">

            <div class="overlay"></div>
            <div class="popup">Сосредоточьтесь на своем состоянии. Нажмите на колоду карт. Прокрутите вниз. Прочитайте о своем эмоциональном состоянии.<br><br>Не увлекайтесь слишком сильно, карта просто показывает ваше настроение и не является гадалкой. Также найдите карты, разделенные на астрологические дома. Нажмите на колоду снова, чтобы повторить.</div>

            <div id="rider-waite"><a href="#" onclick="load('rider-waite');">Таро Райдера-Вейта</a></div>

            <div id="main-card">
                <img class="front-img">
                <div class="cover"><img class="cover-img" src="https://raw.githubusercontent.com/alnero/Zipline-data/master/Taro/img/deck.png"></div>
            </div>

            <div id="card-name"></div>

            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>

		</div>
		<!-- firstPage -->
		
		<div data-anchor="secondPage" class="section">
        <div id="wrapper">
            <div id="I-VI" class="column">
                <div id="I" class="left">I</div>
                <div id="II" class="left">II</div>
                <div id="III" class="left">III</div>
                <div id="IV" class="left">IV</div>
                <div id="V" class="left">V</div>
                <div id="VI" class="left">VI</div>
            </div>
            <!-- I-VI -->

            <div id="VII-XII" class="column">
                <div id="VII" class="right">VII</div>
                <div id="VIII" class="right">VIII</div>
                <div id="IX" class="right">IX</div>
                <div id="X" class="right">X</div>
                <div id="XI" class="right">XI</div>
                <div id="XII" class="right">XII</div>
            </div>
            <!-- VII-XII -->

            <div class="card-description">
                <div class="small-card"></div>
            </div>
        </div>
        </div>
		<!-- secondPage -->
		
		<div data-anchor="thirdPage" class="section">
        <div id="wrapper">
            <h2>Узнай самое частое встречаемое слово в файле (карты таро и не такое могут)</h2>
            <form action="index.php" method="post" enctype="multipart/form-data">
				<input type="file" name="file">
				<button type="submit">Upload File</button>
			</form>
        </div>
        <?php
		if (isset($data)) {
			echo '<table style="color: white; background-color: black; border-collapse: collapse; margin: 0 auto;">';
			echo '<tr style="background-color: #333;">';
			echo '<th style="border: 1px solid white; padding: 10px;">Файл</th>';
			echo '<th style="border: 1px solid white; padding: 10px;">Самое частое слово</th>';
			echo '<th style="border: 1px solid white; padding: 10px;">Количество раз</th>';
			echo '</tr>';
			foreach ($data as $value) {
				echo '<tr>';
				echo '<td style="border: 1px solid white; padding: 10px;">' . $value['file_name'] . '</td>';
				echo '<td style="border: 1px solid white; padding: 10px;">' . $value['word'] . '</td>';
				echo '<td style="border: 1px solid white; padding: 10px;">' . $value['frequency'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		?>
        </div>
		<!-- thirdPage -->
		
	</div>
	<!-- fullpage -->
	<script src="script.js"></script>
</body>
</html>
