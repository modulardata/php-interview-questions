<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>UberGallery</title>
    
    <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/img/favicon.png" />

    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/bootstrap-responsive.min.css" />
    <?php echo $gallery->getColorboxStyles(1); ?>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="resources/colorbox/jquery.colorbox.js"></script>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("a[rel='colorbox']").colorbox({maxWidth: "90%", maxHeight: "90%", opacity: ".5"});
        });
    </script>
    
    <?php file_exists('googleAnalytics.inc') ? include('googleAnalytics.inc') : false; ?>
    
</head>

<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <h1 class="brand">UberGallery</h1>
            </div>
        </div>
    </div>

    <div class="container">
        
        <?php if($gallery->getSystemMessages()): ?>
            <div class="row">
                <ul id="systemMessages">
                    <?php foreach($gallery->getSystemMessages() as $message): ?>
                        <li class="alert alert-<?php echo $message['type']; ?>">
                            <a class="close" data-dismiss="alert">×</a>
                            <?php echo $message['text']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
            
        <!-- Start UberGallery v<?php echo UberGallery::VERSION; ?> - Copyright (c) <?php echo date('Y'); ?> Chris Kankiewicz (http://www.ChrisKankiewicz.com) -->
        <ul class="gallery-wrapper thumbnails">
            <?php foreach ($galleryArray['images'] as $image): ?>
                <li class="">
                    <a href="<?php echo $image['file_path']; ?>" title="<?php echo $image['file_title']; ?>" class="thumbnail" rel="colorbox">
                        <img src="<?php echo $image['thumb_path']; ?>" alt="<?php echo $image['file_title']; ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- End UberGallery - Distributed under the MIT license: http://www.opensource.org/licenses/mit-license.php -->
        
        <hr/>
        
        
        <?php if ($galleryArray['stats']['total_pages'] > 1): ?>
            
            <div class="pagination pagination-centered">
                <ul>
                    <?php foreach ($galleryArray['paginator'] as $item): ?>
                        
                        <?php
                        
                            switch ($item['class']) {
                                    
                                case 'title':
                                    $class = 'disabled';
                                    break;
                                    
                                case 'inactive':
                                    $class = 'disabled';
                                    break;
                                    
                                case 'current':
                                    $class = 'active';
                                    break;
                                    
                                case 'active':
                                    $class = NULL;
                                    break;
                                
                            }
                            
                        ?>
                        
                        <li class="<?php echo $class; ?>">
                            <a href="<?php echo empty($item['href']) ? '#' : $item['href']; ?>"><?php echo $item['text']; ?></a>
                        </li>
                        
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <p class="credit">Powered by, <a href="http://www.ubergallery.net">UberGallery</a></p>
        
    </div>
    
</body>

<!-- Page template by, Chris Kankiewicz <http://www.chriskankiewicz.com> -->

</html>