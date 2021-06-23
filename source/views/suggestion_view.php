<?php
$rs = $data['rs'];
$search = $data['search'];
$items = $rs['hits']['hits'];
echo "<ul>";
echo "<li onclick=\"choose('$search')\" id='user--input' ><span>$search</span></li>";
foreach($items as $item){ ?>
    <li onclick="choose('<?=$item['_source']['FirstName']?> <?=$item['_source']['LastName']?>')"><?=$item['_source']['FirstName']?> <?=$item['_source']['LastName']?></li>
<?php }
echo "</ul>";

?>