<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<script>
    $('#myModal').on('hide.bs.modal', function() {
        $(this).removeData();
    });
</script>

<form action="/schema/create" id="formId">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create new schema</h4>
    </div>
    <div class="modal-body">

        <label for="schemaName">Schema Name: </label><input type="text" name="schemaName" ><br>
        <label for="collation">Collation: </label> <?= Html::dropDownList('collation', "utf8_general_ci" , ArrayHelper::map($collations,'COLLATION_NAME','COLLATION_NAME')) ?>


    </div>

    <div class="modal-footer">
        <?php echo Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
    </div>

</form>