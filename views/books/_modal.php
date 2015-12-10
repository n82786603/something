<?php
use app\models\books\Search;
use yii\web\View;
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 10.12.15
 * Time: 0:16
 * @var View $this
 * @var Search $model
 */
?>
<script type="text/template" id="book-grid-modal-tpl">
    <div id="book-grid-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{name}</h4>
                </div>
                <div class="modal-body">
                    <div class="thumbnail">
                        <img src="{cover_path}" alt="{cover_image_name}">
                        <div class="caption">
                            <h3>{author}</h3>
                            <p><?=$model->getAttributeLabel('release_date')?> : <span class="text-muted">{release_date}</span></p>
                            <p><?=$model->getAttributeLabel('created_at')?> : <span class="text-muted">{created_at}</span></p>
                            <p><?=$model->getAttributeLabel('updated_at')?> : <span class="text-muted">{updated_at}</span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</script>
