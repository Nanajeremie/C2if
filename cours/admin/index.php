<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>C2if</title>
    <?php include('links.php');?>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">Votre navigateur n'est pas <strong>à jour</strong>. Faites une  <a href="http://browsehappy.com/"> mise à jour</a></p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php include('desktop.php');?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
        <?php include('mobile.php');?>
        <div class="analytics-sparkle-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 shadow">
                            <div class="analytics-content">
                                <h5>Nombre de cours</h5>
                                <span class="text-success">20</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 shadow">
                            <div class="analytics-content">
                                <h5>Abonnes</h5>
                                <span class="text-danger">120</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30 shadow">
                            <div class="analytics-content">
                                <h5>Visiteurs</h5>
                                <span class="text-info">60</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30 shadow">
                            <div class="analytics-content">
                                <h5>Parteneurs</h5>
                                <span class="text-inverse">80</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 px-3">
                    <div class="col-12 text-center mb-3 h4 font-weight-bold primeTxt">Evolution des inscriptions</div>
                        <div class="product-sales-chart shadow">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-6 form group">
                                                        <select class="form-control text-muted">
                                                            <option value="">Choisir un cour</option>
                                                            <option value="">Batiment</option>
                                                            <option value="">Php</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 form group">
                                                        <select class="form-control text-muted">
                                                            <option value="">Choisir une date</option>
                                                            <option value="">2020</option>
                                                            <option value="">2021</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <ul class="list-inline cus-product-sl-rp mt-3">
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #006DF0;"></i>Batiment</h5>
                                </li>
                            </ul>
                            <div id="extra-area-chart" style="height: 356px;"></div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="col-12 text-center mb-3 h4 font-weight-bold primeTxt"> Les cours les plus suivis</div>
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n shadow">
                            <h3 class="box-title">PHP</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-primary">1500</span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n shadow">
                            <h3 class="box-title">CSS</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right graph-two-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-purple">3000</span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n shadow">
                            <h3 class="box-title">JAVA</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right graph-two-ctn"><i class="fa fa-level-down text-success" aria-hidden="true"></i> <span class="text-success"><span class="counter">50</span>%</span>
                                </li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n shadow">
                            <h3 class="box-title">Python</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash4"></div>
                                </li>
                                <li class="text-right graph-four-ctn"><i class="fa fa-level-down" aria-hidden="true"></i> <span class="text-danger"><span class="counter">18</span>%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 ">
                        <div class="sparkline13-list shadow">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Liste des cours</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="name" data-editable="true">Task</th>
                                                <th data-field="email" data-editable="true">Email</th>
                                                <th data-field="phone" data-editable="true">Phone</th>
                                                <th data-field="complete">Completed</th>
                                                <th data-field="task" data-editable="true">Task</th>
                                                <th data-field="date" data-editable="true">Date</th>
                                                <th data-field="price" data-editable="true">Price</th>
                                                <th data-field="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>20</td>
                                                <td>Java Advance</td>
                                                <td>lamon@ghs.com</td>
                                                <td>+8801962067302</td>
                                                <td class="datatable-ct"><span class="pie">2,7</span>
                                                </td>
                                                <td>15%</td>
                                                <td>July 6, 2014</td>
                                                <td>$789889</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>21</td>
                                                <td>Jquery Advance</td>
                                                <td>hasad@uth.com</td>
                                                <td>+8801962067301</td>
                                                <td class="datatable-ct"><span class="pie">2,7</span>
                                                </td>
                                                <td>15%</td>
                                                <td>Jun 6, 2013</td>
                                                <td>$4565656</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>20</td>
                                                <td>Java Advance</td>
                                                <td>lamon@ghs.com</td>
                                                <td>+8801962067302</td>
                                                <td class="datatable-ct"><span class="pie">2,7</span>
                                                </td>
                                                <td>15%</td>
                                                <td>July 6, 2014</td>
                                                <td>$789889</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>21</td>
                                                <td>Jquery Advance</td>
                                                <td>hasad@uth.com</td>
                                                <td>+8801962067301</td>
                                                <td class="datatable-ct"><span class="pie">2,7</span>
                                                </td>
                                                <td>15%</td>
                                                <td>Jun 6, 2013</td>
                                                <td>$4565656</td>
                                                <td class="datatable-ct"><i class="fa fa-check"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 ">
                        <h6 class="col-12 text-center">Devoir programmes</h6>
                        <div class="white-box analytics-info-cs mb-2 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n shadow">
                            <div class="row">
                                <img src="img/courses/4.jpg"  class="img rounded img-fluid col-4" alt="">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Batiment</h3>
                                        </div>
                                        <div class="col-12">
                                            <p>Date:............</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white-box analytics-info-cs mb-2 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n shadow">
                            <div class="row">
                                <img src="img/courses/4.jpg"  class="img rounded img-fluid col-4" alt="">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Batiment</h3>
                                        </div>
                                        <div class="col-12">
                                            <p>Date:............</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white-box analytics-info-cs mb-2 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n shadow">
                            <div class="row">
                                <img src="img/courses/4.jpg"  class="img rounded img-fluid col-4" alt="">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Batiment</h3>
                                        </div>
                                        <div class="col-12">
                                            <p>Date:............</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>

        <!--  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
                        <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
                            <div class="single-review-st-hd">
                                <h2>Vos meilleurs performances</h2>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/4.jpg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Comptabilites</h3>
                                    <p>Excellent</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/5.jpeg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Batiments</h3>
                                    <p>Tres bien</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/6.jpg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Securite informatique</h3>
                                    <p>Acceptable</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/7.jpg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Mines</h3>
                                    <p>Bien</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/8.jpg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Java</h3>
                                    <p>Moyen</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                            <div class="single-review-st-text">
                                <img src="img/courses/4.jpg" alt="">
                                <div class="review-ctn-hf">
                                    <h3>Html</h3>
                                    <p>Passable</p>
                                </div>
                                <div class="review-item-rating">
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star"></i>
                                    <i class="educate-icon educate-star-half"></i>
                                </div>
                            </div>
                        </div>
                    </div> -->
    <script>
// Dashboard 1 Morris-chart

new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'extra-area-chart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        { year: 'jan', value: 12 },
        { year: 'fev', value: 10 },
        { year: 'mar', value: 5 },
        { year: 'avr', value: 4 },
        { year: 'mai', value: 8 },
        { year: 'jui', value: 20 },
        { year: 'juil', value: 17 },
        { year: 'aou', value: 15 },
        { year: 'sep', value: 5 },
        { year: 'oct', value: 20 },
        { year: 'nov', value: 30 },
        { year: 'dec', value: 19 }
    ],
    parseTime:false,
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    xLabels:'month',
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Batiment'],
    pointSize: 1,
    fillOpacity: 0,
    pointStrokeColors:['#006DF0'],
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    lineWidth: 1,
    hideHover: 'auto',
    lineColors: ['#006DF0'],
    resize: true,
});

    </script>
</body>

</html>