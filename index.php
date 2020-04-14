<?php
//nvi, ra, acf, kjv, bbe

if(isset($_GET["versao"]) && !empty($_GET["versao"])){
    $versao = $_GET["versao"];
} else{
    $versao = "acf";
}

if(isset($_GET["livro"]) && !empty($_GET["livro"])){
    $livro = $_GET["livro"];
} else{
    $livro = "gn";
}

if(isset($_GET["cap"]) && !empty($_GET["cap"])){
    $cap = $_GET["cap"];
} else{
    $cap = "1";
}

$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IlR1ZSBBcHIgMDcgMjAyMCAwMjoyOTo1MSBHTVQrMDAwMC5jYWlvY2xzQGhvdG1haWwuY29tLmJyIiwiaWF0IjoxNTg2MjI2NTkxfQ.aUTGj_5TolE2HAQOzUDbf6nusHN7aq1VNJlLBBvw2F0\r\n"
    )
);

$context = stream_context_create($opts);

$urlvers = "https://bibleapi.co/api/verses/".$versao."/".$livro."/".$cap;
$capitulo = json_decode(file_get_contents($urlvers, false, $context));

$urllivro = "https://bibleapi.co/api/books/".$livro;
$dados = json_decode(file_get_contents($urllivro, false, $context));
?>

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="src/styles.css">
        <title>Biblia Online</title>
    </head>
    <body>
        <nav class="navbar sticky-top navbar-dark bg-dark">
            <form>
                <div class="form-row">
                    <div class="col-3">
                        <select class="form-control" id="versions">
                            <option value="acf">ACF</option>
                            <option value="ra">ARA</option>
                            <option value="nvi">NVI</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-control" id="books">
                            <option value="gn">Gênesis</option>
                            <option value="ex">Êxodo</option>
                            <option value="lv">Levítico</option>
                            <option value="nm">Números</option>
                            <option value="dt">Deuteronômio</option>
                            <option value="js">Josué</option>
                            <option value="jz">Juízes</option>
                            <option value="rt">Rute</option>
                            <option value="1sm">I Samuel</option>
                            <option value="2sm">II Samuel</option>
                            <option value="1rs">I Reis</option>
                            <option value="2rs">II Reis</option>
                            <option value="1cr">I Crônicas</option>
                            <option value="2cr">IICrônicas</option>
                            <option value="ed">Esdras</option>
                            <option value="ne">Neemias</option>
                            <option value="et">Ester</option>
                            <option value="job">Jó</option>
                            <option value="sl">Salmos</option>
                            <option value="pv">Provérbios</option>
                            <option value="ec">Eclesiastes</option>
                            <option value="ct">Cantares de Salomão</option>
                            <option value="is">Isaías</option>
                            <option value="jr">Jeremias</option>
                            <option value="lm">Lamentações</option>
                            <option value="ez">Ezequiel</option>
                            <option value="dn">Daniel</option>
                            <option value="os">Oséias</option>
                            <option value="jl">Joel</option>
                            <option value="am">Amós</option>
                            <option value="ob">Obadias</option>
                            <option value="jn">Jonas</option>
                            <option value="mq">Miquéias</option>
                            <option value="na">Naum</option>
                            <option value="hc">Habacuque</option>
                            <option value="sf">Sofonias</option>
                            <option value="ag">Ageu</option>
                            <option value="zc">Zacarias</option>
                            <option value="ml">Malaquias</option>
                            <option value="mt">Mateus</option>
                            <option value="mc">Marcos</option>
                            <option value="lc">Lucas</option>
                            <option value="jo">João</option>
                            <option value="at">Atos dos Apóstolos</option>
                            <option value="rm">Romanos</option>
                            <option value="1co">I Coríntios</option>
                            <option value="2co">II Coríntios</option>
                            <option value="gl">Gálatas</option>
                            <option value="ef">Efésios</option>
                            <option value="fp">Filipenses</option>
                            <option value="cl">Colossenses</option>
                            <option value="1ts">I Tessalonicenses</option>
                            <option value="2ts">II Tessalonicenses</option>
                            <option value="1tm">I Timóteo</option>
                            <option value="2tm">II Timóteo</option>
                            <option value="tt">Tito</option>
                            <option value="fm">Filemon</option>
                            <option value="hb">Hebreus</option>
                            <option value="tg">Tiago</option>
                            <option value="1pe">I Pedro</option>
                            <option value="2pe">II Pedro</option>
                            <option value="1jo">I João</option>
                            <option value="2jo">II João</option>
                            <option value="3jo">III João</option>
                            <option value="jd">Judas</option>
                            <option value="ap">Apocalipse</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-control" id="cap">
                            <?php 
                                for($i=1; $i <= $dados->chapters; $i++){
                                    if($i == $capitulo->chapter->number){
                                        ?>
                                            <option selected value="<?=$i?>"><?=$i?></option>
                                        <?php
                                    } else{
                                        ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php
                                    }
                                    
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </nav>
        
        <div id="versos">
            <?php
                if(count($capitulo->verses)){
                    $i = 0;
                    foreach($capitulo->verses as $verso){
                        $i++;
                        ?>
                            <p class="verso"><b><?=$i?>.</b> <?=$verso->text?></p>
                        <?php
                    }
                }
            ?>
        </div>
        
        

        <!-- Scripts ao fim da página -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript">
            $('#versions').on('change', function(){
                $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: 'src/versesrc.php',
                        data: 'version='+$('#versions').val()+'&book='+$('#books').val()+'&cap='+$('#cap').val(),
                        success: function(msg)
                        {
                            var data = msg;
                            $('#versos').html(data);             
                        }
                    });
            });

            $('#books').on('change', async function(){
                await $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: 'src/dynsrc.php',
                    data: 'book='+this.value,
                    success: function(msg)
                    {
                        var data = msg;
                        $('#cap').html(data);             
                    }
                });

                $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: 'src/versesrc.php',
                        data: 'version='+$('#versions').val()+'&book='+$('#books').val()+'&cap='+$('#cap').val(),
                        success: function(msg)
                        {
                            var data = msg;
                            $('#versos').html(data);             
                        }
                    });
            });

            $('#cap').on('change', function(){
                $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: 'src/versesrc.php',
                        data: 'version='+$('#versions').val()+'&book='+$('#books').val()+'&cap='+this.value,
                        success: function(msg)
                        {
                            var data = msg;
                            $('#versos').html(data);             
                        }
                    });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>