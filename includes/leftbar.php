 
 <style>
    .image-class img {
                background-color: #fff;
            }
    /* Media query for mobile devices (less than 576px) */
    @media (max-width: 575.98px) {
            .image-class img {
                display: none;
            }
            
        }
 </style>
 <!-- Left Panel start-->
 <aside id="left-panel" class="left-panel">
     <nav class="navbar navbar-expand-sm navbar-default">

         <div class="navbar-header">
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                 <i class="fa fa-bars"></i>
             </button>
             <a class="navbar-brand image-class" href="./"><img src="images/tech.png" alt="Logo" ></a>
             <!-- <a class="navbar-brand hidden" href="./"><img src="images/tech.png" alt="Logo"></a> -->

             <!-- <a class="navbar-brand" href="./"><p style="color: white;font-weight: bolder;font-size: 18px;">Admin Panel</p></a>
             <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> -->
         </div>

         <div id="main-menu" class="main-menu collapse navbar-collapse">
             <ul class="nav navbar-nav">
                 <li class="active">
                     <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                 </li>
                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Billing</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="fa fa-address-book-o"></i>
                         <a href="bill_add.php">Add New</a>
                        </li>
                         <li><i class="fa fa-id-badge"></i><a href="bill_view.php">View All</a></li>
                         
                     </ul>
                 </li>
                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Expense</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="fa fa-table"></i><a href="add_expense.php">Add New</a></li>
                         <li><i class="fa fa-table"></i><a href="view_expense.php">View All</a></li>
                     </ul>
                 </li>
                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Sell</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="fa fa-table"></i><a href="company.php">Add New</a></li>
                         <li><i class="fa fa-table"></i><a href="company_view.php">View All</a></li>
                     </ul>
                 </li>


                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Inventory</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="menu-icon fa fa-fort-awesome"></i><a href="inventory_add.php">Add New</a></li>
                         <li><i class="menu-icon ti-themify-logo"></i><a href="inventory_view.php">View All</a></li>
                     </ul>
                 </li>
                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog" aria-hidden="true"></i>
                     Settings</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="menu-icon fa fa-cog" aria-hidden="true"></i><a href="service.php">Services</a></li>
                         <li><i class="menu-icon fa fa-cog" aria-hidden="true"></i><a href="seller.php">Seller Profile</a></li>
                         <li><i class="menu-icon fa fa-cog" aria-hidden="true"></i><a href="authorize.php">Authorize Person</a></li>
                         <li><i class="menu-icon fa fa-cog" aria-hidden="true"></i><a href="sector.php">Expense Sector</a></li>
                     </ul>
                 </li>
                 <li class="menu-item-has-children dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Report</a>
                     <ul class="sub-menu children dropdown-menu">
                         <li><i class="fa fa-table"></i><a href="monthly_reporty.php">Mothly Report</a></li>
                     </ul>
                 </li>
             </ul>
         </div><!-- /.navbar-collapse -->
     </nav>
 </aside>
 <!-- /#left-panel end -->