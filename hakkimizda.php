<?php require_once 'header.php';

$hakkimızdasor = $db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
$hakkimızdasor->execute(array(
    'id' => 0
));
$hakkimizdacek = $hakkimızdasor->fetch(PDO::FETCH_ASSOC);
?>

<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2 style="color:white;"><?php echo $hakkimizdacek['hakkimizda_baslik'] ?></h2>

        </div>
    </div>
</div>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>

<div class="about-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="inner-page-main-body">
            <div class="single-banner">
                <iframe center width="1100" height="480" src="<?php echo $hakkimizdacek['hakkimizda_video'] ?>"
                 title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                 encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <h2 class="title-section">Biz Kimiz</h2>
            <div class="inner-page-details inner-page-padding">
                <h3>Ne Yapıyoruz?</h3>
                <p><?php echo $hakkimizdacek['hakkimizda_icerik'] ?></p>
                <h3>Misyonumuz</h3>
                <p><?php echo $hakkimizdacek['hakkimizda_vizyon']?>  <br><br> <?php echo $hakkimizdacek['hakkimizda_misyon'] ?></p>
                
            </div>
        </div>
    </div>

    <div class="pagination-area bg-secondary">
        <div class="container">
            <div class="pagination-wrapper">

            </div>
        </div>
    </div>

    <?php
    require_once 'footer.php';
    ?>