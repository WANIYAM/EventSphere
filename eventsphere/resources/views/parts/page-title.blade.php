
        <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
            </div>
            <div class="page-header__shape-1">
                <img src="assets/images/shapes/page-header-shape-1.png" alt="">
            </div>
            <div class="page-header__shape-2">
                <img src="assets/images/shapes/page-header-shape-2.png" alt="">
            </div>
            <div class="page-header__shape-3">
                <img src="assets/images/shapes/page-header-shape-3.png" alt="">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2><?php if(isset($page_title)&&!empty($page_title)) { echo $page_title; } ?></h2>
                    <div class="thm-breadcrumb__box">
                        <ul class="thm-breadcrumb list-unstyled">
                            <li><a href="index.php">Home</a></li>
                            <li><span>-</span></li>
                            <li><?php if(isset($page_title)&&!empty($page_title)) { echo $page_title; } ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--Page Header End-->