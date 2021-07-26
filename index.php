<?php
require_once 'head.php';
?>

<!-- start: Content -->
<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home/Главная</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Loads/Грузы</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white user"></i><span class="break"></span>Members</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Date registered</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ali</td>
                            <td class="center">2012/01/01</td>
                            <td class="center">Member</td>
                            <td class="center">
                                <span class="label label-success">Active</span>
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="halflings-icon white zoom-in"></i></button>
                                
                                <a class="btn btn-info" href="#">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="#">
                                    <i class="halflings-icon white trash"></i> 
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Ali</td>
                            <td class="center">2012/01/01</td>
                            <td class="center">Member</td>
                            <td class="center">
                                <span class="label label-success">Active</span>
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="halflings-icon white zoom-in"></i></button>
                                
                                <a class="btn btn-info" href="#">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="#">
                                    <i class="halflings-icon white trash"></i> 
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Date registered</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot> 
                </table>            
            </div>
        </div><!--/span-->

    </div><!--/row-->



</div><!--/.fluid-container-->

<!-- end: Content -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div  id = "map" style = "height: 100vh; width: 100%"></div>
            <script>
                // Creating map options
                var mapOptions = {
//                        center: [42.31298, 69.72328],
                    center: [48.038, 70.789],
                    zoom: 5
                };

                // Creating a map object
                var map = new L.map('map', mapOptions);

                // Creating a Layer object
                var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

                // Adding layer to the map
                map.addLayer(layer);

                var marker;
<?php
$cities = R::getAll("SELECT * FROM azamat_city");

foreach ($cities as $item):
    $vacancy_count = R::getAll("SELECT id FROM azamat_vacancy WHERE id_city=?", [$item['id']]);
    $rezume_count = R::getAll("SELECT id FROM azamat_rezume WHERE id_city=?", [$item['id']]);
    ?>
                    marker = L.marker([<?= $item['x'] ?>, <?= $item['y'] ?>]);
                    marker.bindPopup('<b><?= $item['name'] ?></b><br><img src="<?= $item['img'] ?>" width="100px">').openPopup();
                    marker.addTo(map); // Adding marker to the map


<?php endforeach; ?>
            </script>
        </div>
    </div>
</div>

<div class="modal hide large" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">

        <ul class="list-inline item-details">
            <li><a href="http://themifycloud.com">Admin templates</a></li>
            <li><a href="http://themescloud.org">Bootstrap themes</a></li>
        </ul>
    </div>
</div>

<div class="clearfix"></div>


<div class="row-fluid hideInIE9 circleStats12">
    <div class="row-fluid">

    </div>
</div>
<div class="clearfix"></div>
<footer>

    <p>
        <span style="text-align:left;float:left">&copy; 2021 <a href="https://eduastana.epolice.kz/" alt="Bootstrap_Metro_Dashboard">Astana Education Center</a></span>

    </p>

</footer>

<!-- start: JavaScript-->

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-migrate-1.0.0.min.js"></script>

<script src="js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="js/jquery.ui.touch-punch.js"></script>

<script src="js/modernizr.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>

<script src='js/fullcalendar.min.js'></script>

<script src='js/jquery.dataTables.min.js'></script>

<script src="js/excanvas.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>

<script src="js/jquery.chosen.min.js"></script>

<script src="js/jquery.uniform.min.js"></script>

<script src="js/jquery.cleditor.min.js"></script>

<script src="js/jquery.noty.js"></script>

<script src="js/jquery.elfinder.min.js"></script>

<script src="js/jquery.raty.min.js"></script>

<script src="js/jquery.iphone.toggle.js"></script>

<script src="js/jquery.uploadify-3.1.min.js"></script>

<script src="js/jquery.gritter.min.js"></script>

<script src="js/jquery.imagesloaded.js"></script>

<script src="js/jquery.masonry.min.js"></script>

<script src="js/jquery.knob.modified.js"></script>

<script src="js/jquery.sparkline.min.js"></script>

<script src="js/counter.js"></script>

<script src="js/retina.js"></script>

<script src="js/custom.js"></script>
<!-- end: JavaScript-->

</body>
</html>
