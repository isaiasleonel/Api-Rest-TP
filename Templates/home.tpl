{include file="header.tpl"}

<!-- ---------- START CARRUSERL ---------- -->
{if !isset($smarty.session.USER_ID)}
    <section class="mb-4 d-none d-md-block">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.venex.com.ar/fil/banners/home-1578x414.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.venex.com.ar/fil/banners/banner-desktop-wd.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.venex.com.ar/fil/banners/home.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
{/if}
<!-- ---------- END CARRUSERL ---------- -->

<!-- ---------- START MAIN APP ---------- -->
<section class="container">
    <div class="row">
        <!-------- Vista  Home de Administrador Logeado   ------>
        <!-- ---------- Tabla vista Administror---------- -->
        {if isset($smarty.session.USER_ID)}
            {include file="admHome.tpl"}
        {/if}

        <!-- Vista de usuario No Logueado   -->
        {if !isset($smarty.session.USER_ID)}

            <!-- ---------- Row 1: START ACCORDION CATEGORY ---------- -->
            <div class="col-12 col-md-4 mb-4">
                {include file="aside-home.tpl"}
            </div>

            <!-- ---------- Row 2: START CARD PRODUCTS ---------- -->
            <div class="col-12 col-md-8 ">
                {include file="user-Home.tpl"}
                <!-- ---------- END PAGINATION ---------- -->
            </div>
            <!-- ---------- END CARD PRODUCTS ---------- -->
        </div>
    {/if}
    </div>
</section>

{include file="footer.tpl"}