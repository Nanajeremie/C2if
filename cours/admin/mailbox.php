<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard V.1 | Kiaalap - Kiaalap Admin Template</title>
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
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <?php include('mobile.php');?>
        <div class="mailbox-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="hpanel responsive-mg-b-30">
                            <div class="panel-body">

                                <ul class="mailbox-list">
                                    <li class="active">
                                        <a href="#">
												<span class="pull-right">12</span>
												<i class="fa fa-envelope"></i> Inbox
											</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-paper-plane"></i> Sent</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-pencil"></i> Draft</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-trash"></i> Trash</a>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="mailbox-list">
                                    <li>
                                        <a href="#"><i class="fa fa-plane text-danger"></i> Travel</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-bar-chart text-warning"></i> Finance</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-users text-info"></i> Social</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-tag text-success"></i> Promos</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-flag text-primary"></i> Updates</a>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="mailbox-list">
                                    <li>
                                        <a href="#"><i class="fa fa-gears"></i> Settings</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-info-circle"></i> Support</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="hpanel">
                            <div class="panel-heading hbuilt mailbox-hd">
                                <div class="text-center p-xs font-normal">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" placeholder="Search email in your inbox..."> <span class="input-group-btn active-hook"> <button type="button" class="btn btn-sm btn-default">Search
											</button> </span></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 col-md-6 col-sm-6 col-xs-8">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-exclamation"></i></button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-tag"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-6 col-sm-6 col-xs-4 mailbox-pagination">
                                        <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i></button>
                                            <button class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive ib-tb">
                                    <table class="table table-hover table-mailbox">
                                        <tbody>
                                            <tr class="unread">
                                                <td class="">
                                                    <div class="checkbox checkbox-single checkbox-success">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Jeremy Massey</a></td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                                </td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Tue, Nov 25</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Marshall Horne</a></td>
                                                <td><a href="#">Praesent nec nisl sed neque ornare maximus at ac enim.</a>
                                                </td>
                                                <td></td>
                                                <td class="text-right mail-date">Wed, Jan 13</td>
                                            </tr>
                                            <tr class="active">
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Grant Franco</a> <span class="label label-warning">Finance</span></td>
                                                <td><a href="#">Etiam maximus tellus a turpis tempor mollis.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Mon, Oct 19</td>
                                            </tr>
                                            <tr class="unread active">
                                                <td class="">
                                                    <div class="checkbox checkbox-single">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Ferdinand Meadows</a></td>
                                                <td><a href="#">Aenean hendrerit ligula eget augue gravida semper.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sat, Aug 29</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox checkbox-single">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Ivor Rios</a> <span class="label label-info">Social</span>
                                                </td>
                                                <td><a href="#">Sed quis augue in nunc venenatis finibus.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sat, Dec 12</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Maxwell Murphy</a></td>
                                                <td><a href="#">Quisque eu tortor quis justo viverra cursus.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, May 17</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Henry Patterson</a></td>
                                                <td><a href="#">Aliquam nec justo interdum, ornare mi non, elementum
														lacus.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Thu, Aug 06</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Brent Rasmussen</a></td>
                                                <td><a href="#">Nam nec turpis sed quam tristique sodales.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, Nov 15</td>
                                            </tr>
                                            <tr class="unread">
                                                <td class="">
                                                    <div class="checkbox checkbox-single checkbox-success">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Joseph Hurley</a></td>
                                                <td><a href="#">Nullam tempus leo id urna sagittis blandit.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sun, Aug 10</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Alan Matthews</a></td>
                                                <td><a href="#">Quisque quis turpis ac quam sagittis scelerisque vel ut
														urna.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, Mar 27</td>
                                            </tr>
                                            <tr class="active">
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Colby Lynch</a> <span class="label label-danger">Travel</span></td>
                                                <td><a href="#">Donec non enim pulvinar, ultrices metus eget, condimentum
														mi.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Thu, Dec 31</td>
                                            </tr>
                                            <tr class="unread">
                                                <td class="">
                                                    <div class="checkbox checkbox-single checkbox-success">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Jeremy Massey</a></td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                                </td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Tue, Nov 25</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Marshall Horne</a></td>
                                                <td><a href="#">Praesent nec nisl sed neque ornare maximus at ac enim.</a>
                                                </td>
                                                <td></td>
                                                <td class="text-right mail-date">Wed, Jan 13</td>
                                            </tr>
                                            <tr class="active">
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Grant Franco</a> <span class="label label-warning">Finance</span></td>
                                                <td><a href="#">Etiam maximus tellus a turpis tempor mollis.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Mon, Oct 19</td>
                                            </tr>
                                            <tr class="unread active">
                                                <td class="">
                                                    <div class="checkbox checkbox-single">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Ferdinand Meadows</a></td>
                                                <td><a href="#">Aenean hendrerit ligula eget augue gravida semper.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sat, Aug 29</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox checkbox-single">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Ivor Rios</a> <span class="label label-info">Social</span>
                                                </td>
                                                <td><a href="#">Sed quis augue in nunc venenatis finibus.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sat, Dec 12</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Maxwell Murphy</a></td>
                                                <td><a href="#">Quisque eu tortor quis justo viverra cursus.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, May 17</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Henry Patterson</a></td>
                                                <td><a href="#">Aliquam nec justo interdum, ornare mi non, elementum
														lacus.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Thu, Aug 06</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Brent Rasmussen</a></td>
                                                <td><a href="#">Nam nec turpis sed quam tristique sodales.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, Nov 15</td>
                                            </tr>
                                            <tr class="unread">
                                                <td class="">
                                                    <div class="checkbox checkbox-single checkbox-success">
                                                        <input type="checkbox" checked>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Joseph Hurley</a></td>
                                                <td><a href="#">Nullam tempus leo id urna sagittis blandit.</a></td>
                                                <td><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">Sun, Aug 10</td>
                                            </tr>
                                            <tr>
                                                <td class="">
                                                    <div class="checkbox">
                                                        <input type="checkbox">
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td><a href="#">Alan Matthews</a></td>
                                                <td><a href="#">Quisque quis turpis ac quam sagittis scelerisque vel ut
														urna.</a></td>
                                                <td></td>
                                                <td class="text-right mail-date">Sun, Mar 27</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-footer ib-ml-ft">
                                <i class="fa fa-eye"> </i> 6 unread
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
</body>

</html>