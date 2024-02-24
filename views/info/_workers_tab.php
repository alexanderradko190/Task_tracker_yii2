<?php
foreach ($workers as $worker) {
    echo "
    <div class='d-flex flex-row w-50 justify-content-between'>
      <div>{$worker['username']}</div>
    </div>
";
}
?>