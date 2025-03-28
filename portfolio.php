<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>WIW - Portfolio</title>

<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">

    <?php include "header.php"?>

        <!-- page-title -->
        <section class="page-title">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-54.webp);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-55.webp);"></div>
                <div class="pattern-3" style="background-image: url(assets/images/shape/shape-43.webp);"></div>
                <div class="pattern-4" style="background-image: url(assets/images/shape/shape-4.webp);"></div>
                <div class="pattern-5" style="background-image: url(assets/images/shape/shape-56.webp);"></div>
                <div class="pattern-6" style="background-image: url(assets/images/shape/shape-57.webp);"></div>
                <div class="pattern-7 rotate-me" style="background-image: url(assets/images/shape/shape-58.webp);"></div>
                <div class="pattern-8" style="background-image: url(assets/images/shape/shape-50.webp);"></div>
            </div>
            <div class="auto-container">
                <div class="inner-box">
                    <div class="content-box">
                        <h1>Portfolio Page</h1>
                        <ul class="bread-crumb">
                            <li><a href="index.php">Home</a></li>
                            <li>Portfolio Page</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- gallery-page-section -->
        <section class="gallery-page-section p_relative pt_120 pb_120">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Gallery items would be looped through here -->
                    <?php
                    // Configuration
                    $itemsPerPage = 8; // Matches your 8-item layout
                    $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    $totalItems = 40; // Replace with actual count from database
                    
                    // Calculate pagination
                    $totalPages = ceil($totalItems / $itemsPerPage);
                    $offset = ($currentPage - 1) * $itemsPerPage;
                    
                    // Database query would go here (example only)
                    // $galleryItems = getGalleryItems($offset, $itemsPerPage);
                    
                    // Simulated gallery items (replace with your actual data)
                    for ($i = 1; $i <= $itemsPerPage; $i++) {
                        $imgNum = $offset + $i;
                        if ($imgNum > 16) $imgNum = $imgNum % 16; // Just for this demo
                        if ($imgNum == 0) $imgNum = 16;
                        
                        // Determine column classes based on position
                        $colClass = ($i % 4 == 1 || $i % 4 == 5) ? 'col-lg-6' : 'col-lg-5';
                        $offsetClass = ($i % 4 == 2 || $i % 4 == 0) ? 'offset-xl-1' : '';
                        
                        echo '
                        <div class="'.$colClass.' col-md-6 col-sm-12 gallery-block '.$offsetClass.'">
                            <div class="gallery-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="assets/images/project/gallery-'.$imgNum.'.webp" alt=""></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="link"><a href="portfolio-details.php">'.($i % 2 ? 'Web Design' : 'UX/UI').'</a></div>
                                        <p>December 12, 2023</p>
                                        <h3><a href="portfolio-details.html">Project '.$imgNum.'</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-wrapper centred">
                    <ul class="pagination clearfix">
                        <?php if ($currentPage > 1): ?>
                            <li><a href="?page=<?= $currentPage - 1 ?>"><i class="fas fa-angle-left"></i></a></li>
                        <?php endif; ?>
                        
                        <?php
                        // Show page numbers
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $currentPage + 2);
                        
                        if ($startPage > 1) {
                            echo '<li><a href="?page=1">1</a></li>';
                            if ($startPage > 2) echo '<li class="disabled"><span>...</span></li>';
                        }
                        
                        for ($i = $startPage; $i <= $endPage; $i++) {
                            echo '<li'.($i == $currentPage ? ' class="current"' : '').'>';
                            echo '<a href="?page='.$i.'">'.str_pad($i, 2, '0', STR_PAD_LEFT).'</a>';
                            echo '</li>';
                        }
                        
                        if ($endPage < $totalPages) {
                            if ($endPage < $totalPages - 1) echo '<li class="disabled"><span>...</span></li>';
                            echo '<li><a href="?page='.$totalPages.'">'.$totalPages.'</a></li>';
                        }
                        ?>
                        
                        <?php if ($currentPage < $totalPages): ?>
                            <li><a href="?page=<?= $currentPage + 1 ?>"><i class="fas fa-angle-right"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- gallery-page-section end -->


        <div class="slide-text">
            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-20.webp);"></div>
            <div class="big-text"><span class="white_text">Creative . </span><span class="text_stroke">designe . </span><span class="theme_color">branding . </span><span class="text_stroke">Marketing . </span><span class="white_text">Idea . </span><span class="theme_color">Innovative</span></div>
        </div>


        <?php include "footer.php"?>
        
    </div>

</body>
</html>
