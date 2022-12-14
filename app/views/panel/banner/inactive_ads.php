<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=$this->base_url;?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/assets/header.css">
    <link rel="stylesheet" href="public/assets/pagination.css">
    <link rel="stylesheet" href="public/assets/table.css">
 
    <title>Inactive ads | Ads Manager</title>
</head>

<body>
    <?php $this->addLayer('app/views/panel/header'); ?>
    <div class="m-4">

        <h2>Inactive ads</h2>
        <br>
        <?php $banners = $this->samantha('banners', ['status'=>0]); ?>
        <?php  foreach ($banners as $key => $banner) { ?>
            <div class="alert alert-warning rounded-0 border-0" role="alert">
                <h6>
                    <?=$banner['title'];?><br>
                    <small>It was stopped <em><strong><?=$this->timeAgo($banner['end_date']);?></strong></em></small>
                </h6>
                <a href="<?=$banner['url'];?>"><img style="max-width:100%; max-height:90px; object-fit:none;" src="<?=$banner['image'];?>"></a>
            </div>
        <?php } ?>        
    </div>
</body>
</html>
