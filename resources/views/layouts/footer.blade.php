 <!-- Footer -->
 <footer class="site-footer">
    <div class="site-footer-legal">© 2020 <a href="shopart.my.id">TRPL Kelompok E</a></div>
    <div class="site-footer-right">
      Created with <i class="red-600 icon md-favorite"></i> by <a href="shopart.my.id">TRPL Kelompok E</a>
    </div>
  </footer>
 
  @include('layouts.jscore')

  <script>
    $("a#out").click(function()
    {
    $("#logOut").submit();
    return false;
    });
  
</script>
</body>
</html>