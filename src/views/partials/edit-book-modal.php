<!-- Modal -->
<div class="modal fade" id="editBook<?php echo '_'.$id_modal?>" tabindex="-1" aria-labelledby="editBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookLabel"> <?php echo $book->title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="<?=$base?>/edit-book/<?php echo $book->id; ?>">
                    <div class="form-group">
                        <label for="title">Título do livro</label>
                        <input name="title" type="text" class="form-control" value="<?php echo $book->title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input name="author"type="text" class="form-control" value="<?php echo $book->author; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea 
                            name="description" 
                            class="form-control" 
                            rows="3" ><?php echo $book->description; ?></textarea>
                    </div>
         
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
        
                </form>  
            </div>
        </div>
    </div>
</div>