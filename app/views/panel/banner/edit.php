<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=$this->base_url;?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Banner | Ads Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/assets/header.css">
    <script src="public/assets/lib/mediainfo.js/mediainfo.min.js"></script>
    <script src="public/assets/lib/mediainfo.js/script.js"></script>
</head>
<body>
<?php $this->addLayer('app/views/panel/header'); ?>
<?php $this->addLayer('app/request/panel/banner/edit');?>
<?php $banner = $this->theodore('banners', ['id'=>$this->post['banner_id']]); ?>
<div class="m-4">

    <h2>Edit Banner</h2>
    <form action="panel/banner/edit" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Title" value="<?=$banner['title'];?>">
            </div>
            <div class="form-group mt-3">
                <label for="url">URL</label>
                <input class="form-control" type="text" name="url" placeholder="URL" value="<?=$banner['url'];?>">
            </div>
            <div class="form-group mt-3">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image" id="fileinput" accept=".jpeg, .jpg, .png, .webp, .svg, .gif">
            </div>
            <div class="mt-3" id="output">
            <?php if(!empty($banner['image'])){ echo '<img style="max-width:100%;" src="'.$banner['image'].'">'; };?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group mt-3">
                        <label for="position">Position</label>
                        <input class="form-control" type="text" name="position" placeholder="Position" value="<?=$banner['position'];?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <label for="start_date">Start date</label>
                        <input class="form-control" type="date" name="start_date" placeholder="Start date" value="<?=$banner['start_date'];?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <label for="end_date">End date</label>
                        <input class="form-control" type="date" name="end_date" placeholder="End date" value="<?=$banner['end_date'];?>">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php 
            if(isset($this->post['title'])){

                if(!empty($this->errors)) {
                    foreach ($this->errors as $errors) {
                        foreach ($errors as $key => $error) {
                            echo '<strong style="font-size:10px; color:red;">* '.$error.'.</strong><br>';
                        }
                    }
                } else {
                    echo '<strong style="color:green;">Banner updated.</strong>';
                }
                $this->redirect($this->page_back, 5, '#redirect-time');
            }
            ?>
        </div>
        <input type="hidden" name="banner_id" value="<?=$this->post['banner_id'];?>">
        <div class="col-lg-12 pt-2">
            <button class="btn btn-primary rounded-0" type="submit">Save</button>
            <a class="btn btn-dark rounded-0" href="panel/banners">Banners</a>
        </div>
    </div>
    
    <?=$_SESSION['csrf']['input'];?>
    </form>

</div>

<script>
    let divOutputHtml = '',
        divOutputElement = document.body.querySelector('div#output');

    getmediainfojs('#fileinput', (response, e) => {
      divOutputElement.innerHTML = '';

      for (let index = 0; index < e.target.files.length; index++) {
        mime_type = response[index]['media']['mime_type'].split('/')[0];
        filename = truncate(basename(response[index]['media']['filename']), 60);

        // .jpeg, .jpg, .png, .webp, .svg, .gif
        if(mime_type == 'image'){
          divOutputHtml = '<img src="'+getBlobUrl(e.target.files[index])+'" title="'+filename+'" class="img-fluid">';
        }

        divOutputElement.appendChild(stringToHTML(divOutputHtml));
      }

    });
  </script>
</body>
</html>

