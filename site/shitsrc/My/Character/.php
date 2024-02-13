<?php
require_once("../../main/nav.php");
?>
<div id="Body">
	<style>
	.clothe
	{
		width:110px;
		/*height: 200px;*/
		margin: 10px;
		text-align: left;
		
		vertical-align: top;
		display: inline-block;
		display: -moz-inline-stack;
		*display: inline;
	}
	.clothe .name {
		font-weight: bold;
	}
	.nocl
	{
		font-family: Verdana;
		font-weight: bold;
		text-align: center;
	}
	.img{
		border:none;
		height: 100%;
	}
	.imgc
	{
		border:1px solid black;
		width: 110px;
		height: 110px;
		text-align: center;
		padding: 10px;
		position: relative;
	}
	.fixed
	{
		position:absolute;
		right:0;
		top:0;
		background-color: #EEEEEE;
		border: 1px solid #555555;
		color: blue;
		font-family: Verdana;
		font-size: 10px;
		font-weight: lighter;
	}
	#left{
		width: 69%;
		float: left;
	}
	#right{
		width: 30%;
		float: right;
	}
	#Body table
	{
		border: 1px black solid;
	}
	.tablehead
	{
		font-size:16px; font-weight: bold; border-bottom:black 1px solid; width: 100%; background-color: #CCCCCC; color: #222222;
	}
	.tablebody
	{
		font-weight: lighter; background-color: transparent;font-family: Verdana;
	}
	.margin{
		margin:10px;
	}
	.clickable, .clickable3, .clickable2
	{
		border: none;
		margin:1px;
	}
	.clickable{
		width:50px;
		height: 50px;
	}
	.clickablesm{
		width:40px;
		height:40px;
		margin:5px;
	}
	.clickable2{
		width:47px;
		height: 100px;
	}
	.clickable3{
		width:100px;
		height: 100px;
	}
	.nonsbtn
	{
		font-weight:normal;
	}
	#col{
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -105px;
		margin-left: -205px;
		width: 410px;
		height: 210px;
		z-index: 498;
		background-color: white;
		text-align: center;
		vertical-align: center;
	}
	.tablebody a {
	    color:blue;
	}
	.tablebody a:hover {
	    cursor:pointer;
	}
</style>
<div id="infoa"></div>
<div id="left">
	<table cellspacing="0px" width="100%" style="margin-bottom:10px;">
		<tbody><tr>
		    <th class="tablehead">My Wardrobe</th>
		</tr>
		<tr>
		    <td class="tablebody" style="font-size:12px; text-align: center; border-bottom: 1px solid black;">
		        <a id="btn8" onclick="getWardrobe(8)">Faces</a>
		        |
		        <a id="btn2" onclick="getWardrobe(2)">T-Shirts</a>
		        |
		        <a id="btn5" onclick="getWardrobe(5)" style="font-weight: bold;">Shirts</a>
		        |
		        <a id="btn6" onclick="getWardrobe(6)" style="font-weight: normal;">Pants</a>
		        |
		        <a id="btn1" onclick="getWardrobe(1)" style="font-weight: normal;">Hats</a>
		        |
		        <a id="btn7" onclick="getWardrobe(7)" style="font-weight: normal;">Heads</a>
		        <br>
		        <a href="/Catalog.aspx">Shop</a> 
		        <span id="crlinkspan" style="display: inline;">|
		        <a href="/my/character/upload/?type=1" id="crlink">Create</a></span>
		    </td>
		</tr>
		<tr>
		    <td class="tablebody">
		        <div id="wardrobe" style="padding-left:13px;">No Shirts have been found.</div>
				<div style="clear:both;"></div>
			</td>
		</tr>
	</tbody></table><div class="seperator"></div>
	<table cellspacing="0px" width="100%">
		<tbody><tr>
		    <th class="tablehead">Currently Wearing</th>
		</tr>
		<tr>
		    <td class="tablebody">
		        <div id="wearing" style="padding-left:13px;"></div>
			</td>
		</tr>
	</tbody></table>
</div>
<div id="right">
	<table cellspacing="0px" width="100%">
		<tbody><tr><th class="tablehead">My Character</th></tr>
		<tr><th class="tablebody">
		<img class="margin" id="limg" src="/img/user/<?=$_USER['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>">
		<img class="margin" id="uimg" src=""><br>Something wrong with your Avatar? Click <a href="#" disabled="disabled">here</a> to redraw it!</th></tr>
	</tbody></table>
	<table cellspacing="0px" width="100%" style="margin-top: 10px;">
		<tbody><tr><th class="tablehead">Color Chooser</th></tr>
		<tr><th class="tablebody"><br>
			<button class="clickable" id="bp0" style="background-color:#F2F3F2"></button><div class="seperator" style="height: 5px;"></div>
			<button class="clickable2" id="bp3" style="background-color:#F2F3F2"></button>
			<button class="clickable3" id="bp2" style="background-color:#C4281B"></button>
			<button class="clickable2" id="bp1" style="background-color:#F2F3F2"></button><div class="seperator" style="height: 5px;"></div>
			<button class="clickable2" id="bp5" style="background-color:#6E99C9"></button>
			<button class="clickable2" id="bp4" style="background-color:#6E99C9"></button>
		<br>Click <a href="#" disabled="disabled">here</a> to reset your character.<br></th></tr>
	</tbody></table>
	
</div>
<div style="clear:both;"></div>

</div>