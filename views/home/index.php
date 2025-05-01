<html>
    <head>
    <link rel="stylesheet" href="<?= asset_url() ?>css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= asset_url() ?>css/all.min.css"/>
    <link rel="stylesheet" href="<?= asset_url() ?>css/index_style.css"/>
    <link rel="stylesheet" href="<?= asset_url() ?>css/pagination.css"/>
    </head>
    <body>
        <div class="jumbotron jum">
            <div class=" navbar">
            <h3>Phone Book <i class="far fa-address-book"></i></h3>
            </div>
            <div class="row">
                <div class="col-lg-4 inp">
                    <form action="">
                        <input onkeyup="searchFunction()" name="s" id="myInput" class="form-control mt-2" placeholder="search">
                        <span class="icon text-primary"><i class="fas fa-search"></i></span>
                    </form>
                <h5 class="mt-2">Add New Contact</h5>
                    <form action="<?= site_url().'contact/add' ?>" method="post">
                    <input onblur="validateName()" name=name class="form-control mb-3 mt-3" placeholder="add name" id="userName">
                    <div id="nameAlert" class="alert alert-danger text-justify p-2 ">Please add name</div>
                    <input onblur="validatePhone()" name=phone class="form-control mb-3" placeholder="add phone" id="userPhone">
                    <div id="phoneAlert" class="alert alert-danger text-justify p-2 ">Please add a valid number</div>
                    <input onblur="validateEmail()" name=email class="form-control mb-3" placeholder="add e-mail" id="userEmail">
                    <div id="mailAlert" class="alert alert-danger text-justify p-2 ">Please add a valid e-mail</div>
                    <button onclick="addContact()" class="btn btn-info w-100 btn1">Add</button>
                    </form>    
                </div>
                <div class="col-lg-8">
                    <table id="myTable" class="table text-justify table-striped">
                    <thead class="tableh1">
                    <th class="">Id</th>
                    <th class="">Name</th>
                    <th class="">Phone</th>
                    <th class="">E-mail</th>
                    <th class="">Created_at</th>   
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach($contacts as $contact):?>
                            <tr>
                                <td class=""><?=$contact['id']?></td>
                                <td class=""><?=$contact['name']?></td>
                                <td class=""><?=$contact['mobile']?></td>
                                <td class=""><?=$contact['email']?></td>
                                <td class=""><?=$contact['created_at']?></td> 
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    </table>
                </div>
                <div id="pagination">
                    <?php
                        use App\Core\Paginator;
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $visiblePage);
                        echo $paginator->render('?page=');
                    ?>
                </div>
           </div>    
        </div>
        <script src="js/jquery-3.3.1.min.js"></script>
    <script src="<?= asset_url() ?>js/popper.min.js"></script>
    <script src="<?= asset_url() ?>js/bootstrap.min.js"></script>
    <!-- <script src="<?= asset_url() ?>js/index.js"></script> -->
    </body>
    
</html>













