    </div>
		    <footer>
                <p></p>
                <p class="col-xs-12">
                    &copy; <?php echo date('Y'); ?> - Aleksandar Kurta
                </p>
            </footer>
	</div>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        onChangeBrand();
			
        function onChangeBrand(){
            
            var brand = document.getElementById("brand_id");
            var model = document.getElementById("model_id");
            var emptyOpt = document.createElement("option");
            model.options.length = 0;
            emptyOpt.value = -1;
            emptyOpt.text = '';								
            model.options.add(emptyOpt, -1);					
            if(brand.value == -1){
                model.disabled = true;
                model.value = -1;
                <?php $model_id = -1; ?>
            }else{
                <?php 
                if(isset($DATA['model_id'])){
                    $model_id = $DATA['model_id'];
                }
                ?>
                var i = <?php echo $model_id; ?>;
                model.disabled = false;							
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {							
                        var response = JSON.parse(this.responseText);
                        for( var index in response ){
                            var opt = document.createElement("option");
                            opt.value = response[index]['model_id'];
                            opt.text = response[index]['name'];								
                            model.options.add(opt, response[index]['model_id']);
                            if(opt.value == i){
                                opt.setAttribute('selected', true);
                            }
                        
                        }
                        
                    }
                };
                xhttp.open("GET", "http://localhost/G7/aleksandar_kurta/Singidunum/Project/sys/dummy.php?id=" + brand.value , true);
                xhttp.send();
            }
        }
    </script>
	<script src="<?php echo Misc::link('assets/js/jquery-3.3.1.min.js'); ?>"></script>
</body>
</html>