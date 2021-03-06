<!-- Modal -->
<div class="modal fade" id="registerBook" tabindex="-1" aria-labelledby="registerBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerBookLabel">Cadastrar Livro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form section -->
                <form method="POST" action="<?=$base?>/add-book">
                    <div class="form-group">
                        <label for="title">Título do livro</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input name="author" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
         
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
        
                </form>  
            </div>

        </div>
    </div>
</div>