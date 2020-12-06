<?php
	include "controller/produitC.php";
	include_once 'Model/produit.php';

	$productC = new produitC();
    $error = "";
    $listeProduit=$productC->afficherProduit();
	if (
        isset($_POST["name"]) &&
        isset($_POST["description"]) && 
        isset($_POST["price"]) &&
        isset($_POST["quantity"]) && 
        isset($_POST["image"])
	){
		if (
            !empty($_POST["name"]) && 
            !empty($_POST["description"]) &&
            !empty($_POST["price"]) && 
            !empty($_POST["quantity"]) && 
            !empty($_POST["image"])
        ) {
            $prod = new produit(
                $_POST['name'],
                $_POST['description'],
                $_POST['price'], 
                $_POST['quantity'],
                $_POST['image']
			);		
            $productC->modifierProduit($prod, $_GET['id']);
            header('Location:media.php');
        }
        else
            $error = "Missing information";
	}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Media ::
        w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- Bootstrap Core CSS -->
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/forms.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons CSS-->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- side nav css file -->
    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
    <!--//webfonts-->
    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--left-fixed -navigation-->
            <?php
		include('leftnavigation.php');
		?>
            <!--left-fixed -navigation-->

            <!-- header-starts -->
            <?php
		include ('header.php');
		?>
            <!-- //header-ends -->
            <!-- main content start-->
            <div id="page-wrapper">
                <div class="main-page">
                    <h2 class="title1">Available Products</h2>
                    <div class="panel-body widget-shadow">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Delete product</th>
                                    <th>Modify info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP
				foreach($listeProduit as $prod){
			?>
                                <tr>
                                    <th scope="row"><img src="images/<?PHP echo $prod['image']; ?>" width="90"
                                            height="100"></th>
                                    <td>
                                        <?PHP echo $prod['name']; ?>
                                    </td>
                                    <td>
                                        <?PHP echo $prod['price']; ?>
                                    </td>
                                    <td>
                                        <?PHP echo $prod['quantity']; ?>
                                    </td>
                                    <td>
                                        <?PHP echo $prod['description']; ?>
                                    </td>
                                    <td>
                                        <form method="POST" action="supprimerProduit.php">
                                            <button type="submit" class="btn btn-default" value="delete">Delete</button>
                                            <input type="hidden" value=<?PHP echo $prod['id']; ?> name="id">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="media.php?id=<?PHP echo $prod['id']; ?>"> Modify </a>
                                </tr>
                                <?PHP
				}
			?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="page-wrapper">
                <div class="main-page">
                    <div class="forms">
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>Modify Product</h4>
                            </div>
                            <div id="error">
                                <?php echo $error; ?>
                            </div>
                            <div class="form-body">
                                <?php
			if (isset($_GET['id'])){
				$prod = $productC->recupererProduit($_GET['id']);
				
		?>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="<?php echo $prod['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            value="<?php echo $prod['price']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity"
                                            value="<?php echo $prod['quatity']; ?>">
                                    </div>
                                    <div class="description">
                                        <label>Description</label>
                                        <textarea name="description" id="description"
                                            value="<?php echo $prod['description']; ?>"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" id="image"
                                            value="<?php echo $prod['image']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-default" value="modify">Modify</button>
                                </form>
                                <?php
		}
		?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- side nav js -->
        <script src='js/SidebarNav.min.js' type='text/javascript'></script>
        <script>
        $('.sidebar-menu').SidebarNav()
        </script>
        <!-- //side nav js -->
        <!-- Classie -->
        <!-- for toggle left push menu script -->
        <script src="js/classie.js"></script>
        <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
        </script>
        <!-- //Classie -->
        <!-- //for toggle left push menu script -->
        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"> </script>
</body>

</html>