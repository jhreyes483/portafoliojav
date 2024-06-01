<br>
<center>
    <div id="error"><?php if (isset($this->_error)) {
                        echo $this->_error;
                    } ?></div>
</center>



</div>

<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 mx-auto text-lg-left">Copyright Amoblando Sena <?= date('Y-m-d') ?></div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a class="mr-3" href="#!"></a>
                <a href="#!"></a>
            </div>
        </div>
    </div>
</footer>
<script>
    $('table').addClass('tablesorte table-hover bg-white table-sm table-bordered table-striped  text-center')
    $('table thead').addClass('p-2 bg-dark text-white text-center');
</script>
</body>

</html>
