<?php include 'app/views/_global/beforeContent.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h2><?php echo htmlspecialchars($DATA['car']->brand->name); ?> <?php echo htmlspecialchars($DATA['car']->model->name); ?></h2>
        <img src="<?php echo Configuration::BASE_PATH . @$DATA['car']->main_image; ?>" id="backgroundImg"  class="img-responsive" width="500"><br/>
    <!--    <?php foreach($DATA['car']->images as $image): ?>
            <img src="<?php echo Configuration::BASE_PATH .$image->path; ?>" alt="" width="150px" onclick="changeImg(event)" onmouseover="redBorder(this)" onmouseout="greyBorder(this)" class="imgList" style="border:3px solid grey">
        <?php endforeach; ?> -->
        <p>Cena: <?php echo $DATA['car']->price; ?>&euro;</p>
        <p><i class="far fa-calendar-alt"></i> Datum postavke: <?php echo $DATA['car']->date; ?></p>
        <p><i class="fas fa-map-marker-alt"></i> Location: <?php echo $DATA['car']->location->name; ?></p>
        <p>Opis<hr><?php echo htmlspecialchars($DATA['car']->description); ?></p>
    </div>
</div>

<script>
    function redBorder(img){
        img.style.cursor = "hand";
		img.style.border = "3px solid red";
    }

    function greyBorder(img){
        img.style.cursor = "cursor";
		img.style.border = "3px solid grey";
    }

    function changeImg(event){
        var tag = event.target;
        document.getElementById("backgroundImg").src = tag.getAttribute("src");
    }

</script>
<?php include 'app/views/_global/afterContent.php'; ?>