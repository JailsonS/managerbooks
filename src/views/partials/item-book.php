<div class="card" style="-webkit-box-shadow: 0 0 10px #3494d46c;min-width:15rem">
    <div class="card-body">
        <h5 class="card-title"><?php echo $book->title; ?></h5>
        <p class="card-text"> <?php echo $book->author; ?></p>
        
        <!-- view btn -->
        <div class="item-book-btns" style="display: flex;">
            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewBook<?php echo '_'.$id_modal?>"
                style="
                    display: flex;
                    justify-content:center; 
                    align-items:center;
                    width:fit-content;
                    margin-right:5px
                    "
                > 
                <img width="15" height="15" src="<?=$base?>/assets/media/icons/view.png" />
            </a>
            <!-- update btn -->
            <a href="#" 
                class="btn btn-warning btn-sm <?php if($book->id_user !== $loggedUser->id) {echo 'disabled';}?>" 
                data-toggle="modal" data-target="#editBook<?php echo '_'.$id_modal?>"
                style="
                    display: flex; 
                    justify-content:center; 
                    align-items:center;
                    width:fit-content;
                    margin-right:5px
                    "
                >
                <img width="15" height="15" src="<?=$base?>/assets/media/icons/edit.png" />
            </a>
            <!-- delete btn -->
            <a 
                href="#" 
                class="btn btn-danger btn-sm <?php if($book->id_user !== $loggedUser->id) {echo 'disabled';}?>" 
                data-toggle="modal" 
                data-target="#deleteBook<?php echo '_'.$id_modal?>"
                style="
                    display: flex; 
                    justify-content:center; 
                    align-items:center;
                    width:fit-content;
                    margin-right:5px
                    "
                >
                <img width="15" height="15" src="<?=$base?>/assets/media/icons/delete.png" />
            </a>
        </div>
    </div>
</div>


<?= $render('view-book-modal', [
    'book' => $book,
    'id_modal' =>  $id_modal,
]) ?>  

<?= $render('edit-book-modal', [
    'book' => $book,
    'id_modal' =>  $id_modal,
    'url' => $url
]) ?> 

<?= $render('delete-book-modal', [
    'book' => $book,
    'id_modal' =>  $id_modal,
    'url' => $url
]) ?> 