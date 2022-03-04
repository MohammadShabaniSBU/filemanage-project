<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Upload file</title>
</head>
<body>

    <div class="container">
        <div class="d-flex justify-content-between my-2">
            <div class="fs-2 fw-bold">
                Google Drive
            </div>
        </div>

        <div class="rounded shadow-lg py-2 px-3">
            <div class="fs-1 mt-3 mb-5">
                Upload File 
            </div>
            <form action="/core/file/upload.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="path" value="<?php echo $_GET['path']; ?>">
                <input type="hidden" name="user" value="<?php echo $_GET['user']; ?>">
                <div class="form-floating mb-3">
                    <input name="filename" type="filename" class="form-control" id="filename" placeholder="">
                    <label for="filename">File Name</label>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Select your file.</label>
                    <input name="file" class="form-control" type="file" id="file">
                </div>
                <div class="mb-3">
                    Your file will be placed in <span class="bg-secondary rounded-3 text-light px-2"><?php echo str_replace(',', '/', $_GET['path']); ?></span>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary" value="Upload the file">
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>