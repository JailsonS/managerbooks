<!-- Modal -->
<div class="modal fade" id="viewBook<?php echo '_'.$id_modal?>" tabindex="-1" aria-labelledby="label<?php echo '_'.$id_modal?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label<?php echo '_'.$id_modal?>"> <?php echo $book->title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5> Autor: <?php echo $book->author; ?> </h5>
                <p> <?php echo $book->description; ?> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>