<h1>
<?php header('Content-Type: text/html; charset=utf-8');
/* Index - default
 * view/FileProcess/index.php - displays the result of the method index of controller in the FileProcessController
 */
?>Welcome to test program!!!
</h1>

<form action="/upload" method="post" enctype="multipart/form-data">
	<input type="file" name="uploadfile">
	<input type="submit" value="Загрузить">
</form>	

