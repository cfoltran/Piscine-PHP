<div class="nav-menu" id="menu">
  <a href="/">Fakiromania</a>
  <a href="">Manifestations</a>
  <a href="">Toiles</a>
  <a href="">Collabs</a>
  <a href="">Art'pero</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
    function myFunction() {
    var x = document.getElementById("menu");
    if (x.className === "nav-menu") {
        x.className += " responsive";
    } else {
        x.className = "nav-menu";
    }
    }
</script>