<?php \app\components\ContentNavBar\ContentNavBarAsset::register($this);?>

<ul class="nav nav-tabs content-nav">
    <li><a href="/schema/tables/<?=$schemaName?>">Tables</a></li>
    <li><a href="/schema/views/<?=$schemaName?>">Views</a></li>
    <li><a href="/schema/sql/<?= $schemaName?>">Sql</a></li>
    <li><a href="/schema/export/<?= $schemaName?>">Export</a></li>
    <li><a href="/schema/import/<?= $schemaName?>">Import</a></li>
    <li><a href="/schema/delete/<?= $schemaName?>" data-confirm = "Are you sure you want to remove the schema <?= $schemaName?>?">Delete</a></li>
</ul>