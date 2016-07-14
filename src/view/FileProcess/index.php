<h1>
<?php header('Content-Type: text/html; charset=utf-8'); 
/*index - по -умолчанию
View/FileProcess/index.php - отображает результат метода index в контроллере  FileProcessController*/
?>Welcome to test program!!!
</h1>

<form action="/upload" method="post" enctype="multipart/form-data">
	<input type="file" name="uploadfile">
	<input type="submit" value="Загрузить">
</form>	

