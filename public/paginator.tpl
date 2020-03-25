<?php
/**  @var $this Template */

$data = $this->data;

$page = 1;
for($i = 0; $i < $data['total_count']; $i += $data['per_page']) { ?>
    <a href="/index.php?offset=<?=$i?>"><?=$page++?></a>
<?php } ?>


