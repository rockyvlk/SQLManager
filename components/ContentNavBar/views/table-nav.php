<?php \app\components\ContentNavBar\ContentNavBarAsset::register($this);?>

<ul class="nav nav-tabs content-nav">
  <li><a href="/table/browse/<?= $schemaName.'/'.$tableName ?>">Browse</a></li>
  <li><a href="/table/structure/<?= $schemaName.'/'.$tableName ?>">Structure</a></li>
  <li><a href="/table/sql/<?= $schemaName.'/'.$tableName ?>">Sql</a></li>
  <li><a href="/table/search/<?= $schemaName.'/'.$tableName ?>">Search</a></li>
  <li><a href="/table/insert/<?= $schemaName.'/'.$tableName ?>">Insert</a></li>
  <li><a href="/table/export/<?= $schemaName.'/'.$tableName ?>">Export</a></li>
  <li><a href="/table/import/<?= $schemaName.'/'.$tableName ?>">Import</a></li>
  <li><a href="/table/truncate/<?= $schemaName.'/'.$tableName ?>" data-confirm = "Are you sure you want to clear  the table <?= $tableName ?>?" >Empty</a></li>
  <li><a href="/table/delete/<?= $schemaName.'/'.$tableName ?> " data-confirm = "Are you sure you want to remove the table <?= $tableName?>?" >Delete</a></li>
</ul>