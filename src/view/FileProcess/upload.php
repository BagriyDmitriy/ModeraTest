    <?php
    /* view/FileProcess/upload.php
     * upload - file to download, upload - post processing request
     * upload - file download request processing
     */
        header('Content-Type: text/html; charset=utf-8');

        $params = $controllerParams;
        if($params['success']){
            echo '- I am a view upload.php<br /><h2>File ',$params['filename'],' succesfully loaded:</h2>',
                "Data successfully written to the file(".$params['filename'].")!<br />",
                'filesize - '.$params["size"].' bytes<br />',
                'count lines - '.$params["cnt"];
            $all="\r\n"."<h2>Tree structure from file(".$params['filename']."):</h2>\r\n";
            echo "<br />".$all,"<pre>",$params['text'],"</pre>","<hr>";
        }
        else{
            echo "<h2>File ", $params['filename']," NOT loaded</h2>";
        }

        ?>
        <form action="/list" method="post" enctype="multipart/form-data">
            <input type="submit" value="PARSE DATA">
