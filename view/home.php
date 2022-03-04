<?php 

if (!$_GET['user']) {
    header("Location: /view/login.php");
    exit;
}


$user = $_GET['user'];
$content = include "../core/home.php";
$path = $_GET['path'] ?? 'root';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Home</title>
</head>
<body>

    <div class="modal fade" id="makedir" tabindex="-1" aria-labelledby="makedir" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create directory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/core/dir/make.php" method="POST">
                    <input type="hidden" name="path" value="<?php echo $path; ?>">
                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input name="dirname" type="text" class="form-control" id="dirname" placeholder="">
                            <label for="dirname">Directory Name</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between my-2">
            <div class="fs-2 fw-bold">
                Google Drive
            </div>
            <div>
                <div class="d-flex gap-2">
                    <a href="/view/upload.php?user=<?php echo $user; ?>&path=<?php echo $path; ?>" class="btn btn-outline-primary">
                        Upload file to this Directory
                    </a>
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#makedir">
                        Make Directory
                    </button>
                </div>
            </div>
        </div>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php $parents = explode(',', $path); $a = []; foreach ($parents as $kid) { 
                            $a[] = $kid;
                        ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/view/home.php?user=<?php echo $user; ?>&path=<?php echo implode(',', $a); ?>">
                                <?php echo $kid; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ol>
            </nav>
        </div>
        <div class="container-fluid shadow-lg rounded py-4">
            <?php if (count($content) == 0) { ?>
                <div class="fs-2 text-secondary text-center my-3">
                    There is no file here ☹
                </div>
            <?php } ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach($content as $name => $file) { 
                    $type = isset($file['type']) ? 'file' : 'dir';
                    
                    ?>
                <div class="col">
                    <div class="border rounded p-2">
                        <div class="w-100 row">
                            <div class="col-4">
                                <a href="<?php echo $type == 'file' ? "/storage/{$file['path']}" : "/view/home.php?user=$user&path={$path},{$name}" ?>">
                                    <div class="h-100">
                                        <div class="h-100 border rounded d-flex justify-content-center align-items-center">
                                            <i class="bi bi-<?php echo $type == 'dir' ? 'folder' : 'archive'; ?> fs-1"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <div>
                                    Name: <?php echo $name; ?>
                                </div>
                                <?php if ($type == 'file') { ?>
                                    <div>
                                        Size: <?php $a = convert_size($file['size']); echo $a[0] . $a[1]; ?>
                                    </div>
                                <?php } else { ?>
                                    <div>
                                        Size: <?php $a = convert_size(calc_dir_size($file)); echo $a[0] . $a[1]; ?>
                                    </div>
                                <?php } ?>
                                <div>
                                    Type: <?php echo $type; ?>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="d-flex flex-column justify-content-between gap-2">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>