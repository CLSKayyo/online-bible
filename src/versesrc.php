<?php 

    $livro = $_POST['book'];
    $cap = $_POST['cap'];
    $version = $_POST['version'];

    $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IlR1ZSBBcHIgMDcgMjAyMCAwMjoyOTo1MSBHTVQrMDAwMC5jYWlvY2xzQGhvdG1haWwuY29tLmJyIiwiaWF0IjoxNTg2MjI2NTkxfQ.aUTGj_5TolE2HAQOzUDbf6nusHN7aq1VNJlLBBvw2F0\r\n"
        )
    );
    
    $context = stream_context_create($opts);
    
    $urlvers = "https://bibleapi.co/api/verses/".$version."/".$livro."/".$cap;
    $capitulo = json_decode(file_get_contents($urlvers, false, $context));

    $result = "";

    if(count($capitulo->verses)){
        $i = 0;
        foreach($capitulo->verses as $verso){
            $i++;
            $result .= '<p class="verso" id="'.$i.'">'.$i.'. '.$verso->text.'</p>';
        }
    }

    echo $result;
?>