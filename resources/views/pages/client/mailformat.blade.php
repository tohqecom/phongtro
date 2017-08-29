<!DOCTYPE html>
<html>
<head>
<style>
div.container {
    width: 100%;
    border: 1px solid gray;
}

header, footer {
    padding: 1em;
    color: white;
    background-color: #5bc0de;
    clear: left;
    text-align: center;
}

nav {
    float: left;
    max-width: 160px;
    margin: 0;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    padding: 0;
}
   
nav ul a {
    text-decoration: none;
}

article {
    margin-left: 170px;
    border-left: 1px solid gray;
    padding: 1em;
    overflow: hidden;
}
</style>
</head>
<body>

<div class="container">

<header>
   <h1>Neofita Apartel Rental</h1>
</header>
<h2>From: {{ $user }}</h4>
	<h4>Email: {{ $email }}</h4>
	<h4>Mobile #: {{ $mobile }}</h4>

<h5><p>{{ $msg }}</p></h5>

 <h4>{{ $post_type }}<br/></h4>
		<h4>{{ $post_address }}<br/></h4>
		<h4>₱{{ $post_price }}</h4>
</article>

<footer>Copyright © JoshuaParedes</footer>

</div>

</body>
</html>