<style type="text/css">
.container {
    margin: auto;
}
.dropdown-menu .sub-menu {
    left: 100%;
    margin-top: -1px;
    position: absolute;
    top: 51px;
    visibility: hidden;
}

.dropdown-menu li:hover .sub-menu {
    visibility: visible;
}

.dropdown:hover .dropdown-menu {
    display: block;
    background-color: #F0E68C;
    font-size: 20px;
    color: #00CED1;
}
.navbar-header {
	background-color: #F0E68C;
	font-size: 20px;
	color: #00CED1;
	font-family: arial;
}
.nav {
	background-color: #EEE8AA;
	font-size: 20px;
	color: yellow;
	font-family: arial;
}
</style>

<!-- navbar -->
<nav class="navbar nav" >
	<div class="container-fluid">
		<div class="havbar-header">
			<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
			<li><a href="daftar.php"><span class="glyphicon glyphicon-user"></span>Daftar</a></li>
		</ul>
	</div>
</div>
</nav>
