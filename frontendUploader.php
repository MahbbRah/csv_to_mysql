<!DOCTYPE html>
<html>
       <head>
               <title>CSV Upload</title>
       </head>
       <body>
                <form method="POST" enctype="multipart/form-data" action="import_csv.php">
                         <div align="center">
                                  <p>Select CSV file: <input type="file" name="file"  /></p>
                                  <p><input type="submit" name="csv_upload_btn" value="Upload"  /></p>
                         </div>
                </form>
       </body>
</html>