  <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" runat="server" href="~/">
                    <img src="http://placehold.it/200x40/3A1B37/ffffff/?text=Apllicatin"></a>
                <div class="col-md-6 col-sm-8 col-xs-11 navbar-left">
                    <div class="navbar-form " role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" style="max-width: 100%; width: 100%;">
                            <div class="input-group-btn">
                                <button class="btn btn-default" style="background: rgb(72, 166, 72);" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="navbar-brand  visible-md visible-lg visible-sm" style="visibility: hidden;" runat="server">
                        <img src="http://placehold.it/200x40/3A1B37/ffffff/?text=Apllicatin" />
                    </li>
                    <li><a runat="server" href="~/">Home</a></li>
                    <li><a runat="server" href="~/About">About</a></li>
                    <li><a runat="server" href="~/Contact">Contact</a></li>
                    <li><a runat="server" href="~/">Somthing</a></li>
                    <li><a runat="server" href="~/">Somthing</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a runat="server" href="~/Account/Register">Register</a></li>
                    <li><a runat="server" href="~/Account/Login">Log in</a></li>
                </ul> </div>

        </div>
    </div>
<div style="border: #efefef ridge 5px; margin-top: 70px;">
	RESULT: 
		<?php 
		echo "url:".$url."<hr>";
		$citydata=  get_object_vars(json_decode(Yii::app()->user->getState("city_data")));
		$bookdata=  get_object_vars(json_decode(Yii::app()->user->getState("book_data")));

		var_dump($bookdata);
		echo "<hr>";
		var_dump($citydata);
		;?>
<div><?php echo $date;?></div> 
</div>