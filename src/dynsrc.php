<?php

$livro = $_POST['book'];

$result = "";

$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IlR1ZSBBcHIgMDcgMjAyMCAwMjoyOTo1MSBHTVQrMDAwMC5jYWlvY2xzQGhvdG1haWwuY29tLmJyIiwiaWF0IjoxNTg2MjI2NTkxfQ.aUTGj_5TolE2HAQOzUDbf6nusHN7aq1VNJlLBBvw2F0\r\n"
    )
);

$context = stream_context_create($opts);

$urllivro = "https://bibleapi.co/api/books/".$livro;
$dados = json_decode(file_get_contents($urllivro, false, $context));

for($i=1; $i <= $dados->chapters; $i++){
    $result.="<option value=".$i.">".$i."</option>";
}

echo $result;

?>