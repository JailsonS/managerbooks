<!-- Modal -->
<div class="modal fade" id="deleteBook<?php echo '_'.$id_modal?>" tabindex="-1" aria-labelledby="deleteBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5> Deseja DELETAR o livro <?php echo $book->title; ?> ? </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Não</button>
                <a href="<?=$base?>/delete-book/<?php echo $book->id.$url; ?>" type="button" class="btn btn-danger">Sim</a>
            </div>
        </div>
    </div>
</div>