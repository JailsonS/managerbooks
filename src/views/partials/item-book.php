<div class="card" style="-webkit-box-shadow: 0 0 10px #3494d46c;min-width:15rem">
    <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <p class="card-text"> Author</p>
        
        <div class="item-book-btns" style="display: flex;">
            <a href="#" class="btn btn-info btn-sm" 
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
            <a href="#" class="btn btn-warning btn-sm" 
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
        </div>
    </div>
</div>