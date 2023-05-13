<div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            A.I
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Aerostreet
          </a>
        </div>
        <ul class="nav">
          <li class="<?= (($menu=="import product")?"active":""); ?>">
            <a href="<?= site_url("master/products/import_products")?>">
              <i class="fa fa-download"></i>
              <p>Import Produk</p>
            </a>
          </li>
          <li class="<?= (($menu=="import marketing")?"active":""); ?>">
            <a href="<?= site_url("marketing/katalog/import_marketing")?>">
              <i class="fa fa-download"></i>
              <p>Import Marketing</p>
            </a>
          </li>
          <li class="<?= (($menu=="data postingan")?"active":""); ?>">
            <a href="<?= site_url("konten/katalog/data_postingan")?>">
              <i class="fa fa-hashtag"></i>
              <p>Data Postingan</p>
            </a>
          </li>
          <li class="<?= (($menu=="Katalog Marketing")?"active":""); ?>">
            <a href="<?= site_url("marketing/katalog/index")?>">
              <i class="fa fa-book"></i>
              <p>Katalog Marketing</p>
            </a>
          </li>
          <li class="<?= (($menu=="Katalog Konten")?"active":""); ?>">
            <a href="<?= site_url("konten/katalog/index")?>">
              <i class="fa fa-camera"></i>
              <p>Katalog Konten</p>
            </a>
          </li>
          <li class="<?= (($menu=="Katalog RND")?"active":""); ?>">
            <a href="<?= site_url("rnd/katalog/index")?>">
              <i class="fa fa-flask"></i>
              <p>Katalog RnD</p>
            </a>
          </li>
          
        </ul>
      </div>