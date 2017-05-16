<?php \app\components\SqlRequest\SqlRequestAsset::register($this);

?>

<form action="/schema/sql/learn" method="post">

    <div id="editor"></div>
    <textarea name="query" id="query">SELECT * FROM account</textarea>
    <br>
    <button type="submit" class="btn">Execute</button>

</form>