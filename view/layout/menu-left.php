<?php

use App\Controller\UserController;

$objUser = new UserController;
$user = $objUser->show(1);
// print_r();
?>
<div id="menu-left" class="menu-left col-2">
    <div class="img">
        <img src="<?php echo "/img/" . $user->img ?>" alt="" srcset="">
    </div>

    <div class="menu-info">
        <h1> <?php echo $user->name ?> </h1>
        <p><?php echo $user->email ?></p>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">
            Edit
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfile" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editar Perfil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" enctype="multipart/form-data" action="/edit/profile">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" name="name" class="form-control" id="editName" placeholder="Nome" value="<?php echo $user->name ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="email" class="form-control" id="editEmail" placeholder="Nome" value="<?php echo $user->email ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="editPassword" placeholder="Password" value="<?php echo $user->password ?>">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="img" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">select image profile</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="menu-list">

        <div>
            <i class="fab fa-php"></i>
        </div>

        <div>
            <i class="fab fa-js-square"></i>
        </div>
        <div>
            <i class="fab fa-css3-alt"></i>
        </div>
        <div>
            <i class="fab fa-html5"></i>
        </div>
        <div>
            <i class="fab fa-github-square"></i>
        </div>

        <div>
            <i class="fab fa-vuejs"></i>
        </div>
    </div>

</div>