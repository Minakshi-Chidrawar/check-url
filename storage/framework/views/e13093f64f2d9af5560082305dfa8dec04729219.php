<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div style="margin-top: 15%;">        
        <div class="container d-flex h-100">
            <div class="row align-self-center w-100">
                <div class="col-12 mx-auto">
                    <div class="jumbotron">
                        <h4>Provide URL</h4>
                        
                        <form action="home" method="POST" class="pb-5">
                        <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-8">
                                    <input type="url" name="url" id="url" placeholder="Shorten your link" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">Shorten</button>
                                </div>
                            </div>
                        </form>

                        <div>
                            <?php if(!empty($message)): ?>
                                <?php echo e($message); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\Projects\check-url\resources\views/checkUrl/home.blade.php ENDPATH**/ ?>