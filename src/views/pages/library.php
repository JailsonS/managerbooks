<?= $render('header')?>
    
    <div class="main">

        <!-- header section -->
        <header class="item">
            <div class="header-left">
                <ul>
                    <li>
                        <a href="#">
                            <div class="menu-img" data-tip="Home" data-for="tip-right" currentitem="false">
                                <img width="50" height="50" src="<?=$base?>/assets/media/icons/brand.png" />
                            </div>
                        </a>
                    </li>
                </ul> 
            </div>
            <div class="header-right">
                <ul>
                    <li>
                        <a href="<?=$base?>/logout">
                            <div class="menu-img" data-tip="Home" data-for="tip-right" currentitem="false">
                                <img width="35" height="35" src="<?=$base?>/assets/media/icons/logout.png" />
                            </div>
                        </a>
                    </li>
                </ul> 
            </div>
        </header>

        <!-- content section -->
        <div class="main-content">

            <!-- nav items -->
            <nav class="item">
                <ul>

                <?php if($loggedUser->perm == 1):?>
                    <li>
                        <a href="<?=$base?>/home" style="text-decoration: none;">
                            <img width="35" height="35" class="menu-opener-icon" src="<?=$base?>/assets/media/icons/note.png" />
                            Meus Cadastros
                        </a>
                    </li>
                <?php endif;?>

                    <li class="link:activated">
                        <a href="<?=$base?>/library" style="text-decoration: none;">
                            <img width="35" height="35" class="menu-opener-icon" src="<?=$base?>/assets/media/icons/books.png" />
                            Biblioteca
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- content -->
            <section class="item">
                <!-- list book area -->

                <!-- check flahs messages -->
                <?php if($flash):?>
                    <div class="alert alert-primary" role="alert">
                        <?php echo $flash; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if($loggedUser->perm == 2):?>
                    <!-- register button -->
                    <button id="btn-register" type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerBook">
                        <div style="font-size: 30px;">+</div>
                        <div>Novo Cadastro</div>
                    </button>

                    <!-- this is the modal form -->
                    <?= $render('register-book-modal') ?>

                    <hr>
                <?php endif; ?>

                <div class="book-list-area">
                    <?php foreach ($books as $book): ?>

                        <?= $render('item-book', [
                            'book' => $book,
                            'loggedUser' => $loggedUser,
                            'id_modal' =>  $book->id.'_list_tab',
                            'url' => $url
                        ]) ?>
                  
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <footer class="item">footer</footer>
    </div>

    <!-- JS here! -->
    <script src="<?=$base?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?=$base?>/assets/js/bootstrap.min.js"></script>

<?= $render('footer')?>